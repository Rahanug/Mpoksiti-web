<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriDokumen extends Model
{
    use HasFactory;
    protected $table ="Kategori_dokumens";
    protected $primaryKey='id_kategori';
    protected $fillable = [
        'nama_kategori', 
        'status',
        'instansi_penerbit',
    ];
    public $timestamps = false;
}
