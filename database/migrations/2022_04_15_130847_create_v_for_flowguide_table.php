<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVForFlowguideTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->down();
        Schema::connection('sqlsrv2')->create('v_for_flowguide', function (Blueprint $table) {
            $table->increments('id_ppk');
            $table->string('no_aju_ppk', 50);
            $table->integer('id_urut');
            $table->string('nm_dok', 50);
            $table->string('kd_kegiatan', 3);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('sqlsrv2')->dropIfExists('v_for_flowguide');
    }
}