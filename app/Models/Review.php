<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'customer_name',
        'customer_position',
        'customer_avatar',
        'destination',
        'content',
        'rating',
        'is_active',
        'order',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'rating' => 'integer',
        'is_active' => 'boolean',
        'order' => 'integer',
    ];

    /**
     * Scope for active reviews only.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope for ordering reviews by order field.
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'asc')->orderBy('created_at', 'desc');
    }

    /**
     * Get formatted rating as stars.
     */
    public function getFormattedRatingAttribute(): string
    {
        return str_repeat('★', $this->rating) . str_repeat('☆', 5 - $this->rating);
    }

    /**
     * Get avatar URL or default.
     */
    public function getAvatarUrlAttribute(): string
    {
        if ($this->customer_avatar) {
            return asset('storage/' . $this->customer_avatar);
        }
        return 'https://ui-avatars.com/api/?name=' . urlencode($this->customer_name) . '&background=0ea5e9&color=fff';
    }
}
