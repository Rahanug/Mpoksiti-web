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
            $table->string('kode_counter')->unique();
            $table->string('nama_counter');
            $table->string('alamat_counter');
            $table->float('latitude');
            $table->float('longitude');
            $table->string('penanggungJawab');
            $table->string('id_kurir')->references('id')->on('kurir');
            $table->string('password');
            $table->integer('is_active');
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
