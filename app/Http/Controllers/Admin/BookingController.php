<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\User;
use App\Models\Layanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Carbon\Carbon;

class BookingController extends Controller
{
    /**
     * Display a listing of bookings with filters and search
     */
    public function index(Request $request)
    {
        $query = Booking::with(['user', 'layanan', 'specialOffer']);
        
        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('booking_number', 'like', "%{$search}%")
                  ->orWhereHas('user', function($userQuery) use ($search) {
                      $userQuery->where('name', 'like', "%{$search}%")
                               ->orWhere('email', 'like', "%{$search}%");
                  })
                  ->orWhereHas('layanan', function($layananQuery) use ($search) {
                      $layananQuery->where('nama_layanan', 'like', "%{$search}%");
                  });
            });
        }
        
        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        
        // Filter by date range
        if ($request->filled('date_from')) {
            $query->whereDate('booking_date', '>=', $request->date_from);
        }
        
        if ($request->filled('date_to')) {
            $query->whereDate('booking_date', '<=', $request->date_to);
        }
        
        // Filter by departure date
        if ($request->filled('departure_from')) {
            $query->whereDate('tanggal_keberangkatan', '>=', $request->departure_from);
        }
        
        if ($request->filled('departure_to')) {
            $query->whereDate('tanggal_keberangkatan', '<=', $request->departure_to);
        }
        
        // Filter by service type
        if ($request->filled('layanan_id')) {
            $query->where('layanan_id', $request->layanan_id);
        }
        
        // Sort by latest first
        $bookings = $query->latest('booking_date')->paginate(15);
        
        // Get filter options
        $layananOptions = Layanan::where('status', 'aktif')->get(['layanan_id', 'nama_layanan']);
        $statusOptions = [
            'pending' => 'Menunggu Konfirmasi',
            'confirmed' => 'Dikonfirmasi',
            'cancelled' => 'Dibatalkan',
            'completed' => 'Selesai'
        ];
        
        // Statistics for dashboard cards
        $statistics = [
            'total' => Booking::count(),
            'pending' => Booking::where('status', 'pending')->count(),
            'confirmed' => Booking::where('status', 'confirmed')->count(),
            'cancelled' => Booking::where('status', 'cancelled')->count(),
            'completed' => Booking::where('status', 'completed')->count(),
            'today' => Booking::whereDate('booking_date', today())->count(),
            'this_month' => Booking::whereMonth('booking_date', now()->month)->count(),
            'total_revenue' => Booking::whereIn('status', ['confirmed', 'completed'])->sum('total_amount')
        ];
        
        return view('admin.bookings.index', compact(
            'bookings', 
            'layananOptions', 
            'statusOptions', 
            'statistics'
        ));
    }
    
    /**
     * Display the specified booking details
     */
    public function show(Booking $booking)
    {
        $booking->load(['user', 'layanan', 'specialOffer', 'invoice']);
        
        // Get audit trail (booking history)
        $auditTrail = $this->getBookingAuditTrail($booking);
        
        return view('admin.bookings.show', compact('booking', 'auditTrail'));
    }
    
    /**
     * Show the form for editing the specified booking
     */
    public function edit(Booking $booking)
    {
        $booking->load(['user', 'layanan', 'specialOffer']);
        $layananOptions = Layanan::where('status', 'aktif')->get();
        
        return view('admin.bookings.edit', compact('booking', 'layananOptions'));
    }
    
    /**
     * Update the specified booking
     */
    public function update(Request $request, Booking $booking)
    {
        $request->validate([
            'jumlah_peserta' => 'required|integer|min:1',
            'tanggal_keberangkatan' => 'required|date|after:today',
            'catatan_khusus' => 'nullable|string|max:1000',
            'admin_notes' => 'nullable|string|max:1000',
            'customer_info.nama' => 'required|string|max:255',
            'customer_info.email' => 'required|email|max:255',
            'customer_info.phone' => 'required|string|max:20',
            'customer_info.alamat' => 'required|string|max:500'
        ]);
        
        DB::beginTransaction();
        
        try {
            // Store original data for audit trail
            $originalData = $booking->toArray();
            
            // Update booking data
            $booking->update([
                'jumlah_peserta' => $request->jumlah_peserta,
                'tanggal_keberangkatan' => $request->tanggal_keberangkatan,
                'catatan_khusus' => $request->catatan_khusus,
                'admin_notes' => $request->admin_notes,
                'customer_info' => $request->customer_info
            ]);
            
            // Recalculate total if participants changed
            if ($originalData['jumlah_peserta'] != $request->jumlah_peserta) {
                $newTotal = $booking->layanan->harga_mulai * $request->jumlah_peserta;
                $booking->update([
                    'original_amount' => $newTotal,
                    'total_amount' => $newTotal - $booking->discount_amount
                ]);
            }
            
            // Log audit trail
            $this->logBookingChange($booking, 'updated', $originalData, $booking->toArray());
            
            DB::commit();
            
            Alert::success('Berhasil!', 'Data booking berhasil diperbarui.');
            return redirect()->route('admin.bookings.show', $booking);
            
        } catch (\Exception $e) {
            DB::rollback();
            Alert::error('Gagal!', 'Terjadi kesalahan saat memperbarui booking.');
            return back()->withInput();
        }
    }
    
    /**
     * Confirm/Approve booking
     */
    public function confirm(Request $request, Booking $booking)
    {
        if ($booking->status !== 'pending') {
            Alert::error('Gagal!', 'Booking ini tidak dapat dikonfirmasi.');
            return back();
        }
        
        DB::beginTransaction();
        
        try {
            $booking->confirm();
            
            // Log audit trail
            $this->logBookingChange($booking, 'confirmed', [], [], $request->admin_notes);
            
            // Send notification (implement later)
            // $this->sendBookingNotification($booking, 'confirmed');
            
            DB::commit();
            
            Alert::success('Berhasil!', 'Booking berhasil dikonfirmasi.');
            return back();
            
        } catch (\Exception $e) {
            DB::rollback();
            Alert::error('Gagal!', 'Terjadi kesalahan saat mengkonfirmasi booking.');
            return back();
        }
    }
    
    /**
     * Reject/Cancel booking
     */
    public function reject(Request $request, Booking $booking)
    {
        $request->validate([
            'reason' => 'required|string|max:500'
        ]);
        
        if (!in_array($booking->status, ['pending', 'confirmed'])) {
            Alert::error('Gagal!', 'Booking ini tidak dapat dibatalkan.');
            return back();
        }
        
        DB::beginTransaction();
        
        try {
            $booking->cancel($request->reason);
            
            // Log audit trail
            $this->logBookingChange($booking, 'cancelled', [], [], $request->reason);
            
            // Send notification (implement later)
            // $this->sendBookingNotification($booking, 'cancelled');
            
            DB::commit();
            
            Alert::success('Berhasil!', 'Booking berhasil dibatalkan.');
            return back();
            
        } catch (\Exception $e) {
            DB::rollback();
            Alert::error('Gagal!', 'Terjadi kesalahan saat membatalkan booking.');
            return back();
        }
    }
    
    /**
     * Mark booking as completed
     */
    public function complete(Booking $booking)
    {
        if ($booking->status !== 'confirmed') {
            Alert::error('Gagal!', 'Hanya booking yang dikonfirmasi yang dapat diselesaikan.');
            return back();
        }
        
        DB::beginTransaction();
        
        try {
            $booking->complete();
            
            // Log audit trail
            $this->logBookingChange($booking, 'completed');
            
            // Send notification (implement later)
            // $this->sendBookingNotification($booking, 'completed');
            
            DB::commit();
            
            Alert::success('Berhasil!', 'Booking berhasil diselesaikan.');
            return back();
            
        } catch (\Exception $e) {
            DB::rollback();
            Alert::error('Gagal!', 'Terjadi kesalahan saat menyelesaikan booking.');
            return back();
        }
    }
    
    /**
     * Get booking statistics for dashboard
     */
    public function getStatistics(Request $request)
    {
        $period = $request->get('period', 'month'); // day, week, month, year
        
        $startDate = match($period) {
            'day' => now()->startOfDay(),
            'week' => now()->startOfWeek(),
            'month' => now()->startOfMonth(),
            'year' => now()->startOfYear(),
            default => now()->startOfMonth()
        };
        
        $bookings = Booking::where('booking_date', '>=', $startDate);
        
        $statistics = [
            'total_bookings' => $bookings->count(),
            'pending_bookings' => $bookings->where('status', 'pending')->count(),
            'confirmed_bookings' => $bookings->where('status', 'confirmed')->count(),
            'cancelled_bookings' => $bookings->where('status', 'cancelled')->count(),
            'completed_bookings' => $bookings->where('status', 'completed')->count(),
            'total_revenue' => $bookings->whereIn('status', ['confirmed', 'completed'])->sum('total_amount'),
            'average_booking_value' => $bookings->whereIn('status', ['confirmed', 'completed'])->avg('total_amount') ?? 0
        ];
        
        return response()->json($statistics);
    }
    
    /**
     * Export bookings to CSV/Excel
     */
    public function export(Request $request)
    {
        // Implementation for export functionality
        // This can be implemented later with Laravel Excel package
    }
    
    /**
     * Get booking audit trail
     */
    private function getBookingAuditTrail(Booking $booking)
    {
        // For now, return basic timeline based on booking status changes
        $timeline = [];
        
        // Created
        $timeline[] = [
            'action' => 'created',
            'description' => 'Booking dibuat oleh ' . $booking->user->name,
            'timestamp' => $booking->created_at,
            'user' => $booking->user->name,
            'status' => 'pending'
        ];
        
        // Confirmed
        if ($booking->confirmed_at) {
            $timeline[] = [
                'action' => 'confirmed',
                'description' => 'Booking dikonfirmasi oleh admin',
                'timestamp' => $booking->confirmed_at,
                'user' => 'Admin',
                'status' => 'confirmed'
            ];
        }
        
        // Cancelled
        if ($booking->cancelled_at) {
            $timeline[] = [
                'action' => 'cancelled',
                'description' => 'Booking dibatalkan',
                'timestamp' => $booking->cancelled_at,
                'user' => 'Admin',
                'status' => 'cancelled',
                'notes' => $booking->admin_notes
            ];
        }
        
        // Completed
        if ($booking->status === 'completed') {
            $timeline[] = [
                'action' => 'completed',
                'description' => 'Booking diselesaikan',
                'timestamp' => $booking->updated_at,
                'user' => 'Admin',
                'status' => 'completed'
            ];
        }
        
        return collect($timeline)->sortBy('timestamp');
    }
    
    /**
     * Log booking changes for audit trail
     */
    private function logBookingChange(Booking $booking, string $action, array $oldData = [], array $newData = [], string $notes = null)
    {
        // This would typically log to a separate audit_logs table
        // For now, we'll just update the admin_notes field
        $logEntry = "[" . now()->format('Y-m-d H:i:s') . "] " . 
                   ucfirst($action) . " by " . Auth::user()->name;
        
        if ($notes) {
            $logEntry .= " - " . $notes;
        }
        
        $currentNotes = $booking->admin_notes ? $booking->admin_notes . "\n" : '';
        $booking->update(['admin_notes' => $currentNotes . $logEntry]);
    }
    
    /**
     * Send booking notification (placeholder for future implementation)
     */
    private function sendBookingNotification(Booking $booking, string $status)
    {
        // Implementation for sending notifications
        // This can include email, SMS, or push notifications
    }
}