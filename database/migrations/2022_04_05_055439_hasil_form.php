<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class HasilForm extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subform', function (Blueprint $table) {
            $table->increments('id_subform');
            $table->string('urutan');
            $table->string('value');
            $table->string('keterangan')->nullable();
            $table->string('visibility');
            $table->integer('id_masterSubform')->unsigned();
            $table->foreign('id_masterSubform')->references('id_masterSubform')->on('master_subform');
            $table->integer('id_ppk')->unsigned();
            $table->foreign('id_ppk')->references('id_ppk')->on('v_data_header');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hasil_form');
    }
}
