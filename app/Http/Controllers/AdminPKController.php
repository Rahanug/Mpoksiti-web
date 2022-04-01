<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Trader;
use App\Models\PemeriksaanKlinis;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\ServiceProvider;


class AdminPKController extends Controller
{
    /// 
    /// Pemeriksaan Klinis Virtual
    ///

    public function index() {

        $pks = DB::table('pemeriksaan_klinis')
                ->join('jpp', 'jpp.id', '=', 'pemeriksaan_klinis.id_jpp')
                ->join('v_data_header', 'v_data_header.id_ppk', '=', 'pemeriksaan_klinis.id_ppk')
                ->join('traders', 'v_data_header.id_trader', '=', 'traders.id_trader')
                ->select('jpp.*', 'pemeriksaan_klinis.*', 'v_data_header.*', 'traders.*')
                ->whereNotNull('pemeriksaan_klinis.status_periksa')
                ->get();
        return view('admin.pemeriksaan_klinis', [
            "title"=>"PKVirtual",
            "pks"=>$pks,
        ]);
    }
    
}
