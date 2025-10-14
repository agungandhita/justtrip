<?php

namespace App\Http\Controllers\Frontend;

use Carbon\Carbon;
use App\Models\Booking;
use App\Models\GuestBooking;
use App\Models\Invoice;
use App\Models\Layanan;
use App\Models\SpecialOffer;
use Illuminate\Http\Request;
use App\Services\WhatsAppService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class BookingController extends Controller
{
    protected $whatsAppService;

    public function __construct(WhatsAppService $whatsAppService)
    {
        $this->middleware('auth')->except(['guestCreate', 'guestStore', 'searchDestination', 'guestSuccess']);
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
     * Display guest booking form with all available services and custom booking option
     */
    public function guestCreate()
    {
        // Get all active layanan with price information
        $layananList = Layanan::where('status', 'aktif')
                             ->select('layanan_id', 'nama_layanan', 'harga_mulai', 'deskripsi')
                             ->get();

        // Get all active special offers with detailed information
        $specialOffers = SpecialOffer::where('is_active', true)
                                   ->where('valid_from', '<=', now())
                                   ->where('valid_until', '>=', now())
                                   ->select('id', 'title', 'layanan_id', 'discount_percentage', 'original_price', 'discounted_price')
                                   ->get();

        return view('Frontend.booking.guest-create', compact('layananList', 'specialOffers'));
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
     * Store a new guest booking (without authentication)
     */
    public function guestStore(Request $request)
    {
        // Base validation rules
        $rules = [
            'booking_type' => 'required|in:package,custom',
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'customer_phone' => 'required|string|max:20',
            'customer_address' => 'required|string|max:1000',
            'jumlah_peserta' => 'required|integer|min:1|max:50',
            'tanggal_keberangkatan' => 'required|date|after:today',
            'catatan_khusus' => 'nullable|string|max:1000',
            'terms' => 'required|accepted'
        ];

        // Conditional validation based on booking type
        if ($request->booking_type === 'package') {
            $rules['layanan_id'] = 'required|exists:layanan,layanan_id';
            $rules['special_offer_id'] = 'nullable|exists:special_offers,id';
        } else {
            $rules['custom_destination'] = 'required|string|max:255';
            $rules['custom_description'] = 'required|string|max:1000';
            $rules['custom_budget'] = 'nullable|numeric|min:0';
        }

        $messages = [
            'booking_type.required' => 'Jenis pemesanan wajib dipilih.',
            'customer_name.required' => 'Nama lengkap wajib diisi.',
            'customer_email.required' => 'Email wajib diisi.',
            'customer_email.email' => 'Format email tidak valid.',
            'customer_phone.required' => 'Nomor telepon wajib diisi.',
            'customer_address.required' => 'Alamat lengkap wajib diisi.',
            'jumlah_peserta.required' => 'Jumlah peserta wajib diisi.',
            'jumlah_peserta.min' => 'Jumlah peserta minimal 1 orang.',
            'jumlah_peserta.max' => 'Jumlah peserta maksimal 50 orang.',
            'tanggal_keberangkatan.required' => 'Tanggal keberangkatan wajib diisi.',
            'tanggal_keberangkatan.after' => 'Tanggal keberangkatan harus setelah hari ini.',
            'layanan_id.required' => 'Paket wisata wajib dipilih.',
            'custom_destination.required' => 'Destinasi custom wajib diisi.',
            'custom_description.required' => 'Deskripsi perjalanan wajib diisi.',
            'terms.required' => 'Anda harus menyetujui syarat dan ketentuan.',
            'terms.accepted' => 'Anda harus menyetujui syarat dan ketentuan.'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            Alert::error('Error', 'Data yang Anda masukkan tidak valid. Silakan periksa kembali.');
            return redirect()->back()
                           ->withErrors($validator)
                           ->withInput();
        }

        try {
            DB::beginTransaction();

            $layanan = null;
            $specialOffer = null;
            $originalAmount = 0;
            $discountAmount = 0;

            if ($request->booking_type === 'package') {
                // Package booking
                $layanan = Layanan::findOrFail($request->layanan_id);
                $specialOffer = $request->special_offer_id ? SpecialOffer::findOrFail($request->special_offer_id) : null;

                // Calculate pricing for package booking
                $originalAmount = $layanan->harga_mulai * $request->jumlah_peserta;

                if ($specialOffer) {
                    $discountAmount = ($originalAmount * $specialOffer->discount_percentage) / 100;
                }
            } else {
                // Custom booking - pricing will be determined later
                $originalAmount = $request->custom_budget ? $request->custom_budget * $request->jumlah_peserta : 0;
            }

            $totalAmount = $originalAmount - $discountAmount;

            // Create guest booking with new model
            $booking = GuestBooking::create([
                'booking_number' => GuestBooking::generateBookingNumber(),
                'layanan_id' => $request->booking_type === 'package' ? $request->layanan_id : null,
                'customer_name' => $request->customer_name,
                'customer_email' => $request->customer_email,
                'customer_phone' => $request->customer_phone,
                'departure_date' => $request->tanggal_keberangkatan,
                'number_of_people' => $request->jumlah_peserta,
                'total_price' => $totalAmount,
                'notes' => $request->catatan_khusus,
                'status' => $request->booking_type === 'custom' ? 'consultation' : 'pending'
            ]);

            // Create invoice
            $invoice = $this->createInvoiceForGuest($booking);

            // Send confirmation email
            $this->sendGuestBookingConfirmation($booking);

            // Generate PDF and send to WhatsApp (admin notification)
            $this->processInvoiceAndNotify($invoice);

            // Clear search session data after successful booking
            session()->forget(['search_destination', 'search_departure_date', 'search_participants']);

            DB::commit();

            if ($request->booking_type === 'custom') {
                Alert::success('Berhasil!', 'Permintaan custom booking Anda telah diterima. Tim kami akan menghubungi Anda dalam 24 jam untuk konsultasi lebih lanjut.');
            } else {
                Alert::success('Berhasil!', 'Booking Anda telah berhasil dibuat. Email konfirmasi telah dikirim ke alamat email Anda.');
            }
            
            return redirect()->route('booking.guest.success', $booking->booking_number);

        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Guest booking error: ' . $e->getMessage());
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
     * Create invoice for guest booking
     */
    private function createInvoiceForGuest(GuestBooking $guestBooking)
    {
        $taxAmount = $guestBooking->total_price * 0.11; // PPN 11%
        $finalTotal = $guestBooking->total_price + $taxAmount;

        return Invoice::create([
            'booking_id' => null, // No booking_id for guest bookings
            'invoice_number' => Invoice::generateInvoiceNumber(),
            'invoice_date' => now(),
            'due_date' => now()->addDays(7), // 7 days payment term
            'subtotal' => $guestBooking->total_price,
            'discount_amount' => 0, // Guest bookings don't have separate discount tracking
            'tax_amount' => $taxAmount,
            'total_amount' => $finalTotal,
            'status' => 'draft',
            'notes' => 'Guest Booking: ' . $guestBooking->booking_number
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

    /**
     * Store booking for guest users (without authentication)
     */
    public function storeGuest(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'layanan_id' => 'required|exists:layanan,layanan_id',
            'special_offer_id' => 'nullable|exists:special_offers,id',
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'customer_phone' => 'required|string|max:20',
            'customer_address' => 'required|string|max:500',
            'jumlah_peserta' => 'required|integer|min:1|max:50',
            'tanggal_keberangkatan' => 'required|date|after:today',
            'catatan_khusus' => 'nullable|string|max:1000'
        ], [
            'layanan_id.required' => 'Layanan harus dipilih.',
            'layanan_id.exists' => 'Layanan yang dipilih tidak valid.',
            'customer_name.required' => 'Nama lengkap harus diisi.',
            'customer_email.required' => 'Email harus diisi.',
            'customer_email.email' => 'Format email tidak valid.',
            'customer_phone.required' => 'Nomor telepon harus diisi.',
            'customer_address.required' => 'Alamat harus diisi.',
            'jumlah_peserta.required' => 'Jumlah peserta harus diisi.',
            'jumlah_peserta.min' => 'Jumlah peserta minimal 1 orang.',
            'jumlah_peserta.max' => 'Jumlah peserta maksimal 50 orang.',
            'tanggal_keberangkatan.required' => 'Tanggal keberangkatan harus diisi.',
            'tanggal_keberangkatan.after' => 'Tanggal keberangkatan harus setelah hari ini.',
        ]);

        if ($validator->fails()) {
            Alert::error('Validasi Gagal', 'Mohon periksa kembali data yang Anda masukkan.');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();

        try {
            $layanan = Layanan::findOrFail($request->layanan_id);
            $specialOffer = $request->special_offer_id ? SpecialOffer::find($request->special_offer_id) : null;

            // Calculate pricing
            $originalAmount = $layanan->harga_mulai * $request->jumlah_peserta;
            $discountAmount = 0;

            if ($specialOffer && $specialOffer->isActive()) {
                $discountAmount = ($originalAmount * $specialOffer->discount_percentage) / 100;
            }

            $totalAmount = $originalAmount - $discountAmount;

            // Create booking for guest (user_id = null)
            $booking = Booking::create([
                'user_id' => null, // Guest booking
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

            // Send confirmation email
            $this->sendGuestBookingConfirmation($booking);

            // Generate PDF and send to WhatsApp (admin notification)
            $this->processInvoiceAndNotify($invoice);

            DB::commit();

            Alert::success('Berhasil!', 'Booking Anda telah berhasil dibuat. Email konfirmasi telah dikirim ke alamat email Anda.');
            return redirect()->route('booking.guest.success', $booking->booking_number);

        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Guest booking error: ' . $e->getMessage());
            Alert::error('Error', 'Terjadi kesalahan saat memproses booking: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    /**
     * Show success page for guest booking
     */
    public function guestSuccess($booking_number)
    {
        $booking = GuestBooking::with(['layanan'])
                              ->where('booking_number', $booking_number)
                              ->firstOrFail();

        return view('Frontend.booking.guest-success', compact('booking'));
    }

    /**
     * Handle search destination form submission
     */
    public function searchDestination(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'destination' => 'required|string|max:255',
            'departure_date' => 'required|date|after:today',
            'participants' => 'required|string'
        ]);

        if ($validator->fails()) {
            Alert::error('Error', 'Mohon lengkapi semua field pencarian.');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Store search parameters in session for pre-filling the booking form
        session([
            'search_destination' => $request->destination,
            'search_departure_date' => $request->departure_date,
            'search_participants' => $request->participants
        ]);

        // Redirect to guest booking form (without specific layanan_id)
        return redirect()->route('booking.guest.create');
    }

    /**
     * Show reservation details by booking number
     */
    public function showReservation(Request $request)
    {
        $bookingNumber = $request->get('id');
        
        if (!$bookingNumber) {
            return redirect()->route('home')->with('error', 'Nomor reservasi tidak ditemukan.');
        }

        $booking = Booking::where('booking_number', $bookingNumber)
                         ->with(['layanan', 'invoice'])
                         ->first();

        if (!$booking) {
            return redirect()->route('home')->with('error', 'Reservasi tidak ditemukan.');
        }

        return view('Frontend.booking.reservation', compact('booking'));
    }

    /**
     * Send booking confirmation email to guest
     */
    private function sendGuestBookingConfirmation(Booking $booking)
    {
        try {
            $customerEmail = $booking->customer_info['email'];
            $customerName = $booking->customer_info['name'];
            
            // Use Laravel's Mail facade to send email
            Mail::send('admin.email-templates.booking-confirmation', [
                'booking' => $booking,
                'customer_name' => $customerName
            ], function ($message) use ($customerEmail, $customerName, $booking) {
                $message->to($customerEmail, $customerName)
                        ->subject('Konfirmasi Booking - ' . $booking->booking_number);
            });

        } catch (\Exception $e) {
            Log::error('Failed to send guest booking confirmation email: ' . $e->getMessage());
        }
    }


}
