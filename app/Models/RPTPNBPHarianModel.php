<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RPTPNBPHarianModel extends Model
{
    use HasFactory;
    protected $connection = 'sqlsrv2';
    protected $table = 'v_rpt_pnbp_harian';
    // protected $primaryKey = 'id_ppk';
    protected $fillable = [
        'id_ppk',
        'no_aju_ppk',
        'kd_kegiatan',
        'kel_tarif',
        'total',
        'tgl_pnbp'
    ];
}