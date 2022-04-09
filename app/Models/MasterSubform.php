<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterSubform extends Model
{
    use HasFactory;
    protected $table ="master_subform";
    protected $primaryKey='id_masterSubform';
    public $timestamps = false;
    protected $fillable = [
        'indikator',
        'tipe_data', 
    ];
}
