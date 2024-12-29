<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RefreshToken extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'token',
        'expires_at',
        'user_id',
        'created_at'
    ];

    protected $hidden = [
        'id'
    ];

    protected $casts = [
        'expires_at' => 'datetime',
        'created_at' => 'datetime',
    ];
}
