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

    public function scopeStandalone($query)
    {
        return $query->whereNull('layanan_id');
    }

    public function scopeWithLayanan($query)
    {
        return $query->whereNotNull('layanan_id');
    }

    // Route key name for model binding
    public function getRouteKeyName()
    {
        return 'slug';
    }

    // Relationships
    public function layanan()
    {
        return $this->belongsTo(Layanan::class, 'layanan_id', 'layanan_id');
    }

    public function galleries()
    {
        return $this->hasMany(SpecialOfferGallery::class)->orderedBySort();
    }

    public function mainGalleryImage()
    {
        return $this->hasOne(SpecialOfferGallery::class)->mainImage();
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

    // Accessors for form fields
    public function getStartDateAttribute()
    {
        return $this->valid_from;
    }

    public function getEndDateAttribute()
    {
        return $this->valid_until;
    }

    public function getStatusAttribute()
    {
        return $this->is_active ? 'active' : 'inactive';
    }

    public function getFeaturedAttribute()
    {
        return $this->is_featured;
    }

    public function getImageAttribute()
    {
        return $this->main_image;
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

    // Check if this is a standalone offer (not related to any layanan)
    public function isStandalone()
    {
        return is_null($this->layanan_id);
    }

    // Check if this offer is related to a layanan
    public function hasLayanan()
    {
        return !is_null($this->layanan_id);
    }

    // Get offer type for standalone offers
    public function getStandaloneTypeAttribute()
    {
        return $this->isStandalone() ? 'Penawaran Khusus' : null;
    }
}
