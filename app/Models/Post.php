<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'slug', 'author', 'body', 'image'];

    public function getRouteKeyName()
    {
        // Jika di route admin, pakai ID; kalau di publik, pakai slug
        return request()->is('admin/*') ? 'id' : 'slug';
    }

    // Scope untuk filtering berdasarkan request search
    public function scopeFilter($query)
    {
        if (request('search')) {
            $query->where('title', 'like', '%' . request('search') . '%')
                  ->orWhere('body', 'like', '%' . request('search') . '%');
        }
    }
}
