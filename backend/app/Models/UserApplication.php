<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserApplication extends Model
{
    use HasFactory;

    protected $table = 'user_applications';

    protected $fillable = [
        'user_id',
        'application_id',
        'grant_type',
        'granted_at',
        'expires_at',
    ];

    protected $casts = [
        'granted_at' => 'datetime',
        'expires_at' => 'datetime',
    ];
}
