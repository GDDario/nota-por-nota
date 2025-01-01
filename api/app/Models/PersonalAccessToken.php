<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonalAccessToken extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'id',
        'tokenable',
        'name',
        'token',
        'abilities',
        'last_used_at',
        'expires_at',
        'created_at',
        'updated_at'
    ];

    protected $hidden = [
        'id'
    ];

    protected $casts = [
        'last_used_at' => 'datetime',
        'expires_at' => 'datetime',
        'created_at' => 'datetime',
    ];
}
