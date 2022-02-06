<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class ManagementUserController extends Controller
{
    public function __construct()
    {

    }

    private $table = "traders";
    public function all()
    {
        $manage = DB::select("SELECT * FROM $this->table");
        return $manage;
    }
}
