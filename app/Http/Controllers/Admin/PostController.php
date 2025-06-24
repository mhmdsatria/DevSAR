<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use App\Models\Gallery;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->paginate(10); // Menampilkan 10 post terbaru
        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        return view('admin.posts.create');
    }

    public function store(Request $request)
{
    // Validasi inputan
    $validated = $request->validate([
        'title' => 'required',
        'author' => 'required',
        'body' => 'required',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // Tambahkan slug otomatis
    $validated['slug'] = Str::slug($validated['title']);

    // Proses penyimpanan gambar
    if ($request->hasFile('image')) {
        $validated['image'] = $request->file('image')->store('images', 'public');

        // Tambahkan juga ke gallery
        Gallery::create([
            'title' => $validated['title'],
            'image_path' => $validated['image'],
        ]);
    }

    // Simpan data post baru
    Post::create($validated);

    return redirect()->route('admin.posts.index')->with('success', 'Berita berhasil ditambahkan.');
}


    public function edit(Post $post)
    {
        return view('admin.posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
{
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'author' => 'required|string|max:255',
        'body' => 'required|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // Update slug otomatis dari title
    $validated['slug'] = Str::slug($validated['title']);

    // Kalau ada gambar baru
    if ($request->hasFile('image')) {
        $validated['image'] = $request->file('image')->store('images', 'public');

        // Simpan juga ke galeri
        Gallery::create([
            'title' => $validated['title'],
            'image_path' => $validated['image'],
        ]);
    }

    $post->update($validated);

    return redirect()->route('admin.posts.index')->with('success', 'Berita berhasil diperbarui.');
}


    public function destroy(Post $post)
    {
        // Periksa dan hapus gambar dari penyimpanan jika ada
        if ($post->image && file_exists(storage_path('app/public/images/' . $post->image))) {
            unlink(storage_path('app/public/images/' . $post->image));
        }
        
        // Hapus post
        $post->delete();

        // Hapus entri di gallery terkait dengan post ini
        Gallery::where('title', $post->title)->delete(); // Menghapus gambar terkait di gallery

        return redirect()->route('admin.posts.index')->with('success', 'Post berhasil dihapus!');
    }
}
