<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PpkController extends Controller
{
    private $table = "ppks";
    public function all(){
        $ppks = DB::select("SELECT * FROM $this->table");
        return $ppks;
    }

    public function getIf($id_ppk){
        $ppk = DB::select("SELECT * FROM $this->table WHERE id_ppk='$id_ppk'");
        return $ppk;
    }

    public function getPpksByNoPpk($no_ppk){
        $ppks = DB::select("SELECT * FROM $this->table WHERE no_ppk='$no_ppk' OR name like '%$no_ppk%'");
        return $ppks;
    }

}
