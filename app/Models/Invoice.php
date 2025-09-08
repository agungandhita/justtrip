<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;

class Invoice extends Model
{
    protected $table = 'invoices';
    protected $primaryKey = 'invoice_id';

    protected $fillable = [
        'booking_id',
        'invoice_number',
        'invoice_date',
        'due_date',
        'subtotal',
        'discount_amount',
        'tax_amount',
        'total_amount',
        'status',
        'pdf_path',
        'sent_at',
        'paid_at',
        'payment_details',
        'notes'
    ];

    protected $casts = [
        'invoice_date' => 'date',
        'due_date' => 'date',
        'subtotal' => 'decimal:2',
        'discount_amount' => 'decimal:2',
        'tax_amount' => 'decimal:2',
        'total_amount' => 'decimal:2',
        'sent_at' => 'datetime',
        'paid_at' => 'datetime',
        'payment_details' => 'array',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    // Relationships
    public function booking(): BelongsTo
    {
        return $this->belongsTo(Booking::class, 'booking_id', 'booking_id');
    }

    // Scopes
    public function scopeDraft($query)
    {
        return $query->where('status', 'draft');
    }

    public function scopeSent($query)
    {
        return $query->where('status', 'sent');
    }

    public function scopePaid($query)
    {
        return $query->where('status', 'paid');
    }

    public function scopeOverdue($query)
    {
        return $query->where('status', 'overdue')
                    ->orWhere(function($q) {
                        $q->where('status', 'sent')
                          ->where('due_date', '<', now());
                    });
    }

    // Accessors
    public function getFormattedTotalAmountAttribute()
    {
        return 'Rp ' . number_format($this->total_amount, 0, ',', '.');
    }

    public function getFormattedSubtotalAttribute()
    {
        return 'Rp ' . number_format($this->subtotal, 0, ',', '.');
    }

    public function getFormattedDiscountAmountAttribute()
    {
        return 'Rp ' . number_format($this->discount_amount, 0, ',', '.');
    }

    public function getFormattedTaxAmountAttribute()
    {
        return 'Rp ' . number_format($this->tax_amount, 0, ',', '.');
    }

    public function getFormattedInvoiceDateAttribute()
    {
        return $this->invoice_date->format('d M Y');
    }

    public function getFormattedDueDateAttribute()
    {
        return $this->due_date->format('d M Y');
    }

    public function getStatusLabelAttribute()
    {
        $labels = [
            'draft' => 'Draft',
            'sent' => 'Terkirim',
            'paid' => 'Lunas',
            'overdue' => 'Terlambat',
            'cancelled' => 'Dibatalkan'
        ];

        return $labels[$this->status] ?? $this->status;
    }

    public function getStatusColorAttribute()
    {
        $colors = [
            'draft' => 'secondary',
            'sent' => 'info',
            'paid' => 'success',
            'overdue' => 'danger',
            'cancelled' => 'dark'
        ];

        return $colors[$this->status] ?? 'secondary';
    }

    public function getIsOverdueAttribute()
    {
        return $this->status === 'sent' && $this->due_date < now();
    }

    // Methods
    public static function generateInvoiceNumber()
    {
        $prefix = 'INV';
        $date = now()->format('Ymd');
        $lastInvoice = self::whereDate('created_at', today())
            ->orderBy('invoice_id', 'desc')
            ->first();
        
        $sequence = $lastInvoice ? (int)substr($lastInvoice->invoice_number, -4) + 1 : 1;
        
        return $prefix . $date . str_pad($sequence, 4, '0', STR_PAD_LEFT);
    }

    public function markAsSent()
    {
        $this->update([
            'status' => 'sent',
            'sent_at' => now()
        ]);
    }

    public function markAsPaid($paymentDetails = null)
    {
        $this->update([
            'status' => 'paid',
            'paid_at' => now(),
            'payment_details' => $paymentDetails
        ]);
    }

    public function cancel()
    {
        $this->update([
            'status' => 'cancelled'
        ]);
    }

    public function calculateTax($taxRate = 0.11) // PPN 11%
    {
        return ($this->subtotal - $this->discount_amount) * $taxRate;
    }

    public function calculateTotal()
    {
        return $this->subtotal - $this->discount_amount + $this->tax_amount;
    }
}
