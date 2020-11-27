<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataGempasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_gempas', function (Blueprint $table) {
            $table->id();
            $table->string('tahun');
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->string('kedalaman')->nullable();
            $table->string('kekuatan')->nullable();
            $table->string('lokasi');
            $table->string('waktu_detail');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('data_gempas');
    }
}
