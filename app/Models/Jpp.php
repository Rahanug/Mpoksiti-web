<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Jpp extends Authenticatable
{
    use HasFactory;
    protected $table ="jpp";
    protected $primaryKey='id';
    public $timestamps = false;
    protected $fillable = [
        'kode_counter',
        'nama_counter',
        'alamat_counter',
        'latitude',
        'longitude',
        'penanggungJawab',
        'id_kurir',
        'password'
    ];
}
