<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageAdmin extends Model
{
    use HasFactory;
    protected $table ="images_admin";
    protected $primaryKey='id';
    protected $fillable = [
        'url_file',
        'id_ppk',
    ];
    public $timestamps = false;
}
