<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vDataHeader extends Model
{
    use HasFactory;
    protected $connection = 'sqlsrv2';
    protected $table ="v_data_header";
    protected $primaryKey='id_ppk';
    public $timestamps = false;
    protected $fillable = [
        'no_ppk',
        'no_aju_ppk',
        'id_trader',
        'nm_trader',
        'tgl_ppk',
        'kd_kegiatan',
        'nm_penerima',
        'alamat',
        'negara_penerima',
    ];
}
