<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatisticsTable extends Migration // Nama kelas migrasi Anda
{
    public function up()
    {
       Schema::create('statistics', function (Blueprint $table) {
    $table->id();
    $table->date('date')->unique();
    $table->unsignedBigInteger('views')->default(0);
    $table->timestamps();
});


    }

    public function down()
    {
        Schema::dropIfExists('statistics');
    }
}