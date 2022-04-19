<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class trMstPelaporan extends Model
{
    use HasFactory;
    protected $connection = 'mysql2';
    protected $table = "tr_mst_pelaporan";
    protected $primaryKey = 'id_ppk';
    public $timestamps = false;
    protected $fillable = [
        'code_qr',
    ];
}
