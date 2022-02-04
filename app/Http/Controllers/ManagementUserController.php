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

    public function getTraderByNpwp($npwp)
    {
        $npwp = strtolower($npwp);
        $manage = DB::select("SELECT * FROM $this->table WHERE npwp='$npwp' OR nm_trader like '%$npwp%'");
        return $manage;
    }
}
