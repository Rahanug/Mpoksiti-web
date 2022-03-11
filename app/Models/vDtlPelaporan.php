<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vDtlPelaporan extends Model
{
    use HasFactory;
    protected $table ="v_dtl_pelaporan";
    public $timestamps = false;
    protected $fillable = [
        'id_ppk',
        'id_kd_ikan',
        'kd_ikan_lokal_ol',
        'kd_ikan',
        'nm_lokal',
        'nm_umum',
        'nm_latin',
        'jumlah',
        'satuan',
        'hscode',
        'no_urut_hs',
        'kd_tarif',
        'keterangan',
        'tarif',
        'kd_kel_ikan',
        'jn_pemeriksaan',
        'id_satuan',
        'satuan_int',
        'satuan_nsw',
        'kd_kel_tarif',
        'nm_kel_tarif',
        'id_kd_lokal',
        'kd_jenis_kel',
        'kelas',
        'kelompok',
        'ket_kelompok',
        'konsumsi',
        'tawar',
        'hidup',
        'bentuk',
        'hias',
        'pelagis',
        'nilai',
        'nilai_ref',
        'status',
        'ukuran',
        'pembagian',
        'ket_kelas',
        'no_hs',
        'grup_0',
        'grup_1',
        'grup_2',
        'des',
        'des_1',
        'des_2',
        'des_3',
        'des_4',
        'no_urut',
        'nilai_percmdts',
        'jml_kg',
        'satuan_kg',
        'nilai_usd_cmdts',
        'jml_kirim',
        'jml_kg_kirim',
        'ket_bentuk',
        'id_kel_ikan',
        'nm_kel_ikan',
        'asal_cmdts',
        'konsumsi_ppk',
    ];
}
