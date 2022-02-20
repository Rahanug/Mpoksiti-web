<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jpp;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class JPPController extends Controller
{
    public function index(Request $request) {
        return view('jpp.home', [
            "title" => "dashboard",
        ]);
    }

    public function pemeriksaan(String $kode_counter) {
        $list_ppk = DB::select("SELECT * FROM ppks WHERE kode_counter_jpp = ".$kode_counter);
        return view('jpp.pemeriksaan', [
            "title" => "pemeriksaan",
            "list_ppk" => $list_ppk
        ]);
    }
    
}
