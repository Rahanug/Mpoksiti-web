<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVForQrTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->down();
        Schema::connection('mysql2')->create('v_for_qr', function (Blueprint $table) {
            $table->integer('id_ppk');
            $table->string('nm_kegiatan');
            $table->string('id_sertifikat');
            $table->string('no_sertifikat');
            $table->string('tgl_sertifikat');
            $table->string('seri');
            $table->string('kd_pel_muat');
            $table->string('kd_pel_bongkar');
            /*
        id_ppk
        no_ppk
        kd_kegiatan
        nm_kegiatan
        sts_syarat
        id_sertifikat
        no_sertifikat
        tgl_sertifikat
        seri
        nama
        kd_pel_muat
        kd_pel_bongkar
         */
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql2')->dropIfExists('v_for_qr');
    }
}
