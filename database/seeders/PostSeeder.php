<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class PostSeeder extends Seeder
{
    public function run(): void
{
    for ($i = 1; $i <= 15; $i++) {
        $title = "Berita Puskesmas #$i";

        \App\Models\Post::create([
            'title' => $title,
            'author' => 'Dinkes Sukabumi',
            'slug' => Str::slug($title) . '-' . uniqid(),
            'body' => "Ini adalah isi berita ke-$i. Puskesmas terus berinovasi dalam memberikan pelayanan terbaik kepada masyarakat.",
            'image' => "https://source.unsplash.com/random/600x400?sig=$i",
        ]);
    }
}
}
