<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

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

    // Relationships
    public function galleryLikes()
    {
        return $this->hasMany(GalleryLike::class);
    }

    // Helper Methods
    public function isLikedByUser($userId = null)
    {
        if (!$userId && !Auth::check()) {
            return false;
        }
        
        $userId = $userId ?? Auth::id();
        
        return $this->galleryLikes()->where('user_id', $userId)->exists();
    }

    public function incrementViews()
    {
        $this->increment('views');
    }

    public function toggleLike($userId = null)
    {
        if (!$userId && !Auth::check()) {
            return false;
        }
        
        $userId = $userId ?? Auth::id();
        
        $existingLike = $this->galleryLikes()->where('user_id', $userId)->first();
        
        if ($existingLike) {
            $existingLike->delete();
            $this->decrement('likes');
            return false; // unliked
        } else {
            $this->galleryLikes()->create(['user_id' => $userId]);
            $this->increment('likes');
            return true; // liked
        }
    }
}
