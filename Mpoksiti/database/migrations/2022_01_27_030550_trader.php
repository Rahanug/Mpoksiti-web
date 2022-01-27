<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Trader extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trader', function (Blueprint $table) {
            $table->integer('id_trader');
            $table->primary('id_trader');
            $table->string('nm_trader', 50);
            $table->string('al_trader', 100);
            $table->string('kt_trader', 100);
            $table->string('npwp', 20);
            $table->string('no_ktp', 20);
            $table->string('no_izin', 20);
            $table->string('email', 50);
            $table->string('password', 50);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trader');
    }
}
