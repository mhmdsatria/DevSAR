<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pelayanan;
use Illuminate\Http\Request;

class PelayananController extends Controller
{
    public function index() {
        $pelayanans = Pelayanan::all();
        return view('admin.pelayanan.index', compact('pelayanans'));
    }

    public function create() {
        return view('admin.pelayanan.create');
    }

    public function store(Request $request) {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'days' => 'required'
        ]);

        Pelayanan::create($request->all());
        return redirect()->route('admin.pelayanans.index')->with('success', 'Pelayanan berhasil ditambahkan!');
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
        return redirect()->route('admin.pelayanans.index')->with('success', 'Pelayanan berhasil diperbarui!');
    }

    public function destroy(Pelayanan $pelayanan) {
        $pelayanan->delete();
        return redirect()->route('admin.pelayanans.index')->with('success', 'Pelayanan berhasil dihapus!');
    }
}
