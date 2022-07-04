<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Pengolahan extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = "pengolahans";
    protected $primaryKey = "id_user";
    public $timestamps = false;
    protected $fillable = [
        'id_user', 'nm_user', 'npwp', 'no_hp', 'email', 'password',
    ];
}
