<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Invoice;
use App\Models\PaymentConfirmation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Response;

class PaymentController extends Controller
{
    /**
     * Show payment upload form
     */
    public function showUploadForm(Booking $booking)
    {
        // Check if user owns this booking
        if ($booking->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access to booking');
        }

        // Check if booking is approved and awaiting payment
        if ($booking->status !== 'approved' && $booking->status !== 'awaiting_payment') {
            Alert::error('Error', 'Booking belum disetujui atau tidak dalam status menunggu pembayaran.');
            return redirect()->route('booking.show', $booking->booking_id);
        }

        $invoice = $booking->invoice;
        if (!$invoice) {
            Alert::error('Error', 'Invoice tidak ditemukan.');
            return redirect()->route('booking.show', $booking->booking_id);
        }

        return view('Frontend.payment.upload', compact('booking', 'invoice'));
    }

    /**
     * Store payment confirmation
     */
    public function store(Request $request)
    {
        // Validate request
        $validationRules = [
            'booking_id' => 'required|exists:bookings,booking_id',
            'payment_method' => 'required|in:bank_transfer,e_wallet,cash,other',
            'payment_amount' => 'required|numeric|min:0',
            'payment_date' => 'required|date|before_or_equal:now',
            'payment_proof' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'payment_notes' => 'nullable|string|max:1000',
        ];

        // Add conditional validation based on payment method
        if ($request->payment_method === 'bank_transfer') {
            $validationRules['bank_name'] = 'required|string|max:255';
            $validationRules['account_number'] = 'required|string|max:255';
            $validationRules['account_holder_name'] = 'required|string|max:255';
        } elseif ($request->payment_method === 'e_wallet') {
            $validationRules['e_wallet_type'] = 'required|string|max:255';
            $validationRules['e_wallet_number'] = 'required|string|max:255';
        }

        $request->validate($validationRules);

        $booking = Booking::where('booking_id', $request->booking_id)->firstOrFail();

        // Check if user owns this booking
        if ($booking->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access to booking');
        }

        // Check if booking is approved
        if ($booking->status !== 'approved') {
            Alert::error('Error', 'Booking belum disetujui.');
            return redirect()->back();
        }

        DB::beginTransaction();

        try {
            $invoice = $booking->invoice;
            if (!$invoice) {
                throw new \Exception('Invoice tidak ditemukan.');
            }

            // Store payment proof file
            $paymentProofPath = $request->file('payment_proof')->store(
                'payment-proofs/' . $booking->booking_number,
                'public'
            );

            // Prepare payment confirmation data
            $paymentData = [
                'booking_id' => $booking->booking_id,
                'invoice_id' => $invoice->invoice_id,
                'payment_method' => $request->payment_method,
                'payment_amount' => $request->payment_amount,
                'payment_date' => $request->payment_date,
                'payment_proof_path' => $paymentProofPath,
                'payment_notes' => $request->payment_notes,
                'status' => 'pending'
            ];

            // Add method-specific data
            if ($request->payment_method === 'bank_transfer') {
                $paymentData['bank_name'] = $request->bank_name;
                $paymentData['account_number'] = $request->account_number;
                $paymentData['account_holder_name'] = $request->account_holder_name;
            } elseif ($request->payment_method === 'e_wallet') {
                $paymentData['e_wallet_type'] = $request->e_wallet_type;
                $paymentData['e_wallet_number'] = $request->e_wallet_number;
            }

            // Create payment confirmation
            $paymentConfirmation = PaymentConfirmation::create($paymentData);

            // Update invoice status
            $invoice->update([
                'status' => 'payment_uploaded'
            ]);

            DB::commit();

            Alert::success('Berhasil!', 'Bukti pembayaran berhasil diupload. Menunggu konfirmasi admin.');
            return redirect()->route('booking.show', $booking->booking_id);

        } catch (\Exception $e) {
            DB::rollback();

            // Delete uploaded file if exists
            if (isset($paymentProofPath)) {
                Storage::disk('public')->delete($paymentProofPath);
            }

            Alert::error('Error', 'Terjadi kesalahan saat mengupload bukti pembayaran: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    /**
     * Show payment confirmation for admin
     */
    public function showConfirmation(PaymentConfirmation $paymentConfirmation)
    {
        // Check if user is admin
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized access');
        }

        $paymentConfirmation->load(['booking.user', 'booking.layanan', 'invoice']);

        return view('admin.payments.confirmation', compact('paymentConfirmation'));
    }

    /**
     * Approve payment confirmation
     */
    public function approve(Request $request, PaymentConfirmation $paymentConfirmation)
    {
        // Check if user is admin
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized access');
        }

        $request->validate([
            'admin_notes' => 'nullable|string|max:1000'
        ]);

        DB::beginTransaction();

        try {
            $paymentConfirmation->approve(Auth::id(), $request->admin_notes);

            DB::commit();

            Alert::success('Berhasil!', 'Pembayaran telah dikonfirmasi dan booking disetujui.');
            return redirect()->route('admin.payments.index');

        } catch (\Exception $e) {
            DB::rollback();
            Alert::error('Error', 'Terjadi kesalahan saat mengkonfirmasi pembayaran: ' . $e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Reject payment confirmation
     */
    public function reject(Request $request, PaymentConfirmation $paymentConfirmation)
    {
        // Check if user is admin
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized access');
        }

        $request->validate([
            'admin_notes' => 'required|string|max:1000'
        ]);

        DB::beginTransaction();

        try {
            $paymentConfirmation->reject(Auth::id(), $request->admin_notes);

            DB::commit();

            Alert::success('Berhasil!', 'Pembayaran telah ditolak. User dapat mengupload ulang bukti pembayaran.');
            return redirect()->route('admin.payments.index');

        } catch (\Exception $e) {
            DB::rollback();
            Alert::error('Error', 'Terjadi kesalahan saat menolak pembayaran: ' . $e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * List payment confirmations for admin
     */
    public function index(Request $request)
    {
        // Check if user is admin
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized access');
        }

        $query = PaymentConfirmation::with(['booking.user', 'booking.layanan', 'invoice'])
            ->orderBy('created_at', 'desc');

        // Filter by status
        if ($request->has('status') && $request->status !== '') {
            $query->where('status', $request->status);
        }

        // Filter by payment method
        if ($request->has('payment_method') && $request->payment_method !== '') {
            $query->where('payment_method', $request->payment_method);
        }

        // Filter by date range
        if ($request->has('date_from') && $request->date_from !== '') {
            $query->whereDate('payment_date', '>=', $request->date_from);
        }

        if ($request->has('date_to') && $request->date_to !== '') {
            $query->whereDate('payment_date', '<=', $request->date_to);
        }

        $paymentConfirmations = $query->paginate(15);

        return view('admin.payments.index', compact('paymentConfirmations'));
    }

    /**
     * Download payment proof
     */
    public function downloadProof(PaymentConfirmation $paymentConfirmation)
    {
        // Check if user is admin or owns the booking
        if (Auth::user()->role !== 'admin' && $paymentConfirmation->booking->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access');
        }

        if (!Storage::disk('public')->exists($paymentConfirmation->payment_proof_path)) {
            Alert::error('Error', 'File bukti pembayaran tidak ditemukan.');
            return redirect()->back();
        }

        return Response::download(
            Storage::disk('public')->path($paymentConfirmation->payment_proof_path),
            'bukti-pembayaran-' . $paymentConfirmation->booking->booking_number . '.' .
            pathinfo($paymentConfirmation->payment_proof_path, PATHINFO_EXTENSION)
        );
    }
}
