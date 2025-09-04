<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class News extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'featured_image',
        'gallery_images',
        'category',
        'tags',
        'author_name',
        'author_image',
        'author_bio',
        'read_time',
        'views',
        'is_featured',
        'is_published',
        'status',
        'published_at',
        'meta_title',
        'meta_description'
    ];

    protected $casts = [
        'gallery_images' => 'array',
        'tags' => 'array',
        'is_featured' => 'boolean',
        'is_published' => 'boolean',
        'published_at' => 'datetime',
        'views' => 'integer',
        'read_time' => 'integer'
    ];

    // Scopes
    public function scopePublished(Builder $query): Builder
    {
        return $query->where('is_published', true)
                    ->whereNotNull('published_at')
                    ->where('published_at', '<=', now());
    }

    public function scopeFeatured(Builder $query): Builder
    {
        return $query->where('is_featured', true);
    }

    public function scopeByCategory(Builder $query, string $category): Builder
    {
        return $query->where('category', $category);
    }

    // Accessors
    public function getFeaturedAttribute(): bool
    {
        return $this->is_featured;
    }
}
