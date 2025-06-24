<?php

namespace App\Http\Controllers;

use App\Models\Pelayanan;
use Illuminate\Http\Request;

class PelayananController extends Controller
{
    public function index()
    {
        $pelayanans = Pelayanan::all();
        return view('pelayanan.index', compact('pelayanans'));
    }

    public function beranda()
    {
        $pelayanans = Pelayanan::all();
        return view('beranda', compact('pelayanans'));
    }
}
