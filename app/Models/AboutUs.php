<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutUs extends Model
{
    protected $table = 'about_us';

    protected $fillable = [
        'title',
        'description',
        'story',
        'hero_image',
        'about_image',
        'happy_customers',
        'years_experience',
        'destinations',
        'satisfaction_rate',
        'values',
        'team_members',
        'is_active'
    ];

    protected $casts = [
        'values' => 'array',
        'team_members' => 'array',
        'is_active' => 'boolean',
        'happy_customers' => 'integer',
        'years_experience' => 'integer',
        'destinations' => 'integer',
        'satisfaction_rate' => 'integer'
    ];
}
