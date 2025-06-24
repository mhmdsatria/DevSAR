<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    // Kolom yang boleh diisi (mass assignment)
// app/Models/Profile.php
protected $fillable = [
    'nama_puskesmas',
    'email',
    'struktur_organisasi',
    'alamat', // Tambahkan ini
];


    // Jika struktur_organisasi disimpan sebagai path, bisa bikin helper akses URL
    public function getStrukturOrganisasiUrlAttribute()
    {
        return $this->struktur_organisasi 
            ? asset('storage/' . str_replace('public/', '', $this->struktur_organisasi)) 
            : null;
    }
}
