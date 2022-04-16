<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JPPNotif extends Model
{
    use HasFactory;
    protected $table ="jpp_notif";
    protected $primaryKey='id_jpp';
    public $timestamps = false;
}
