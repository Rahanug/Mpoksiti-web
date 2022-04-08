<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Trader;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class JPPController extends Controller
{
    public function index(Request $request) {
        return view('jpp.home', [
            "title" => "dashboard",
        ]);
    }

    public function pemeriksaan() {
        $dbView = DB::connection('sqlsrv2')->getDatabaseName().'.dbo';
        $list_ppk = DB::table("pemeriksaan_klinis")
            ->joinSub("SELECT * FROM $dbView.v_data_header", 'data_view', function ($join) {
                $join->on('pemeriksaan_klinis.id_ppk', '=', 'data_view.id_ppk');
            })
            ->join('traders', 'data_view.id_trader', '=', 'traders.id_trader')
            ->select('*') //TODO dont select everything
            ->where("id_jpp", Auth::user()->id)
            ->get();
        return view('jpp.pemeriksaan', [
            "title" => "pemeriksaan",
            "list_ppk" => $list_ppk
        ]);
    }

    public function permohonan_pemeriksaan_virtual(Request $request){
        DB::table('pemeriksaan_klinis')
              ->where('id_ppk', $request->id_ppk)
              ->update(['status_periksa' => 1]);
        return redirect('/jpp/pemeriksaan');
    }
    
}
