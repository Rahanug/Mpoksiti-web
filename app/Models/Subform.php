<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subform extends Model
{
    use HasFactory;
    protected $table ="subform";
    protected $primaryKey='id_subform';
    public $timestamps = false;
    protected $fillable = [
        'urutan',
        'value',
        'keterangan',
        'visibility',
        'id_masterSubform',
        'id_master'
    ];
}
