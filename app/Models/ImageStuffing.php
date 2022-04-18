<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageStuffing extends Model
{
    use HasFactory;
    protected $table ="images_stuffing";
    protected $primaryKey='id';
    protected $fillable = [
        'images',
        'id_ppk',
    ];
    public $timestamps = false;
}
