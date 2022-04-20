<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVRptPnbpHarianTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->down();
        Schema::connection('sqlsrv2')->create('v_rpt_pnbp_harian', function (Blueprint $table) {
            $table->integer('id_ppk');
            $table->string('no_aju_ppk', 50);
            $table->char('kd_kegiatan', 3);
            $table->string('kel_tarif', 50);
            $table->string('total', 16);
            $table->dateTime('tgl_pnbp');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('sqlsrv2')->dropIfExists('v_rpt_pnbp_harian');
    }
}