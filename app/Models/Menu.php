<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Menu extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $table = "menus";
    protected $primaryKey = "id_menu";
    public $timestamps = false;
    protected $fillable = [
        'nm_menu', 'url',
    ];
}
