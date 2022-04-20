<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommandModel extends Model
{
    use HasFactory;
    protected $table = 'command';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'command',
        'no_wa'
    ];
}