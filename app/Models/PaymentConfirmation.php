<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;

class PaymentConfirmation extends Model
{
    protected $table = 'payment_confirmations';
    protected $primaryKey = 'payment_confirmation_id';

    protected $fillable = [
        'booking_id',
        'invoice_id',
        'payment_method',
        'bank_name',
        'account_number',
        'account_holder_name',
        'e_wallet_type',
        'e_wallet_number',
        'payment_amount',
        'payment_date',
        'payment_proof_path',
        'payment_notes',
        'status',
        'admin_notes',
        'confirmed_by',
        'confirmed_at',
        'processed_at',
        'processed_by'
    ];

    protected $casts = [
        'payment_amount' => 'decimal:2',
        'payment_date' => 'datetime',
        'confirmed_at' => 'datetime',
        'processed_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    // Relationships
    public function booking(): BelongsTo
    {
        return $this->belongsTo(Booking::class, 'booking_id', 'booking_id');
    }

    public function invoice(): BelongsTo
    {
        return $this->belongsTo(Invoice::class, 'invoice_id', 'invoice_id');
    }

    public function confirmedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'confirmed_by', 'id');
    }

    // Scopes
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    public function scopeRejected($query)
    {
        return $query->where('status', 'rejected');
    }

    public function scopeBankTransfer($query)
    {
        return $query->where('payment_method', 'bank_transfer');
    }

    public function scopeEWallet($query)
    {
        return $query->where('payment_method', 'e_wallet');
    }

    // Accessors
    public function getPaymentMethodNameAttribute()
    {
        return match($this->payment_method) {
            'bank_transfer' => 'Transfer Bank',
            'e_wallet' => 'E-Wallet',
            'cash' => 'Tunai',
            'other' => 'Lainnya',
            default => 'Tidak Diketahui'
        };
    }

    public function getStatusNameAttribute()
    {
        return match($this->status) {
            'pending' => 'Menunggu Konfirmasi',
            'approved' => 'Disetujui',
            'rejected' => 'Ditolak',
            default => 'Tidak Diketahui'
        };
    }

    public function getPaymentProofUrlAttribute()
    {
        if ($this->payment_proof_path) {
            return asset('storage/' . $this->payment_proof_path);
        }
        return null;
    }

    // Methods
    public function approve($adminId, $notes = null)
    {
        $this->update([
            'status' => 'approved',
            'confirmed_by' => $adminId,
            'confirmed_at' => now(),
            'processed_by' => $adminId,
            'processed_at' => now(),
            'admin_notes' => $notes
        ]);

        // Update related invoice status
        $this->invoice->update([
            'status' => 'paid',
            'paid_at' => now()
        ]);

        // Update booking status to completed
        $this->booking->update([
            'status' => 'completed'
        ]);
    }

    public function reject($adminId, $notes)
    {
        $this->update([
            'status' => 'rejected',
            'processed_by' => $adminId,
            'processed_at' => now(),
            'admin_notes' => $notes
        ]);

        // Update invoice status back to awaiting payment
        $this->invoice->update([
            'status' => 'awaiting_payment'
        ]);

        // Update booking status back to approved (so user can upload again)
        $this->booking->update([
            'status' => 'approved'
        ]);
    }

    public function isPending()
    {
        return $this->status === 'pending';
    }

    public function isApproved()
    {
        return $this->status === 'approved';
    }

    public function isRejected()
    {
        return $this->status === 'rejected';
    }
}