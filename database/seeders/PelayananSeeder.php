<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pelayanan;

class PelayananSeeder extends Seeder
{
    public function run(): void
    {
        $layanan = [
            ['title' => 'Pemeriksaan Umum', 'description' => 'Layanan pemeriksaan kesehatan dasar dan umum.', 'days' => 'Senin - Jumat'],
            ['title' => 'Imunisasi Balita', 'description' => 'Imunisasi dasar dan lanjutan bagi balita.', 'days' => 'Rabu & Kamis'],
            ['title' => 'Kesehatan Ibu dan Anak', 'description' => 'Pelayanan kehamilan, nifas, dan pertumbuhan anak.', 'days' => 'Senin - Jumat'],
            ['title' => 'Konsultasi Gizi', 'description' => 'Layanan konseling gizi untuk balita, ibu hamil, dan masyarakat umum.', 'days' => 'Selasa & Kamis'],
            ['title' => 'Pelayanan KB', 'description' => 'Pelayanan alat dan obat kontrasepsi bagi pasangan usia subur.', 'days' => 'Senin & Rabu'],
            ['title' => 'Pemeriksaan Gigi dan Mulut', 'description' => 'Pemeriksaan dan perawatan gigi oleh tenaga medis.', 'days' => 'Senin - Jumat'],
            ['title' => 'Pelayanan Lansia', 'description' => 'Pelayanan kesehatan bagi lanjut usia.', 'days' => 'Rabu'],
            ['title' => 'Skrining PTM', 'description' => 'Skrining dan pencegahan penyakit tidak menular seperti hipertensi, diabetes, dll.', 'days' => 'Kamis'],
            ['title' => 'Pelayanan Kesehatan Jiwa', 'description' => 'Konsultasi dan pengobatan gangguan jiwa ringan hingga sedang.', 'days' => 'Jumat'],
            ['title' => 'Pelayanan Laboratorium', 'description' => 'Pemeriksaan penunjang laboratorium seperti darah, urin, dan lainnya.', 'days' => 'Senin - Jumat'],
            ['title' => 'Pelayanan Farmasi', 'description' => 'Pelayanan obat dari resep dokter dan edukasi penggunaannya.', 'days' => 'Setiap Hari Kerja'],
            ['title' => 'Rawat Jalan Sederhana', 'description' => 'Pengobatan dan tindakan medis ringan untuk pasien rawat jalan.', 'days' => 'Senin - Jumat'],
            ['title' => 'Pelayanan TBC dan HIV', 'description' => 'Pelacakan, pengobatan, dan konseling untuk pasien TBC dan HIV.', 'days' => 'Selasa & Jumat'],
            ['title' => 'Pelayanan Sanitasi Lingkungan', 'description' => 'Pemeriksaan kualitas lingkungan dan air, serta edukasi sanitasi.', 'days' => 'Sesuai Jadwal Petugas'],
            ['title' => 'Pelayanan Kesehatan Sekolah', 'description' => 'Kegiatan UKS dan pemeriksaan kesehatan rutin di sekolah.', 'days' => 'Sesuai Jadwal Sekolah'],
        ];

        Pelayanan::insert($layanan);
    }
}
