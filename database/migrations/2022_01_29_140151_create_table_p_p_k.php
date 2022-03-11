<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTablePPK extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ppks', function (Blueprint $table) {
            $table->increments('id_ppk');
            $table->string('no_ppk', 100);
            $table->string('no_aju_ppk', 100);
            $table->integer('jumlah');
            $table->integer('satuan');
            $table->integer('status')->nullable();  //TODO sementara null=belum disetujui, 1=diproses, 2=disetujui 
            $table->string('nm_penerima', 50);
            $table->integer('id_trader')->unsigned();
            $table->foreign('id_trader')->references('id_trader')->on('traders');
            $table->integer('kode_counter_jpp')->unsigned()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ppks');
    }

}
