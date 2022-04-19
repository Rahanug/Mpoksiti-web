<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCameraFileTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('images_pk', function (Blueprint $table) {
            $table->id();
            $table->integer('id_ppk');
            $table->string('no_aju_ppk');
            $table->string('kd_ikan');
            $table->string('url_file');
            $table->string('latitude');
            $table->string('longitude');
            $table->integer('id_trader')->unsigned();
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
        Schema::dropIfExists('images_pk');
    }
}
