<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use App\Models\Gallery;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;

class PostControllercopy extends Controller
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
            'title' => 'required|string|max:255',
            'slug' => 'required|unique:posts,slug',
            'author' => 'required|string|max:255',
            'body' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Generate slug otomatis jika tidak diisi manual (opsional)
        if (!$request->filled('slug')) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        // Proses penyimpanan gambar
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('images', 'public');

            // Simpan ke gallery
            Gallery::create([
                'title' => $validated['title'],
                'image_path' => $validated['image'],
            ]);
        }

        Post::create($validated);

        return redirect()->route('admin.posts.index')->with('success', 'Berita berhasil ditambahkan.');
    }

    public function edit(Post $post)
    {
        return view('admin.posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        // Validasi inputan dengan aturan slug unik kecuali untuk post ini
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|unique:posts,slug,' . $post->id,
            'author' => 'required|string|max:255',
            'body' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Update data post
        $post->title = $validated['title'];
        $post->slug = $validated['slug'];
        $post->author = $validated['author'];
        $post->body = $validated['body'];

        // Jika ada gambar baru
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($post->image && Storage::disk('public')->exists($post->image)) {
                Storage::disk('public')->delete($post->image);

                // Hapus juga dari gallery yang terkait dengan gambar lama
                Gallery::where('image_path', $post->image)->delete();
            }

            // Simpan gambar baru
            $post->image = $request->file('image')->store('images', 'public');

            // Simpan/update gallery dengan title dan image baru
            Gallery::create([
                'title' => $post->title,
                'image_path' => $post->image,
            ]);
        }

        $post->save();

        return redirect()->route('admin.posts.index')->with('success', 'Post berhasil diperbarui!');
    }

    public function destroy(Post $post)
    {
        // Hapus gambar dari storage jika ada
        if ($post->image && Storage::disk('public')->exists($post->image)) {
            Storage::disk('public')->delete($post->image);
        }

        // Hapus post
        $post->delete();

        // Hapus entri gallery terkait
        Gallery::where('title', $post->title)->delete();

        return redirect()->route('admin.posts.index')->with('success', 'Post berhasil dihapus!');
    }
}
