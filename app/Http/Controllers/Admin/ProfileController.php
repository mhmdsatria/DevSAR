<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pelayanan;
use Illuminate\Http\Request;
use App\Models\Profile;
class ProfileController extends Controller
{
     // pastikan model Profile di-import

    public function index() {
        $profile = Profile::latest()->first(); // ambil data terbaru
    
        return view('admin.profile.index', compact('profile'));
    }
    

public function create()
{
    return view('admin.profile.create');
}


    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_puskesmas' => 'required',
            'email' => 'required|email',
            'struktur_organisasi' => 'nullable|image|mimes:jpg,jpeg,png'
        ]);
    
        if ($request->hasFile('struktur_organisasi')) {
            $data['struktur_organisasi'] = $request->file('struktur_organisasi')->store('struktur', 'public');
        }
    
        \App\Models\Profile::create($data);
    
        return redirect()->route('admin.profile.index')->with('success', 'Profil berhasil ditambahkan!');
    }
    
    public function edit(Pelayanan $pelayanan) {
        return view('admin.pelayanan.edit', compact('pelayanan'));
    }

    public function update(Request $request, Pelayanan $pelayanan) {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'days' => 'required'
        ]);

        $pelayanan->update($request->all());
        return redirect()->route('pelayanan.index')->with('success', 'Pelayanan berhasil diperbarui!');
    }

    public function destroy(Pelayanan $pelayanan) {
        $pelayanan->delete();
        return redirect()->route('pelayanan.index')->with('success', 'Pelayanan berhasil dihapus!');
    }
}
