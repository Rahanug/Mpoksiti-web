<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ppk extends Model
{
    use HasFactory;
    protected $table ="ppks";
    protected $primaryKey='id_ppk';
    public $timestamps = false;
    protected $fillable = [
        'no_ppk',
        'no_aju_ppk', 
        'jumlah',
        'satuan',
        'status',
        'nm_penerima',
        'id_trader',
    ];
}
