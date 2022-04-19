<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrMstPelaporan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->down();
        Schema::connection('mysql2')->create('tr_mst_pelaporan', function (Blueprint $table) {
            $table->integer('id_ppk');
            $table->string('code_qr');
            /*
        id_ppk
        no_ppk
        kd_kegiatan
        no_aju_ppk
        kd_input
        tgl_input
        tgl_ppk
        tgl_berangkat
        tgl_periksa
        tgl_periksa_2
        id_trader
        id_penerima
        id_instalasi
        kd_pel_muat
        kd_pel_transit
        kd_pel_bongkar
        id_ppjk    id_kontak
        id_angkut
        voyage
        id_timbun
        no_moda
        flag_moda
        id_angkut_transit
        voyage_transit
        no_moda_transit
        flag_moda_transit
        kd_mks_kirim
        sts_syarat
        id_komoditas
        kid12
        kid14
        kd_upt_tujuan
        negara_propinsi
        konsumsi
        bruto
        netto
        nilai
        id_stn
        add_info
        sts_dok
        sts_jju
        sts_lain
        sts_klinis
        sts_lab
        sts_ppk
        sts_up
        pembatalan
        kpbc
        nm_penerima
        al_penerima
        ngr_prop_penerima
        nm_trader
        al_trader
        npwp_trader
        nm_ppjk
        al_ppjk
        npwp_ppjk
        id_sub_kategori
        no_ssm
        nilai_komoditas_usd
        code_qr
        karantina_mutu
        usd    alasan_pembatalan
        jns_tangkapan
        kt_port    ket_kategori
        ket_sub_kategori
        nil_net_cmdts
        op

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
        Schema::connection('mysql2')->dropIfExists('tr_mst_pelaporan');
    }
}
