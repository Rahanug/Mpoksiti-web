<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RPTHarianModel extends Model
{
    use HasFactory;
    protected $connection = 'sqlsrv2';
    protected $table = 'v_rpt_ops_harian';
    // protected $primaryKey = 'id_ppk';
    protected $fillable = [
        'id_ppk',
        'no_sertifikat',
        'tgl_sertifikat',
    ];
}