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
            $table->integer('id_dokumen');
            $table->primary('id_dokumen');
            $table->string('kategori_dokumen', 100);
            $table->integer('no_dokumen');
            $table->dateTime('tgl_dokumen');
            $table->dateTime('tgl_berlaku');
            $table->dateTime('tgl_lulus');
            $table->string('status_dokumen', 50);
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
