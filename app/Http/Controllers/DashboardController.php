<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Puskesmas;
use Illuminate\Support\Facades\Http;

class DashboardController extends Controller
{
    public function index()
    {
        $puskesmasList = Puskesmas::all();
        $dataDashboard = [];

        foreach ($puskesmasList as $puskesmas) {
            try {
                // Panggil API Puskesmas dengan token
                $response = Http::withToken($puskesmas->api_token)
                    ->get($puskesmas->api_url.'/dashboard-data');

                if ($response->successful()) {
                    $data = $response->json();
                    $dataDashboard[] = [
                        'puskesmas' => $puskesmas->nama,
                        'wilayah' => $puskesmas->wilayah->nama,
                        'data' => $data,
                    ];
                } else {
                    // Kalau gagal ambil data dari puskesmas ini
                    $dataDashboard[] = [
                        'puskesmas' => $puskesmas->nama,
                        'wilayah' => $puskesmas->wilayah->nama,
                        'data' => null,
                        'error' => 'Gagal ambil data',
                    ];
                }
            } catch (\Exception $e) {
                $dataDashboard[] = [
                    'puskesmas' => $puskesmas->nama,
                    'wilayah' => $puskesmas->wilayah->nama,
                    'data' => null,
                    'error' => $e->getMessage(),
                ];
            }
        }

        return view('dashboard.pusat', compact('dataDashboard'));
    }
}
