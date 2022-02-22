<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableMasterDokumen extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_dokumens', function (Blueprint $table) {
            $table->increments('id_master');
            $table->string('no_dokumen');
            $table->datetime('tgl_terbit');
            $table->datetime('tgl_expired');
            $table->string('status');
            $table->integer('id_kategori')->unsigned();
            $table->foreign('id_kategori')->references('id_kategori')->on('kategori_dokumens');
            $table->integer('id_trader')->unsigned();
            $table->foreign('id_trader')->references('id_trader')->on('traders');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('table_master_dokumen');
    }
}
