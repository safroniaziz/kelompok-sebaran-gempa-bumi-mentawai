<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIterasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('iterasis', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('data_gempa_id');
            $table->float('nilai_cluster_1')->nullable();
            $table->float('nilai_cluster_2')->nullable();
            $table->float('nilai_cluster_3')->nullable();
            $table->float('nilai_min')->nullable();
            $table->string('kelompok_cluster')->nullable();
            $table->bigInteger('iterasi_ke')->nullable();
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
        Schema::dropIfExists('iterasis');
    }
}
