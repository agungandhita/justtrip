<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class SpecialOfferGallery extends Model
{
    protected $fillable = [
        'special_offer_id',
        'image_path',
        'title',
        'description',
        'alt_text',
        'is_main',
        'sort_order'
    ];

    protected $casts = [
        'is_main' => 'boolean',
        'sort_order' => 'integer'
    ];

    // Relationships
    public function specialOffer()
    {
        return $this->belongsTo(SpecialOffer::class);
    }

    // Helper methods
    public function getImageUrlAttribute()
    {
        return $this->image_path ? Storage::url($this->image_path) : null;
    }

    public function scopeMainImage($query)
    {
        return $query->where('is_main', true);
    }

    public function scopeOrderedBySort($query)
    {
        return $query->orderBy('sort_order')->orderBy('id');
    }
}
