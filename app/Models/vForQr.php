<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vForQr extends Model
{
    use HasFactory;
    protected $connection = 'sqlsrv2';
    protected $table ="v_for_qr";
    protected $primaryKey='id_ppk';
    public $timestamps = false;
    protected $fillable = [
        'nm_kegiatan',
        'id_sertifikat',
        'no_sertifikat',
        'tgl_sertifikat',
        'seri',
        'kd_pel_muat',
        'kd_pel_bongkar'
    ];
}
