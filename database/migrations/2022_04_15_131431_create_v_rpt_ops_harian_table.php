<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVRptOpsHarianTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->down();
        Schema::connection('sqlsrv2')->create('v_rpt_ops_harian', function (Blueprint $table) {
            $table->integer('id_ppk');
            $table->string('no_sertifikat', 50);
            $table->dateTime('tgl_sertifikat');
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('sqlsrv2')->dropIfExists('v_rpt_ops_harian');
    }
}