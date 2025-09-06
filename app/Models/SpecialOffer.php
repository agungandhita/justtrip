<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SpecialOffer extends Model
{
    protected $fillable = [
        'layanan_id',
        'title',
        'slug',
        'description',
        'original_price',
        'discounted_price',
        'discount_percentage',
        'main_image',
        'gallery_images',
        'valid_from',
        'valid_until',
        'terms_conditions',
        'max_bookings',
        'current_bookings',
        'is_featured',
        'is_active',
        'badge_text',
        'badge_color',
        'meta_title',
        'meta_description'
    ];

    protected $casts = [
        'gallery_images' => 'array',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'original_price' => 'decimal:2',
        'discounted_price' => 'decimal:2',
        'valid_from' => 'date',
        'valid_until' => 'date'
    ];

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeValid($query)
    {
        return $query->where('valid_from', '<=', now())
                    ->where('valid_until', '>=', now());
    }

    // Relationships
    public function layanan()
    {
        return $this->belongsTo(Layanan::class, 'layanan_id', 'layanan_id');
    }

    // Accessors
    public function getDestinationAttribute()
    {
        return $this->layanan ? $this->layanan->lokasi_tujuan : null;
    }

    public function getOfferTypeAttribute()
    {
        return $this->layanan ? $this->layanan->jenis_layanan_label : null;
    }

    // Method to calculate discounted price from original price and percentage
    public function calculateDiscountedPrice()
    {
        if ($this->layanan && $this->discount_percentage) {
            $originalPrice = $this->layanan->harga_mulai;
            $discountAmount = ($originalPrice * $this->discount_percentage) / 100;
            return $originalPrice - $discountAmount;
        }
        return $this->discounted_price;
    }

    // Method to update prices based on layanan
    public function updatePricesFromLayanan()
    {
        if ($this->layanan && $this->discount_percentage) {
            $this->original_price = $this->layanan->harga_mulai;
            $this->discounted_price = $this->calculateDiscountedPrice();
            return $this;
        }
        return $this;
    }
}
