<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        User::updateOrCreate(
            ['email' => 'admin@puskesmas.com'],
            [
                'name' => 'Admin Puskesmas',
                'password' => Hash::make('asd123'), // Ganti kalau mau
            ]
        );
    }
}

