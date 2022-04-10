<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PpkController extends Controller
{
    private $table = "v_data_header";
    public function all(){
        $dbView = DB::connection('sqlsrv2')->getDatabaseName().'.dbo';
        $ppks = DB::select("SELECT * FROM $dbView.v_data_header");
        return $ppks;
    }

    public function getIf($id_ppk){
        $dbView = DB::connection('sqlsrv2')->getDatabaseName().'.dbo';
        $ppk = DB::select("SELECT * FROM $dbView.v_data_header WHERE id_ppk='$id_ppk'");
        return $ppk;
    }

    public function getPpksByNoPpk($no_ppk){
        $dbView = DB::connection('sqlsrv2')->getDatabaseName().'.dbo';
        $ppks = DB::select("SELECT * FROM $dbView.v_data_header WHERE no_ppk='$no_ppk' OR name like '%$no_ppk%'");
        return $ppks;
    }

}
