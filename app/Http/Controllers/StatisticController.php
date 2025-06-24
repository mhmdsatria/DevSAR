<?php

namespace App\Http\Controllers;

use App\Models\statistic; // Ganti dengan model baru Anda
use Carbon\Carbon;
use Illuminate\Http\Request;

class StatisticController extends Controller
{
    // ... (metode index, showLayanan, showDokumentasi, showInformasi, showProfil Anda) ...

    /**
     * Helper method to get website stats dynamically.
     */
    private function getWebsiteStats()
    {
        $today = Carbon::today();
        $yesterday = Carbon::yesterday();

        // Hari ini (tanggal 19 Juni 2025 adalah Kamis)
        // Jika awal minggu adalah Senin, maka minggu ini dimulai dari Senin, 16 Juni 2025
        $startOfWeek = Carbon::now()->startOfWeek(Carbon::MONDAY);
        $startOfMonth = Carbon::now()->startOfMonth();

        // Mengambil daily views
        $dailyViews = statistic::whereDate('date', $today)->value('views') ?? 0;
        $yesterdayViews = statistic::whereDate('date', $yesterday)->value('views') ?? 0;

        // Mengambil weekly views (dari awal minggu hingga hari ini)
        $weeklyViews = statistic::whereBetween('date', [$startOfWeek, $today])->sum('views');

        // Mengambil monthly views (dari awal bulan hingga hari ini)
        $monthlyViews = statistic::whereBetween('date', [$startOfMonth, $today])->sum('views');

        // Mengambil total views (akumulasi dari semua daily views)
        $totalViews = statistic::sum('views');

        return (object) [
            'daily_views' => $dailyViews,
            'yesterday_views' => $yesterdayViews,
            'weekly_views' => $weeklyViews,
            'monthly_views' => $monthlyViews,
            'total_views' => $totalViews, // Ini akan langsung berubah setiap kali ada kunjungan baru
        ];
    }
}