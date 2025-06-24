<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class SocialMediaController extends Controller
{
    // Menampilkan form edit sosial media
    public function edit()
    {
        $data = DB::table('social_links')->get()->keyBy('platform');
        return view('admin.sosmed.edit', compact('data'));
    }

    // Menyimpan perubahan sosial media
    public function update(Request $request)
{
    $platforms = ['facebook', 'instagram', 'tiktok'];

    foreach ($platforms as $platform) {
        $url = $request->input($platform);

        if ($url) {
            DB::table('social_links')->updateOrInsert(
                ['platform' => $platform],
                ['url' => $url, 'updated_at' => now()]
            );
        }
    }

    // ✅ Redirect ke halaman index sosial media dengan pesan sukses
    return redirect()->route('admin.sosmed.index')->with('success', 'Link sosial media berhasil diperbarui!');
}


    // Menghapus salah satu platform
    public function destroy($platform)
    {
        DB::table('social_links')->where('platform', $platform)->delete();

        return redirect()->route('admin.sosmed.edit')
                         ->with('success', ucfirst($platform) . ' link has been deleted.');
    }

    // Menampilkan semua sosial media dalam bentuk tabel
    public function index()
{
    $data = DB::table('social_links')->get()->keyBy('platform');
    return view('admin.sosmed.index', compact('data'));
}

    // Menampilkan form untuk menambahkan link sosial media baru
    public function create($platform)
{
    $available = ['facebook', 'instagram', 'tiktok'];

    abort_unless(in_array($platform, $available), 404);

    return view('admin.sosmed.create', compact('platform'));
}


    
// Menyimpan data sosial media baru ke database
public function store(Request $request)
{
    $request->validate([
        'platform' => 'required|string|unique:social_links,platform',
        'url' => 'required|url',
    ]);

    DB::table('social_links')->insert([
        'platform' => strtolower($request->platform),
        'url' => $request->url,
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    return redirect()->route('admin.sosmed.index')->with('success', 'Sosial media berhasil ditambahkan.');
}

}
