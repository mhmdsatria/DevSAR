<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('aktifitas_puskesmas', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('puskesmas_id');
        $table->timestamp('last_online')->nullable();
        $table->boolean('online')->default(false);
        $table->timestamps();

        $table->foreign('puskesmas_id')->references('id')->on('puskesmas')->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aktifitas_puskesmas');
    }
};
