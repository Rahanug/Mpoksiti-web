<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ppk extends Model
{
    use HasFactory;
    protected $table ="ppks";
    protected $primaryKey='id';
    public $timestamps = false;
    protected $fillable = [
        'id_ppk',
        'status',
        'id_trader',
        'jadwal_periksa',
        'url_periksa',

    ];
}
