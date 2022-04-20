<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FlowguideModel extends Model
{
    use HasFactory;
    protected $connection = 'sqlsrv2';
    protected $table = 'v_for_flowguide';
    protected $primaryKey = 'id_ppk';
    protected $fillable = [
        'id_ppk',
        'no_aju_ppk',
        'id_urut',
        'nm_dok',
        'kd_kegiatan'
    ];
}