<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableDokumen extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dokumens', function (Blueprint $table) {
            $table->increments('id_dokumen');
            $table->integer('no_dokumen')->unsigned();
            $table->foreign('no_dokumen')->references('id_ppk')->on('ppks');
            $table->string('nm_dokumen');
            // $table->string('path');
            $table->dateTime('tgl_dokumen');
            $table->dateTime('tgl_berlaku');
            $table->dateTime('tgl_lulus');
            // $table->integer('id_trader')->unsigned();
            // $table->foreign('id_trader')->references('id_trader')->on('traders');
            // $table->integer('id_ppk')->unsigned();
            // $table->foreign('id_ppk')->references('id_ppk')->on('ppks');
            $table->integer('id_kategori')->unsigned();
            $table->foreign('id_kategori')->references('id_kategori')->on('kategori_dokumens');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dokumens');
    }

}
