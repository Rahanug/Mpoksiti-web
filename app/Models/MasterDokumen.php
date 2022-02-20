<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterDokumen extends Model
{
    use HasFactory;
    protected $table ="master_dokumens";
    protected $primaryKey='id_master';
    protected $fillable = [
        'no_dokumen', 
        'tgl_terbit',
        'id_kategori',
        'id_trader',
    ];
    public $timestamps = false;

}
