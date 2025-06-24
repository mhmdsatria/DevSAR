<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Carousel;
use Illuminate\Http\Request;

class CarouselController extends Controller
{
    public function index()
    {
        $carousels = Carousel::all();
        return view('admin.carousel.index', compact('carousels'));
    }

    public function create()
    {
        return view('admin.carousel.create');
    }

    public function store(Request $request)
{
    // Validasi input
    $request->validate([
        'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    // Upload file
    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $path = $image->store('carousels', 'public'); // Disimpan ke storage/app/public/carousels

        // Simpan ke database
        Carousel::create([
            'image' => $path,
        ]);
    }

    // Redirect ke halaman index carousel dengan pesan sukses
    return redirect()->route('admin.carousels.index')->with('success', 'Carousel berhasil ditambahkan.');
}

}
