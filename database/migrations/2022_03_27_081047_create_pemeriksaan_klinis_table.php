<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePemeriksaanKlinisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pemeriksaan_klinis', function (Blueprint $table) {
            $table->id();
            $table->integer('id_ppk')->references('id_ppk')->on('v_data_header');
            $table->integer('id_jpp')->references('id')->on('jpp');
            $table->integer('status')->nullable();  //TODO sementara null=belum disetujui, 1=diproses, 2=disetujui 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pemeriksaan_klinis');
    }
}
