<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DokumenController extends Controller
{
    private $table = "kategori_dokumens";
    public function all(){
        $dokumen = DB::select("SELECT * FROM $this->table");
        return $dokumen;
    }
}
