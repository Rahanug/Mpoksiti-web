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
            $table->id();
            $table->integer('id_ppk')->references('id_ppk')->on('v_data_header');
            $table->integer('status')->nullable();  //TODO sementara null=belum disetujui, 1=diproses, 2=disetujui 
            $table->integer('jadwal_periksa')->nullable();
            $table->integer('url_periksa')->nullable();
            
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
