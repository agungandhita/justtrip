<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;

class PaymentConfirmation extends Model
{
    use HasUuids;

    protected $table = 'payment_confirmations';
    protected $primaryKey = 'payment_confirmation_id';

    /**
     * Get the route key for the model.
     * This ensures route model binding uses the correct primary key.
     */
    public function getRouteKeyName()
    {
        return 'payment_confirmation_id';
    }

    protected $fillable = [
        'booking_id',
        'invoice_id',
        'destination_bank',
        'sender_bank_name',
        'sender_account_number',
        'sender_account_holder',
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

    // Bank destination info for PT TRISULA PANDU NUSANTARA
    public const BANK_ACCOUNTS = [
        'mandiri' => [
            'name' => 'Bank Mandiri',
            'account_number' => '1780006783464',
            'account_holder' => 'PT TRISULA PANDU NUSANTARA'
        ],
        'bca' => [
            'name' => 'Bank BCA',
            'account_number' => '3305279999',
            'account_holder' => 'PT TRISULA PANDU NUSANTARA'
        ]
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

    // Accessors
    public function getDestinationBankInfoAttribute()
    {
        return self::BANK_ACCOUNTS[$this->destination_bank] ?? null;
    }

    public function getDestinationBankNameAttribute()
    {
        return self::BANK_ACCOUNTS[$this->destination_bank]['name'] ?? 'Unknown';
    }

    public function getDestinationAccountNumberAttribute()
    {
        return self::BANK_ACCOUNTS[$this->destination_bank]['account_number'] ?? '';
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

        // Delete old PDF so it will be regenerated with 'PAID' status
        if ($this->invoice->pdf_path) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($this->invoice->pdf_path);
            $this->invoice->update(['pdf_path' => null]);
        }

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

        // Delete old PDF so it will be regenerated with correct status
        if ($this->invoice->pdf_path) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($this->invoice->pdf_path);
            $this->invoice->update(['pdf_path' => null]);
        }

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