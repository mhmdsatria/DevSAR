<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wilayah extends Model
{
    protected $table = 'wilayahs'; // pastikan nama tabel benar

    protected $fillable = ['nama'];

    public function puskesmas()
    {
        return $this->hasMany(Puskesmas::class);
    }
}
