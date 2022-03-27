<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vDataHeader extends Model
{
    use HasFactory;
    protected $table ="v_data_header";
    public $timestamps = false;
    protected $fillable = [
        'id_ppk',
        'no_ppk',
        'no_aju_ppk',
        'id_trader',
        'nm_trader'
    ];
}
