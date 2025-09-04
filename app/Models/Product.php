<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'short_description',
        'type',
        'destination',
        'country',
        'price',
        'original_price',
        'duration_days',
        'duration_nights',
        'main_image',
        'gallery_images',
        'itinerary',
        'includes',
        'excludes',
        'terms_conditions',
        'max_participants',
        'min_participants',
        'start_date',
        'end_date',
        'is_featured',
        'is_active',
        'difficulty_level',
        'rating',
        'total_reviews'
    ];

    protected $casts = [
        'gallery_images' => 'array',
        'itinerary' => 'array',
        'includes' => 'array',
        'excludes' => 'array',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'price' => 'decimal:2',
        'original_price' => 'decimal:2',
        'rating' => 'decimal:2',
        'start_date' => 'date',
        'end_date' => 'date'
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

    public function scopeInternational($query)
    {
        return $query->where('type', 'international');
    }

    public function scopeDomestic($query)
    {
        return $query->where('type', 'domestic');
    }
}
