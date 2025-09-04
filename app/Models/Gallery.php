<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Gallery extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'description',
        'destination',
        'trip_date',
        'main_image',
        'images',
        'category',
        'tags',
        'participants_count',
        'trip_highlights',
        'photographer',
        'alt_text',
        'caption',
        'status',
        'featured',
        'sort_order',
        'location',
        'date_taken',
        'is_featured',
        'is_public',
        'views',
        'likes'
    ];

    protected $casts = [
        'images' => 'array',
        'tags' => 'array',
        'trip_date' => 'date',
        'date_taken' => 'date',
        'is_featured' => 'boolean',
        'is_public' => 'boolean',
        'featured' => 'boolean',
        'participants_count' => 'integer',
        'views' => 'integer',
        'likes' => 'integer',
        'sort_order' => 'integer'
    ];

    // Scopes
    public function scopePublic(Builder $query): Builder
    {
        return $query->where('is_public', true);
    }

    public function scopeFeatured(Builder $query): Builder
    {
        return $query->where('is_featured', true);
    }

    public function scopeByDestination(Builder $query, string $destination): Builder
    {
        return $query->where('destination', 'like', '%' . $destination . '%');
    }

    public function scopeByCategory(Builder $query, string $category): Builder
    {
        return $query->where('category', $category);
    }
}
