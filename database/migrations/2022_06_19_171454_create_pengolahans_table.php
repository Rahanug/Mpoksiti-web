<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengolahansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengolahans', function (Blueprint $table) {
            $table->increments('id_user');
            $table->string('nm_user', 50)->nullable();
            $table->string('npwp', 20)->unique();
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
        Schema::dropIfExists('pengolahans');
    }
}
