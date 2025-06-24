<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    // Menampilkan daftar galeri untuk admin
    public function index()
    {
        $galleries = Gallery::paginate(10);
        return view('admin.gallery.index', compact('galleries'));
    }

    // Form tambah galeri
    public function create()
    {
        return view('admin.gallery.create');
    }

    // Simpan galeri baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imagePath = $request->file('image')->store('galleries', 'public');

        Gallery::create([
            'title' => $validated['title'],
            'image_path' => $imagePath,
        ]);

        return redirect()->route('admin.galleries.index')->with('success', 'Gambar berhasil ditambahkan!');
    }

    // Tampilkan form edit galeri
    public function edit($id)
    {
        $gallery = Gallery::findOrFail($id);
        return view('admin.gallery.edit', compact('gallery'));
    }

    // Update galeri
    public function update(Request $request, $id)
    {
        $gallery = Gallery::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Update judul
        $gallery->title = $validated['title'];

        // Ganti gambar jika ada
        if ($request->hasFile('image')) {
            if (Storage::disk('public')->exists($gallery->image_path)) {
                Storage::disk('public')->delete($gallery->image_path);
            }
            $gallery->image_path = $request->file('image')->store('galleries', 'public');
        }

        $gallery->save();

        return redirect()->route('admin.galleries.index')->with('success', 'Galeri berhasil diperbarui!');
    }

    // Hapus galeri
    public function destroy($id)
    {
        $gallery = Gallery::findOrFail($id);

        if (Storage::disk('public')->exists($gallery->image_path)) {
            Storage::disk('public')->delete($gallery->image_path);
        }

        $gallery->delete();

        return redirect()->route('admin.galleries.index')->with('success', 'Gambar berhasil dihapus!');
    }

    public function show(Gallery $gallery)
{
    // Menampilkan detail galeri
    return view('gallery.show', compact('gallery'));
}


    // Menampilkan dokumentasi ke UI publik
public function dokumentasi()
{
    $galleries = Gallery::latest()->paginate(9); // Bisa disesuaikan jumlahnya
    return view('dokumentasi', compact('galleries'));
}

}
