<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisKurir extends Model
{
    use HasFactory;
    protected $table ="kurir";
    protected $primaryKey='id';
    public $timestamps = false;
    protected $fillable = [
        'namaKurir',
        'is_active'
    ];
}
