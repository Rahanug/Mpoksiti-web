<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class chatbotAdminModel extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'chatbot_admin';
    protected $primaryKey = 'id';
    protected $fillable = [
        'no_wa',
        'username'
    ];
}