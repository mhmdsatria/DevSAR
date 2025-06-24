<?php

namespace App\Http\Controllers;

use App\Models\PageVisit; // Gunakan model PageVisit
use Carbon\Carbon;

class VisitorStatisticsController extends Controller
{
    public function getStatistics()
    {
        // Hitung setiap kunjungan ke halaman 'beranda'
        // Pengunjung Hari Ini
        $today = PageVisit::whereDate('visited_at', Carbon::today())
                          ->where('page_name', 'beranda')
                          ->count();

        // Pengunjung Kemarin
        $yesterday = PageVisit::whereDate('visited_at', Carbon::yesterday())
                             ->where('page_name', 'beranda')
                             ->count();

        // Pengunjung Minggu Ini (dari awal minggu hingga akhir hari ini)
        $thisWeek = PageVisit::whereBetween('visited_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfDay()])
                             ->where('page_name', 'beranda')
                             ->count();

        // Pengunjung Bulan Ini (dari awal bulan hingga akhir hari ini)
        $thisMonth = PageVisit::whereBetween('visited_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfDay()])
                             ->where('page_name', 'beranda')
                             ->count();

        // Pengunjung Tahun Ini (dari awal tahun hingga akhir hari ini)
        $thisYear = PageVisit::whereBetween('visited_at', [Carbon::now()->startOfYear(), Carbon::now()->endOfDay()])
                            ->where('page_name', 'beranda')
                            ->count();

        $stats = [
            'today' => $today,
            'yesterday' => $yesterday,
            'this_week' => $thisWeek,
            'this_month' => $thisMonth,
            'this_year' => $thisYear,
        ];

        return $stats;
    }
}