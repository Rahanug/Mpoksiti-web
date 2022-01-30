<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokumen extends Model
{
    use HasFactory;
    protected $table ="dokumens";
    protected $primaryKey='id_dokumen';
    protected $fillable = [
        'kategori_dokumen',
        'no_dokumen', 
        'tgl_dokumen',
        'tgl_berlaku',
        'tgl_lulus',
        'status_dokumen',
    ];
}
