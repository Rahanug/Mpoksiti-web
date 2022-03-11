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
        'nm_dokumen', 
        'status',
        'tipe_dokumen',
        'tgl_terbit',
        'tgl_expired',
        'id_kategori',
        'id_trader',
    ];
    protected $dates = ['tgl_terbit','tgl_expired',];
    public $timestamps = false;

}
