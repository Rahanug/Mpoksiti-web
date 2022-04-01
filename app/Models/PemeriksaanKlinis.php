<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemeriksaanKlinis extends Model
{
    use HasFactory;
    protected $table ="pemeriksaan_klinis";
    protected $primaryKey='id';
    public $timestamps = false;
    protected $fillable = [
        'id_ppk',
        'id_jpp',
        'status',           //TODO sementara null=belum disetujui, 1=diproses, 2=disetujui 3=ditolak
        'status_periksa',   //TODO sementara null=belum mengajukan, 1=sudah mengajukan, 2=link diberikan
        'jadwal_periksa', 
        'url_periksa',
        'no_sertif'
    ];
}
