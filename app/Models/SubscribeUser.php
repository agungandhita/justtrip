<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscribeUser extends Model
{
    /** @use HasFactory<\Database\Factories\SubscribeUserFactory> */
    use HasFactory, HasUuids;

    protected $fillable = [
        'email', 'unsubcribe',
    ];

    public function scopeSubscribed($query)
    {
        return $query->where('unsubcribe', false);
    }
}
