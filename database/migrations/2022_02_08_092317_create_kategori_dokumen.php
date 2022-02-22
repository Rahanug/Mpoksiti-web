<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKategoriDokumen extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kategori_dokumens', function (Blueprint $table) {
            $table->increments('id_kategori');
            $table->string('nama_kategori', 100);
            $table->unsignedTinyInteger('status');
            $table->string('instansi_penerbit', 100);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kategori_dokumen');
    }
}
