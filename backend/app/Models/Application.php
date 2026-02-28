<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Application extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'icon',
        'price',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_applications')
            ->withPivot(['grant_type', 'granted_at', 'expires_at'])
            ->withTimestamps();
    }
}
