<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableTrader extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('traders', function (Blueprint $table) {
            $table->increments('id_trader');
            $table->string('nm_trader', 50);
            $table->string('al_trader', 100);
            $table->string('kt_trader', 100);
            $table->string('npwp', 20);
            $table->string('no_ktp', 20);
            $table->string('no_izin', 20)->nullable();
            $table->string('no_hp', 20);
            $table->string('email', 50);
            $table->string('password', 100);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('traders');
    }

}
