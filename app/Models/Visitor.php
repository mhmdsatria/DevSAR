<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    use HasFactory;

    protected $fillable = [
        'ip_address',
        'user_agent',
        'visited_at',
    ];

    // Optional: Jika kamu tidak ingin Laravel otomatis mengelola created_at dan updated_at
    // public $timestamps = false;
}