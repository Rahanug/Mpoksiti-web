<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJppTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jpp', function (Blueprint $table) {
            $table->id();
            $table->string('kode_counter');
            $table->string('nama_counter');
            $table->string('latitude');
            $table->string('longitude');
            $table->string('penanggungJawab');
            $table->string('id_kurir')->references('id')->on('kurir');
            $table->string('password');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jpp');
    }
}
