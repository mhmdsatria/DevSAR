<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Puskesmas extends Model
{
    protected $table = 'puskesmas';

    protected $fillable = [
    'wilayah_id',
    'nama',
    'alamat',
    'latitude',
    'longitude',
    'api_url',
    'api_token',
];
    public function wilayah()
    {
        return $this->belongsTo(Wilayah::class);
    }
}
