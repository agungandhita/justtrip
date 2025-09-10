<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PaymentConfirmation;
use App\Models\Booking;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Response;

class PaymentConfirmationController extends Controller
{
    /**
     * Display a listing of payment confirmations
     */
    public function index(Request $request)
    {
        $query = PaymentConfirmation::with(['booking.user', 'booking.layanan', 'invoice'])
                                  ->latest();

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Search by booking number or user name
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('booking', function($q) use ($search) {
                $q->where('booking_number', 'like', "%{$search}%")
                  ->orWhereHas('user', function($userQuery) use ($search) {
                      $userQuery->where('name', 'like', "%{$search}%")
                               ->orWhere('email', 'like', "%{$search}%");
                  });
            });
        }

        $paymentConfirmations = $query->paginate(15);

        // Statistics
        $statistics = [
            'total' => PaymentConfirmation::count(),
            'pending' => PaymentConfirmation::where('status', 'pending')->count(),
            'approved' => PaymentConfirmation::where('status', 'approved')->count(),
            'rejected' => PaymentConfirmation::where('status', 'rejected')->count(),
            'today' => PaymentConfirmation::whereDate('created_at', today())->count(),
        ];

        return view('admin.payment-confirmations.index', compact('paymentConfirmations', 'statistics'));
    }

    /**
     * Display the specified payment confirmation
     */
    public function show(PaymentConfirmation $paymentConfirmation)
    {
        $paymentConfirmation->load(['booking.user', 'booking.layanan', 'booking.specialOffer', 'invoice']);
        
        return view('admin.payment-confirmations.show', compact('paymentConfirmation'));
    }

    /**
     * Approve payment confirmation
     */
    public function approve(Request $request, PaymentConfirmation $paymentConfirmation)
    {
        $request->validate([
            'admin_notes' => 'nullable|string|max:1000'
        ]);

        // Check if already processed
        if ($paymentConfirmation->status !== 'pending') {
            Alert::error('Error', 'Konfirmasi pembayaran sudah diproses sebelumnya.');
            return redirect()->back();
        }

        try {
            // Update payment confirmation
            $paymentConfirmation->update([
                'status' => 'approved',
                'admin_notes' => $request->admin_notes,
                'processed_at' => now(),
                'processed_by' => Auth::id()
            ]);

            // Update invoice status
            if ($paymentConfirmation->invoice) {
                $paymentConfirmation->invoice->update([
                    'status' => 'paid',
                    'paid_at' => now()
                ]);
            }

            // Update booking status to completed
            $paymentConfirmation->booking->update([
                'status' => 'completed'
            ]);

            Alert::success('Berhasil', 'Pembayaran telah dikonfirmasi dan booking diselesaikan.');
            return redirect()->route('admin.payment-confirmations.index');

        } catch (\Exception $e) {
            Alert::error('Error', 'Terjadi kesalahan saat memproses konfirmasi pembayaran.');
            return redirect()->back();
        }
    }

    /**
     * Reject payment confirmation
     */
    public function reject(Request $request, PaymentConfirmation $paymentConfirmation)
    {
        $request->validate([
            'admin_notes' => 'required|string|max:1000'
        ]);

        // Check if already processed
        if ($paymentConfirmation->status !== 'pending') {
            Alert::error('Error', 'Konfirmasi pembayaran sudah diproses sebelumnya.');
            return redirect()->back();
        }

        try {
            // Update payment confirmation
            $paymentConfirmation->update([
                'status' => 'rejected',
                'admin_notes' => $request->admin_notes,
                'processed_at' => now(),
                'processed_by' => Auth::id()
            ]);

            // Update invoice status back to awaiting payment
            if ($paymentConfirmation->invoice) {
                $paymentConfirmation->invoice->update([
                    'status' => 'awaiting_payment'
                ]);
            }

            Alert::success('Berhasil', 'Pembayaran telah ditolak. Customer dapat mengupload ulang bukti pembayaran.');
            return redirect()->route('admin.payment-confirmations.index');

        } catch (\Exception $e) {
            Alert::error('Error', 'Terjadi kesalahan saat memproses penolakan pembayaran.');
            return redirect()->back();
        }
    }

    /**
     * Download payment proof file
     */
    public function downloadProof(PaymentConfirmation $paymentConfirmation)
    {
        if (!$paymentConfirmation->payment_proof_path || !Storage::disk('public')->exists($paymentConfirmation->payment_proof_path)) {
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