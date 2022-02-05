<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jpp extends Model
{
    use HasFactory;
    protected $table ="jpps";
    protected $primaryKey='id';
    public $timestamps = false;
    protected $fillable = [
        'kodeCounter',
        'jenisJasper',
        'latitude',
        'longtitude',
        'penanggungJawab'  
    ];
}
