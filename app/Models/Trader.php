<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Trader extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $table = "traders";
    protected $primaryKey = "id_trader";
    public $timestamps = false;
    protected $fillable = [
        'nm_trader','al_trader','kt_trader', 'npwp','no_ktp', 'no_izin', 'email', 'password', 
    ];
}
