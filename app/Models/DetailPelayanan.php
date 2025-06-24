<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('pelayanans', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('days'); // Hari layanan, contoh: "Senin - Jumat"
            $table->text('description'); // Deskripsi lengkap
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pelayanans');
    }
};

