<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;

class ProfileController extends Controller
{
    // Halaman profil publik
    public function profile()
    {
        $profile = Profile::latest()->first();
        return view('profil', compact('profile'));
    }

    // Untuk admin melihat data profile
    public function index()
    {
        $profile = Profile::latest()->first();
        return view('admin.profile.index', compact('profile'));
    }

    // Form tambah profil (jika belum ada)
    public function create()
    {
        $profile = Profile::first();

        if ($profile) {
            return redirect()->route('admin.profile.edit', $profile->id);
        }

        return view('admin.profile.create');
    }

    // Menyimpan data profil baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_puskesmas' => 'required|string|max:255',
            'alamat' => 'required|string',
            'email' => 'required|email',
            'struktur_organisasi' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only(['nama_puskesmas', 'alamat', 'email']);

        if ($request->hasFile('struktur_organisasi')) {
            $data['struktur_organisasi'] = $request->file('struktur_organisasi')->store('struktur', 'public');
        }

        Profile::create($data);

        return redirect()->route('admin.profile.index')->with('success', 'Profil berhasil disimpan!');
    }

    // Form edit profil
    public function edit(Profile $profile)
    {
        return view('admin.profile.edit', compact('profile'));
    }

    // Menyimpan perubahan profil
    public function update(Request $request, Profile $profile)
    {
        $validated = $request->validate([
            'nama_puskesmas' => 'required|string|max:255',
            'alamat' => 'required|string',
            'email' => 'required|email',
            'struktur_organisasi' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('struktur_organisasi')) {
            $validated['struktur_organisasi'] = $request->file('struktur_organisasi')->store('struktur', 'public');
        }

        $profile->update($validated);

        return redirect()->route('admin.profile.index')->with('success', 'Profil berhasil diperbarui.');
    }
}
