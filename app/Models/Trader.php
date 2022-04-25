<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Trader extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = "traders";
    protected $primaryKey = "id_trader";
    public $timestamps = false;
    protected $fillable = [
        'id_trader', 'nm_trader', 'npwp',  'no_hp', 'email', 'password',
    ];
}
