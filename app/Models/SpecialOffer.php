<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SpecialOffer extends Model
{
    protected $fillable = [
        'title',
        'description',
        'offer_type',
        'original_price',
        'discounted_price',
        'discount_percentage',
        'destination',
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
        'badge_color'
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
}
