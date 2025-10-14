<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;

class GuestBooking extends Model
{
    protected $table = 'guest_bookings';
    protected $primaryKey = 'guest_booking_id';

    protected $fillable = [
        'booking_number',
        'destinasi_dicari',
        'layanan_id',
        'is_custom_request',
        'nama_lengkap',
        'email',
        'nomor_telepon',
        'alamat',
        'kota',
        'provinsi',
        'kode_pos',
        'jumlah_peserta',
        'tanggal_keberangkatan_diinginkan',
        'durasi_hari_diinginkan',
        'budget_estimasi',
        'kebutuhan_khusus',
        'catatan_tambahan',
        'status',
        'admin_notes',
        'processed_at',
        'processed_by',
        'confirmed_at',
        'rejected_at',
        'rejection_reason'
    ];

    protected $casts = [
        'tanggal_keberangkatan_diinginkan' => 'date',
        'budget_estimasi' => 'decimal:2',
        'is_custom_request' => 'boolean',
        'processed_at' => 'datetime',
        'confirmed_at' => 'datetime',
        'rejected_at' => 'datetime',
    ];

    // Relationships
    public function layanan(): BelongsTo
    {
        return $this->belongsTo(Layanan::class, 'layanan_id', 'layanan_id');
    }

    public function processedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'processed_by');
    }

    // Scopes
    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    public function scopeCustomRequest($query)
    {
        return $query->where('is_custom_request', true);
    }

    public function scopeWithLayanan($query)
    {
        return $query->where('is_custom_request', false)->whereNotNull('layanan_id');
    }

    // Accessors & Mutators
    public function getFormattedBudgetAttribute()
    {
        return $this->budget_estimasi ? 'Rp ' . number_format($this->budget_estimasi, 0, ',', '.') : 'Tidak disebutkan';
    }

    public function getStatusBadgeAttribute()
    {
        $badges = [
            'baru' => 'bg-blue-100 text-blue-800',
            'diproses' => 'bg-yellow-100 text-yellow-800',
            'dikonfirmasi' => 'bg-green-100 text-green-800',
            'ditolak' => 'bg-red-100 text-red-800',
            'selesai' => 'bg-gray-100 text-gray-800'
        ];

        return $badges[$this->status] ?? 'bg-gray-100 text-gray-800';
    }

    // Methods
    public static function generateBookingNumber()
    {
        $prefix = 'GB';
        $date = Carbon::now()->format('Ymd');
        $lastBooking = self::whereDate('created_at', Carbon::today())
                          ->orderBy('guest_booking_id', 'desc')
                          ->first();
        
        $sequence = $lastBooking ? (int)substr($lastBooking->booking_number, -3) + 1 : 1;
        
        return $prefix . $date . str_pad($sequence, 3, '0', STR_PAD_LEFT);
    }

    public function markAsProcessed($userId = null)
    {
        $this->update([
            'status' => 'diproses',
            'processed_at' => Carbon::now(),
            'processed_by' => $userId
        ]);
    }

    public function markAsConfirmed()
    {
        $this->update([
            'status' => 'dikonfirmasi',
            'confirmed_at' => Carbon::now()
        ]);
    }

    public function markAsRejected($reason = null)
    {
        $this->update([
            'status' => 'ditolak',
            'rejected_at' => Carbon::now(),
            'rejection_reason' => $reason
        ]);
    }

    // Validation rules
    public static function validationRules()
    {
        return [
            'destinasi_dicari' => 'required|string|max:255',
            'layanan_id' => 'nullable|exists:layanan,layanan_id',
            'is_custom_request' => 'nullable|boolean',
            'nama_lengkap' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'nomor_telepon' => 'required|string|max:20',
            'alamat' => 'required|string',
            'kota' => 'required|string|max:100',
            'provinsi' => 'required|string|max:100',
            'kode_pos' => 'nullable|string|max:10',
            'jumlah_peserta' => 'required|integer|min:1|max:50',
            'tanggal_keberangkatan_diinginkan' => 'required|date|after:today',
            'durasi_hari_diinginkan' => 'nullable|integer|min:1|max:365',
            'budget_estimasi' => 'nullable|numeric|min:0',
            'kebutuhan_khusus' => 'nullable|string|max:1000',
            'catatan_tambahan' => 'nullable|string|max:1000'
        ];
    }

    public static function validationMessages()
    {
        return [
            'destinasi_dicari.required' => 'Destinasi yang dicari wajib diisi',
            'nama_lengkap.required' => 'Nama lengkap wajib diisi',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'nomor_telepon.required' => 'Nomor telepon wajib diisi',
            'alamat.required' => 'Alamat wajib diisi',
            'kota.required' => 'Kota wajib diisi',
            'provinsi.required' => 'Provinsi wajib diisi',
            'jumlah_peserta.required' => 'Jumlah peserta wajib diisi',
            'jumlah_peserta.min' => 'Jumlah peserta minimal 1 orang',
            'jumlah_peserta.max' => 'Jumlah peserta maksimal 50 orang',
            'tanggal_keberangkatan_diinginkan.required' => 'Tanggal keberangkatan wajib diisi',
            'tanggal_keberangkatan_diinginkan.after' => 'Tanggal keberangkatan harus setelah hari ini',
            'durasi_hari_diinginkan.min' => 'Durasi minimal 1 hari',
            'budget_estimasi.min' => 'Budget tidak boleh negatif'
        ];
    }
}
