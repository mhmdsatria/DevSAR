<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Profile;

Route::get('/profile', function () {
    $profile = Profile::first();

    return response()->json([
        'nama_puskesmas' => $profile->nama_puskesmas,
        'alamat'         => $profile->alamat,
    ]);
});
