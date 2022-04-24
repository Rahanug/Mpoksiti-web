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
            $table->integer('id_trader')->primary();
            $table->string('nm_trader', 50)->nullable();
            $table->string('al_trader', 100)->nullable();
            $table->string('kt_trader', 100)->nullable();
            $table->string('npwp', 20)->unique();
            $table->string('no_ktp', 20)->nullable();
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
