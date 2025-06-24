<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
 public function up(): void
{
    Schema::create('puskesmas', function (Blueprint $table) {
        $table->id();
        $table->foreignId('wilayah_id')->constrained()->onDelete('cascade');
        $table->string('nama');
        $table->string('alamat');
        $table->string('hotline_service')->nullable();
        $table->string('gambar_jalan')->nullable(); // URL atau path gambar
        $table->string('latitude')->nullable();
        $table->string('longitude')->nullable();
        $table->string('api_url')->nullable();  // Kalau kamu masih butuh API URL bisa ditambah ini
        $table->string('api_token')->nullable(); // Token akses API (optional)
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('puskesmas');
    }
};