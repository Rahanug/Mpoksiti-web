<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;
    protected $table = 'images';
    protected $fillable = [
        'id_ppk',
        'no_aju_ppk', 
        'kd_ikan',
        'url_file',
        'latitude',
        'longitude',
        'id_trader'
    ];
}
