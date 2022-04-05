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
            $table->integer('status')->nullable();          //TODO sementara null=belum diproses, 1=uploaded dari user(diproses) 2=ditolak, 3=disetujui 
            $table->integer('status_periksa')->nullable();  //TODO sementara null=belum mengajukan, 1=link diberikan, 2=selesai
            $table->datetime('jadwal_periksa')->nullable();
            $table->string('url_periksa')->nullable();
            $table->string('no_sertif')->nullable();
            $table->string('keterangan')->nullable();
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
