<?php

namespace App\Http\Controllers;

use App\Models\{Gallery, Post, Pelayanan, Statistic, Carousel, Profile};
use Illuminate\Http\Request;
use Carbon\Carbon;

class BerandaController extends Controller
{
    public function index()
    {
        // Ambil data untuk beranda
        $galleries = Gallery::all();
        $latestPosts = Post::latest()->take(6)->get();
        $pelayanans = Pelayanan::take(6)->get();
        $carousels = Carousel::take(3)->get();
        $profile = Profile::latest()->first();

        // --- Logika Statistik Pengunjung ---

        // 1. Ambil atau buat entri statistik (HANYA SATU BARIS)
        // Jika tabel kosong, ini akan membuat baris baru dengan ID 1
        // dan mengisi default reset dates ke periode saat ini.
        $stat = Statistic::firstOrCreate(
            ['id' => 1], // Cari entri dengan ID 1
            [
                'total_views' => 0,
                'daily_views' => 0,
                'yesterday_views' => 0,
                'weekly_views' => 0,
                'monthly_views' => 0,
                'active_services' => 22,
                // Pastikan reset_date diatur ke AWAL periode saat ini saat PERTAMA KALI DIBUAT
                'daily_reset_date' => Carbon::now()->startOfDay(),
                'weekly_reset_date' => Carbon::now()->startOfWeek(Carbon::MONDAY),
                'monthly_reset_date' => Carbon::now()->startOfMonth(),
            ]
        );

        // 2. Lakukan RESET jika diperlukan (berdasarkan tanggal reset yang sudah lewat)
        // Method ini juga akan menyimpan (save()) perubahan reset ke database.
        $stat->resetIfNeeded();

        // 3. Increment views untuk kunjungan saat ini
        $stat->increment('total_views');
        $stat->increment('daily_views');
        $stat->increment('weekly_views');
        $stat->increment('monthly_views');

        // Tidak perlu $stat->save() lagi setelah increment, karena increment otomatis menyimpan.

        // --- Akhir Logika Statistik Pengunjung ---

        // Kirim data ke view
        return view('beranda', [
            'title' => 'Beranda',
            'galleries' => $galleries,
            'beranda' => $latestPosts,
            'pelayanans' => $pelayanans,
            'stat' => $stat, // $stat yang sudah diperbarui
            'carousels' => $carousels,
            'profile' => $profile,
        ]);
    }
}