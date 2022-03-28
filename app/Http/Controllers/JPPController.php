<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jpp;
use App\Models\vDataHeader;
use App\Models\Trader;
use App\Models\PemeriksaanKlinis;
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

    public function pemeriksaan() {
        $traderModel = new Trader();
        $list_ppk = vDataHeader::leftJoin('pemeriksaan_klinis', 'v_data_header.id_ppk', '=', 'pemeriksaan_klinis.id_ppk')
                    ->select('v_data_header.*', 'pemeriksaan_klinis.*')
                    ->where("id_jpp", Auth::user()->id)
                    ->get();
        foreach ($list_ppk as $ppk) {
            $trader = $traderModel->where('id_trader', $ppk->id_trader)->get();
            $ppk['nama_trader'] = $trader[0]->nm_trader;
        }
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
