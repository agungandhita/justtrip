<?php

namespace App\Http\Controllers;

use App\Mail\GuestBookingFeedback;
use App\Models\GuestBooking;
use App\Models\Layanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class GuestBookingController extends Controller
{
    /**
     * Tampilkan form pencarian destinasi
     */
    public function index()
    {
        return view('Frontend.guest-booking.index');
    }

    /**
     * Cari destinasi dan tampilkan hasil (alias untuk searchDestination)
     */
    public function search(Request $request)
    {
        return $this->searchDestination($request);
    }

    /**
     * Cari destinasi berdasarkan input user
     */
    public function searchDestination(Request $request)
    {
        $request->validate([
            'destinasi' => 'required|string|min:3'
        ], [
            'destinasi.required' => 'Destinasi wajib diisi',
            'destinasi.min' => 'Destinasi minimal 3 karakter'
        ]);

        $destinasi = $request->destinasi;

        // Cari layanan yang cocok dengan destinasi
        $layananTersedia = Layanan::where('status', 'aktif')
            ->where(function($query) use ($destinasi) {
                $query->where('nama_layanan', 'LIKE', "%{$destinasi}%")
                      ->orWhere('lokasi_tujuan', 'LIKE', "%{$destinasi}%")
                      ->orWhere('deskripsi', 'LIKE', "%{$destinasi}%");
            })
            ->get();

        return view('Frontend.guest-booking.search-result', [
            'destinasi' => $destinasi,
            'layananTersedia' => $layananTersedia,
            'isAvailable' => $layananTersedia->count() > 0
        ]);
    }

    /**
     * Tampilkan form booking (alias untuk showBookingForm)
     */
    public function showForm(Request $request)
    {
        return $this->showBookingForm($request);
    }

    /**
     * Tampilkan form booking lengkap
     */
    public function showBookingForm(Request $request)
    {
        $destinasi = $request->destinasi;
        $layananId = $request->layanan_id;
        $isCustom = $request->is_custom ?? false;

        $layanan = null;
        if ($layananId && !$isCustom) {
            $layanan = Layanan::find($layananId);
        }

        return view('Frontend.guest-booking.form', [
            'destinasi' => $destinasi,
            'layanan' => $layanan,
            'isCustom' => $isCustom
        ]);
    }

    /**
     * Simpan booking guest
     */
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate(
            GuestBooking::validationRules(),
            GuestBooking::validationMessages()
        );

        try {
            DB::beginTransaction();

            // Generate booking number
            $bookingNumber = GuestBooking::generateBookingNumber();

            // Ambil layanan_id dan is_custom_request dari form
            $layananId = $request->input('layanan_id');
            $isCustomRequest = $request->input('is_custom_request', false);

            // Debug log
            Log::info('Debug booking data:', [
                'layanan_id_raw' => $layananId,
                'is_custom_request_raw' => $isCustomRequest,
                'all_input' => $request->all()
            ]);

            // Convert string to boolean for is_custom_request
            if ($isCustomRequest === '1' || $isCustomRequest === 1) {
                $isCustomRequest = true;
                $layananId = null; // Custom request tidak memiliki layanan_id
            } else {
                $isCustomRequest = false;
            }

            Log::info('Debug booking data after processing:', [
                'layanan_id_final' => $layananId,
                'is_custom_request_final' => $isCustomRequest
            ]);

            // Simpan guest booking
            $guestBooking = GuestBooking::create([
                'booking_number' => $bookingNumber,
                'destinasi_dicari' => $validated['destinasi_dicari'],
                'layanan_id' => $layananId,
                'is_custom_request' => $isCustomRequest,
                'nama_lengkap' => $validated['nama_lengkap'],
                'email' => $validated['email'],
                'nomor_telepon' => $validated['nomor_telepon'],
                'alamat' => $validated['alamat'],
                'kota' => $validated['kota'],
                'provinsi' => $validated['provinsi'],
                'kode_pos' => $validated['kode_pos'] ?? null,
                'jumlah_peserta' => $validated['jumlah_peserta'],
                'tanggal_keberangkatan_diinginkan' => $validated['tanggal_keberangkatan_diinginkan'],
                'durasi_hari_diinginkan' => $validated['durasi_hari_diinginkan'] ?? null,
                'budget_estimasi' => $validated['budget_estimasi'] ?? null,
                'kebutuhan_khusus' => $validated['kebutuhan_khusus'] ?? null,
                'catatan_tambahan' => $validated['catatan_tambahan'] ?? null,
                'status' => 'baru'
            ]);

            // Kirim email konfirmasi ke user
            $this->sendConfirmationEmail($guestBooking);

            // Kirim notifikasi ke admin (bisa via email atau WhatsApp)
            $this->notifyAdmin($guestBooking);
            Mail::to($validated['email'])->send(new GuestBookingFeedback(
                datas: $validated
            ));
            DB::commit();

            Alert::success('Berhasil!', 'Booking Anda telah berhasil dikirim. Kami akan menghubungi Anda segera.');

            return redirect()->route('guest-booking.success', ['booking_number' => $bookingNumber]);

        } catch (\Exception $e) {
            DB::rollback();
            dd($e->getMessage());
            Log::error('Error creating guest booking: ' . $e->getMessage());

            Alert::error('Gagal!', 'Terjadi kesalahan saat memproses booking Anda. Silakan coba lagi.');

            return back()->withInput();
        }
    }

    /**
     * Tampilkan halaman sukses booking
     */
    public function success($bookingNumber)
    {
        $guestBooking = GuestBooking::where('booking_number', $bookingNumber)->firstOrFail();

        return view('Frontend.guest-booking.success', [
            'guestBooking' => $guestBooking
        ]);
    }

    /**
     * Kirim email konfirmasi ke user
     */
    private function sendConfirmationEmail(GuestBooking $guestBooking)
    {
        try {
            Mail::send('emails.guest-booking-confirmation', [
                'guestBooking' => $guestBooking
            ], function ($message) use ($guestBooking) {
                $message->to($guestBooking->email, $guestBooking->nama_lengkap)
                        ->subject('Konfirmasi Booking #' . $guestBooking->booking_number . ' - JustTrip')
                        ->from(config('mail.from.address', 'noreply@justtrip.com'), config('mail.from.name', 'JustTrip'));
            });
        } catch (\Exception $e) {
            Log::error('Failed to send confirmation email: ' . $e->getMessage());
        }
    }

    /**
     * Kirim notifikasi ke admin
     */
    private function notifyAdmin(GuestBooking $guestBooking)
    {
        try {
            // Send email to admin
            $adminEmail = config('mail.admin_email', 'admin@justtrip.com');

            Mail::send('emails.admin-guest-booking-notification', [
                'guestBooking' => $guestBooking
            ], function ($message) use ($guestBooking, $adminEmail) {
                $subject = $guestBooking->is_custom_request
                    ? 'PERMINTAAN KHUSUS BARU #' . $guestBooking->booking_number
                    : 'BOOKING BARU #' . $guestBooking->booking_number;

                $message->to($adminEmail)
                        ->subject($subject . ' - JustTrip Admin')
                        ->from(config('mail.from.address', 'system@justtrip.com'), 'JustTrip System')
                        ->priority(1); // High priority
            });

            // TODO: Add WhatsApp notification when WhatsAppService method is available

        } catch (\Exception $e) {
            Log::error('Failed to notify admin: ' . $e->getMessage());
        }
    }

    /**
     * API untuk mendapatkan layanan berdasarkan destinasi (untuk AJAX)
     */
    public function getLayananByDestination(Request $request)
    {
        $destinasi = $request->get('destinasi');

        if (!$destinasi) {
            return response()->json([
                'success' => false,
                'message' => 'Destinasi tidak boleh kosong'
            ]);
        }

        $layanan = Layanan::where('status', 'aktif')
            ->where(function($query) use ($destinasi) {
                $query->where('nama_layanan', 'LIKE', "%{$destinasi}%")
                      ->orWhere('lokasi_tujuan', 'LIKE', "%{$destinasi}%")
                      ->orWhere('deskripsi', 'LIKE', "%{$destinasi}%");
            })
            ->select('layanan_id', 'nama_layanan', 'lokasi_tujuan', 'harga_mulai', 'durasi_hari')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $layanan,
            'count' => $layanan->count()
        ]);
    }

    /**
     * Admin: Tampilkan daftar guest bookings
     */
    public function adminIndex(Request $request)
    {
        $query = GuestBooking::with('layanan');

        // Filter berdasarkan status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter berdasarkan tipe booking
        if ($request->filled('type')) {
            if ($request->type === 'custom') {
                $query->where('is_custom_request', true);
            } elseif ($request->type === 'package') {
                $query->where('is_custom_request', false);
            }
        }

        // Filter berdasarkan tanggal
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama_lengkap', 'LIKE', "%{$search}%")
                  ->orWhere('email', 'LIKE', "%{$search}%")
                  ->orWhere('no_telepon', 'LIKE', "%{$search}%")
                  ->orWhere('booking_number', 'LIKE', "%{$search}%")
                  ->orWhere('destinasi_dicari', 'LIKE', "%{$search}%");
            });
        }

        $guestBookings = $query->orderBy('created_at', 'desc')->paginate(20);

        return view('admin.guest-bookings.index', compact('guestBookings'));
    }

    /**
     * Admin: Tampilkan detail guest booking
     */
    public function adminShow(GuestBooking $guestBooking)
    {
        $guestBooking->load('layanan');
        return view('admin.guest-bookings.show', compact('guestBooking'));
    }

    /**
     * Admin: Update status guest booking
     */
    public function updateStatus(Request $request, GuestBooking $guestBooking)
    {
        // Gunakan enum status sesuai definisi kolom di database
        $request->validate([
            'status' => 'required|in:baru,diproses,dikonfirmasi,ditolak,selesai',
            'admin_notes' => 'nullable|string'
        ]);

        $guestBooking->update([
            'status' => $request->status,
            'admin_notes' => $request->admin_notes
        ]);

        return redirect()->back()->with('success', 'Status berhasil diupdate');
    }

    /**
     * Admin: Contact via WhatsApp
     */
    public function contactViaWhatsApp(GuestBooking $guestBooking)
    {
        $message = "Halo {$guestBooking->nama_lengkap}, terima kasih telah menghubungi JustTrip untuk booking #{$guestBooking->booking_number}. Tim kami akan segera membantu Anda.";

        $whatsappUrl = "https://wa.me/{$guestBooking->no_telepon}?text=" . urlencode($message);

        return redirect($whatsappUrl);
    }

    /**
     * Admin: Send custom email
     */
    public function sendCustomEmail(Request $request, GuestBooking $guestBooking)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'message' => 'required|string'
        ]);

        try {
            Mail::raw($request->message, function ($mail) use ($request, $guestBooking) {
                $mail->to($guestBooking->email, $guestBooking->nama_lengkap)
                     ->subject($request->subject)
                     ->from(config('mail.from.address', 'admin@justtrip.com'), 'JustTrip Admin');
            });

            return redirect()->back()->with('success', 'Email berhasil dikirim');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal mengirim email: ' . $e->getMessage());
        }
    }

    /**
     * Admin: Export to Excel
     */
    public function exportExcel(Request $request)
    {
        // TODO: Implement Excel export functionality
        return redirect()->back()->with('info', 'Fitur export Excel akan segera tersedia');
    }

    /**
     * Admin: Get statistics
     */
    public function getStatistics()
    {
        // Mengembalikan statistik dengan kunci yang konsisten di frontend,
        // memetakan ke enum status di database.
        $stats = [
            'total' => GuestBooking::count(),
            'pending' => GuestBooking::where('status', 'baru')->count(),
            'confirmed' => GuestBooking::where('status', 'dikonfirmasi')->count(),
            'custom_requests' => GuestBooking::where('is_custom_request', true)->count(),
            'package_bookings' => GuestBooking::where('is_custom_request', false)->count(),
            'this_month' => GuestBooking::whereMonth('created_at', now()->month)->count(),
            'this_week' => GuestBooking::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count(),
        ];

        return response()->json($stats);
    }
}
