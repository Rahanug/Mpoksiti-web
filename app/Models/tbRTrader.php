<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbRTrader extends Model
{
    use HasFactory;
    protected $connection = 'mysql2';
    protected $table = "tb_r_trader";
    protected $primaryKey = "npwp";
    public $timestamps = false;
    protected $fillable = [
        'id_trader',
        'nm_trader',
        'al_trader',
        'kt_trader',
        'kd_negara',
        'npwp',
        'no_ktp',
        'no_izin',
        'email',
    ];
}
