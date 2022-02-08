<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Publikasi extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $table = "publikasi";
    protected $primaryKey = "id_gambar";
    public $timestamps = false;
    protected $fillable = [
        'nm_gambar', 'file_gambar',
    ];
}
