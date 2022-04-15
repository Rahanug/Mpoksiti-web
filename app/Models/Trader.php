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
        'nm_trader', 'al_trader', 'kt_trader', 'npwp', 'no_ktp', 'no_izin', 'no_hp', 'email', 'password',
    ];
}
