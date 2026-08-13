<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Gallery extends Model
{
    use HasUuids;

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
        'status',
        'featured',
        'sort_order'
    ];

    protected $casts = [
        'images' => 'array',
        'tags' => 'array',
        'trip_date' => 'date',
        'featured' => 'boolean',
        'participants_count' => 'integer',
        'sort_order' => 'integer'
    ];

    // Scopes
    public function scopeFeatured(Builder $query): Builder
    {
        return $query->where('featured', true);
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
