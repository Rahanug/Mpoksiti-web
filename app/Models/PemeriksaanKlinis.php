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
        'status'
    ];
}
