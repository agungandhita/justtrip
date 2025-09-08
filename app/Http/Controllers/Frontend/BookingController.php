<?php

namespace App\Http\Controllers\Frontend;

use Carbon\Carbon;
use App\Models\Booking;
use App\Models\Invoice;
use App\Models\Layanan;
use App\Models\SpecialOffer;
use Illuminate\Http\Request;
use App\Services\WhatsAppService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class BookingController extends Controller
{
    protected $whatsAppService;

    public function __construct(WhatsAppService $whatsAppService)
    {
        $this->middleware('auth');
        $this->whatsAppService = $whatsAppService;
    }

    /**
     * Display booking form for a specific layanan
     */
    public function create(Request $request, $layanan_id)
    {
        $layanan = Layanan::where('layanan_id', $layanan_id)
                         ->where('status', 'aktif')
                         ->firstOrFail();

        // Check if there's an active special offer
        $specialOffer = $layanan->getCurrentSpecialOffer();

        return view('Frontend.booking.create', compact('layanan', 'specialOffer'));
    }

    /**
     * Display booking form for special offer
     */
    public function createFromOffer(Request $request, $offer_id)
    {
        $specialOffer = SpecialOffer::where('id', $offer_id)
                                  ->where('is_active', true)
                                  ->where('valid_until', '>=', now())
                                  ->firstOrFail();

        $layanan = $specialOffer->layanan;

        return view('Frontend.booking.create', compact('layanan', 'specialOffer'));
    }

    /**
     * Store a new booking
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'layanan_id' => 'required|exists:layanan,layanan_id',
            'special_offer_id' => 'nullable|exists:special_offers,id',
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'customer_phone' => 'required|string|max:20',
            'customer_address' => 'required|string',
            'jumlah_peserta' => 'required|integer|min:1|max:50',
            'tanggal_keberangkatan' => 'required|date|after:today',
            'catatan_khusus' => 'nullable|string|max:1000'
        ]);

        if ($validator->fails()) {
            Alert::error('Error', 'Data yang Anda masukkan tidak valid.');
            return redirect()->back()
                           ->withErrors($validator)
                           ->withInput();
        }

        try {
            DB::beginTransaction();

            $layanan = Layanan::findOrFail($request->layanan_id);
            $specialOffer = $request->special_offer_id ? SpecialOffer::findOrFail($request->special_offer_id) : null;

            // Calculate pricing
            $originalAmount = $layanan->harga_mulai * $request->jumlah_peserta;
            $discountAmount = 0;

            if ($specialOffer) {
                $discountAmount = ($originalAmount * $specialOffer->discount_percentage) / 100;
            }

            $totalAmount = $originalAmount - $discountAmount;

            // Create booking
            $booking = Booking::create([
                'user_id' => Auth::id(),
                'layanan_id' => $request->layanan_id,
                'special_offer_id' => $request->special_offer_id,
                'booking_number' => Booking::generateBookingNumber(),
                'booking_date' => now(),
                'original_amount' => $originalAmount,
                'discount_amount' => $discountAmount,
                'total_amount' => $totalAmount,
                'status' => 'pending',
                'customer_info' => [
                    'name' => $request->customer_name,
                    'email' => $request->customer_email,
                    'phone' => $request->customer_phone,
                    'address' => $request->customer_address
                ],
                'jumlah_peserta' => $request->jumlah_peserta,
                'tanggal_keberangkatan' => $request->tanggal_keberangkatan,
                'catatan_khusus' => $request->catatan_khusus
            ]);

            // Create invoice
            $invoice = $this->createInvoice($booking);

            // Generate PDF and send to WhatsApp
            $this->processInvoiceAndNotify($invoice);

            DB::commit();

            Alert::success('Berhasil!', 'Booking Anda telah berhasil dibuat. Invoice telah dikirim ke admin.');
            return redirect()->route('booking.show', $booking->booking_id);

        } catch (\Exception $e) {
            DB::rollback();
            Alert::error('Error', 'Terjadi kesalahan saat memproses booking: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    /**
     * Display booking details
     */
    public function show($booking_id)
    {
        $booking = Booking::with(['layanan', 'specialOffer', 'invoice'])
                         ->where('booking_id', $booking_id)
                         ->where('user_id', Auth::id())
                         ->firstOrFail();

        return view('Frontend.booking.show', compact('booking'));
    }

    /**
     * Display user's booking history
     */
    public function index()
    {
        $bookings = Booking::with(['layanan', 'specialOffer'])
                          ->where('user_id', Auth::id())
                          ->orderBy('created_at', 'desc')
                          ->paginate(10);

        return view('Frontend.booking.index', compact('bookings'));
    }

    /**
     * Display user's bookings for user dashboard
     */
    public function userBookings()
    {
        $bookings = Booking::with(['layanan', 'specialOffer', 'invoice'])
                          ->where('user_id', Auth::id())
                          ->orderBy('created_at', 'desc')
                          ->paginate(10);

        return view('Frontend.user.bookings', compact('bookings'));
    }

    /**
     * Cancel a booking
     */
    public function cancel(Request $request, $booking_id)
    {
        $booking = Booking::where('booking_id', $booking_id)
                         ->where('user_id', Auth::id())
                         ->where('status', 'pending')
                         ->firstOrFail();

        $booking->cancel('Dibatalkan oleh customer');

        if ($booking->invoice) {
            $booking->invoice->cancel();
        }

        Alert::success('Berhasil!', 'Booking Anda telah dibatalkan.');
        return redirect()->route('booking.index');
    }

    /**
     * Create invoice for booking
     */
    private function createInvoice(Booking $booking)
    {
        $taxAmount = $booking->total_amount * 0.11; // PPN 11%
        $finalTotal = $booking->total_amount + $taxAmount;

        return Invoice::create([
            'booking_id' => $booking->booking_id,
            'invoice_number' => Invoice::generateInvoiceNumber(),
            'invoice_date' => now(),
            'due_date' => now()->addDays(7), // 7 days payment term
            'subtotal' => $booking->original_amount,
            'discount_amount' => $booking->discount_amount,
            'tax_amount' => $taxAmount,
            'total_amount' => $finalTotal,
            'status' => 'draft'
        ]);
    }

    /**
     * Process invoice PDF generation and WhatsApp notification
     */
    private function processInvoiceAndNotify(Invoice $invoice)
    {
        try {
            // Generate PDF (will be implemented in InvoiceController)
            $pdfPath = app('App\Http\Controllers\InvoiceController')->generatePDF($invoice);

            // Update invoice with PDF path
            $invoice->update([
                'pdf_path' => $pdfPath,
                'status' => 'sent',
                'sent_at' => now()
            ]);

            // Send to WhatsApp
            $this->whatsAppService->sendInvoiceToAdmin($invoice);

        } catch (\Exception $e) {
            Log::error('Failed to process invoice: ' . $e->getMessage());
            // Don't throw exception to avoid breaking the booking process
        }
    }

    /**
     * Get booking data for AJAX requests
     */
    public function getBookingData(Request $request)
    {
        $layananId = $request->get('layanan_id');
        $specialOfferId = $request->get('special_offer_id');
        $jumlahPeserta = $request->get('jumlah_peserta', 1);

        $layanan = Layanan::findOrFail($layananId);
        $specialOffer = $specialOfferId ? SpecialOffer::find($specialOfferId) : null;

        $originalAmount = $layanan->harga_mulai * $jumlahPeserta;
        $discountAmount = 0;

        if ($specialOffer) {
            $discountAmount = ($originalAmount * $specialOffer->discount_percentage) / 100;
        }

        $totalAmount = $originalAmount - $discountAmount;

        return response()->json([
            'original_amount' => $originalAmount,
            'discount_amount' => $discountAmount,
            'total_amount' => $totalAmount,
            'formatted_original_amount' => 'Rp ' . number_format($originalAmount, 0, ',', '.'),
            'formatted_discount_amount' => 'Rp ' . number_format($discountAmount, 0, ',', '.'),
            'formatted_total_amount' => 'Rp ' . number_format($totalAmount, 0, ',', '.'),
            'discount_percentage' => $specialOffer ? $specialOffer->discount_percentage : 0
        ]);
    }
}
