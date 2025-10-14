<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Carbon\Carbon;

class Booking extends Model
{
    protected $table = 'bookings';
    protected $primaryKey = 'booking_id';

    protected $fillable = [
        'user_id',
        'layanan_id',
        'special_offer_id',
        'booking_number',
        'booking_date',
        'original_amount',
        'discount_amount',
        'total_amount',
        'status',
        'customer_info',
        'custom_booking_info',
        'jumlah_peserta',
        'tanggal_keberangkatan',
        'catatan_khusus',
        'admin_notes',
        'confirmed_at',
        'cancelled_at',
        'approved_at',
        'rejected_at',
        'approved_by',
        'rejected_by',
        'rejection_reason'
    ];

    protected $casts = [
        'booking_date' => 'datetime',
        'tanggal_keberangkatan' => 'date',
        'original_amount' => 'decimal:2',
        'discount_amount' => 'decimal:2',
        'total_amount' => 'decimal:2',
        'customer_info' => 'array',
        'custom_booking_info' => 'array',
        'confirmed_at' => 'datetime',
        'cancelled_at' => 'datetime',
        'approved_at' => 'datetime',
        'rejected_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    // Relationships
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function layanan(): BelongsTo
    {
        return $this->belongsTo(Layanan::class, 'layanan_id', 'layanan_id');
    }

    public function specialOffer(): BelongsTo
    {
        return $this->belongsTo(SpecialOffer::class, 'special_offer_id');
    }

    public function invoice(): HasOne
    {
        return $this->hasOne(Invoice::class, 'booking_id', 'booking_id');
    }

    public function paymentConfirmations()
    {
        return $this->hasMany(PaymentConfirmation::class, 'booking_id', 'booking_id');
    }

    public function approvedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by', 'id');
    }

    public function rejectedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'rejected_by', 'id');
    }

    // Scopes
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeConfirmed($query)
    {
        return $query->where('status', 'confirmed');
    }

    public function scopeCancelled($query)
    {
        return $query->where('status', 'cancelled');
    }

    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    public function scopeRejected($query)
    {
        return $query->where('status', 'rejected');
    }

    public function scopeAwaitingPayment($query)
    {
        return $query->where('status', 'awaiting_payment');
    }

    public function scopePaymentUploaded($query)
    {
        return $query->where('status', 'payment_uploaded');
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    // Accessors
    public function getFormattedTotalAmountAttribute()
    {
        return 'Rp ' . number_format($this->total_amount, 0, ',', '.');
    }

    public function getFormattedBookingDateAttribute()
    {
        return $this->booking_date->format('d M Y H:i');
    }

    public function getFormattedTanggalKeberangkatanAttribute()
    {
        return $this->tanggal_keberangkatan->format('d M Y');
    }

    public function getStatusLabelAttribute()
    {
        $labels = [
            'pending' => 'Menunggu Konfirmasi',
            'confirmed' => 'Dikonfirmasi',
            'cancelled' => 'Dibatalkan',
            'completed' => 'Selesai'
        ];

        return $labels[$this->status] ?? $this->status;
    }

    public function getStatusColorAttribute()
    {
        $colors = [
            'pending' => 'warning',
            'confirmed' => 'success',
            'cancelled' => 'danger',
            'completed' => 'info'
        ];

        return $colors[$this->status] ?? 'secondary';
    }

    // Methods
    public static function generateBookingNumber()
    {
        $prefix = 'BK';
        $date = now()->format('Ymd');
        $lastBooking = self::whereDate('created_at', today())
            ->orderBy('booking_id', 'desc')
            ->first();

        $sequence = $lastBooking ? (int)substr($lastBooking->booking_number, -4) + 1 : 1;

        return $prefix . $date . str_pad($sequence, 4, '0', STR_PAD_LEFT);
    }

    public function confirm()
    {
        $this->update([
            'status' => 'confirmed',
            'confirmed_at' => now()
        ]);
    }

    public function cancel($reason = null)
    {
        $this->update([
            'status' => 'cancelled',
            'cancelled_at' => now(),
            'admin_notes' => $reason
        ]);
    }

    public function complete()
    {
        $this->update([
            'status' => 'completed'
        ]);
    }

    public function approve($adminId)
    {
        $this->update([
            'status' => 'approved',
            'approved_at' => now(),
            'approved_by' => $adminId
        ]);

        // Update invoice status to awaiting payment
        if ($this->invoice) {
            $this->invoice->update([
                'status' => 'awaiting_payment'
            ]);
        }
    }

    public function reject($adminId, $reason)
    {
        $this->update([
            'status' => 'rejected',
            'rejected_at' => now(),
            'rejected_by' => $adminId,
            'rejection_reason' => $reason
        ]);

        // Update invoice status to cancelled
        if ($this->invoice) {
            $this->invoice->update([
                'status' => 'cancelled'
            ]);
        }
    }

    public function calculateDiscount()
    {
        if ($this->specialOffer) {
            $discountPercentage = $this->specialOffer->discount_percentage;
            return ($this->original_amount * $discountPercentage) / 100;
        }

        return 0;
    }

    public function calculateTotal()
    {
        return $this->original_amount - $this->discount_amount;
    }
}
