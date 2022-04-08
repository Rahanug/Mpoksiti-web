<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVDtlPelaporanTable extends Migration
{
    protected $connection = 'sqlsrv2';
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->down();
        /// Tabel ini digunakan AZIZ untuk mencari jenis ikan yang akan dikirim oleh id_ppk tertentu
        Schema::connection('sqlsrv2')->create('v_dtl_pelaporan', function (Blueprint $table) {
            $table->integer('id_ppk');
            $table->string('id_kd_ikan');
            $table->string('kd_ikan_lokal_ol');
            $table->string('kd_ikan');
            $table->string('nm_lokal');
            $table->string('nm_umum');
            $table->string('nm_latin');
            $table->string('satuan');
            $table->string('jumlah');
            $table->string('hscode');
            $table->string('no_urut_hs');
            $table->string('kd_tarif');
            $table->string('keterangan');
            $table->string('tarif');
            $table->string('kd_kel_ikan');
            $table->string('jn_pemeriksaan');
            $table->string('id_satuan');
            $table->string('satuan_int');
            $table->string('satuan_nsw');
            $table->string('kd_kel_tarif');
            $table->string('nm_kel_tarif');
            $table->string('id_kd_lokal');
            $table->string('kd_jenis_kel');
            $table->string('kelas');
            $table->string('kelompok');
            $table->string('ket_kelompok');
            $table->string('konsumsi');
            $table->string('tawar');
            $table->string('hidup');
            $table->string('bentuk');
            $table->string('hias');
            $table->string('pelagis');
            $table->string('nilai');
            $table->string('nilai_ref');
            $table->string('status');
            $table->string('ukuran');
            $table->string('pembagian');
            $table->string('ket_kelas');
            $table->string('no_hs');
            $table->string('grup_0');
            $table->string('grup_1');
            $table->string('grup_2');
            $table->string('des');
            $table->string('des_1');
            $table->string('des_2');
            $table->string('des_3');
            $table->string('des_4');
            $table->string('no_urut');
            $table->string('nilai_percmdts');
            $table->string('jml_kg');
            $table->string('satuan_kg');
            $table->string('nilai_usd_cmdts');
            $table->string('jml_kirim');
            $table->string('jml_kg_kirim');
            $table->string('ket_bentuk');
            $table->string('id_kel_ikan');
            $table->string('nm_kel_ikan');
            $table->string('asal_cmdts');
            $table->string('konsumsi_ppk');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('sqlsrv2')->dropIfExists('v_dtl_pelaporan');
    }
}
