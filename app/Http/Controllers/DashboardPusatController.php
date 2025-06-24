<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wilayah;
use App\Models\Puskesmas;

class DashboardPusatController extends Controller
{
    public function index()
    {
        $wilayahs = Wilayah::with('puskesmas')->get();

        return view('dashboard-pusat', compact('wilayahs'));
    }

    public function storeWilayah(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        Wilayah::create(['nama' => $request->nama]);

        return redirect()->route('dashboard.pusat')->with('success', 'Wilayah berhasil ditambahkan');
    }

    public function storePuskesmas(Request $request)
    {
        $request->validate([
            'wilayah_id' => 'required|exists:wilayahs,id',
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:500',
            'latitude' => 'nullable|string|max:20',
            'longitude' => 'nullable|string|max:20',
            'api_url' => 'required|url',
            'api_token' => 'required|string|max:255',
        ]);

        Puskesmas::create($request->all());

        return redirect()->route('dashboard.pusat')->with('success', 'Puskesmas berhasil ditambahkan');
    }
}
