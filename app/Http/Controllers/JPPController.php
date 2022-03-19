<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jpp;
use App\Models\Ppk;
use App\Models\Trader;
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
        $ppkModel = new Ppk();  
        $traderModel = new Trader();
        $list_ppk = $ppkModel->where("kode_counter_jpp", Auth::user()->kode_counter)->get();
        $list_data_ppk = array();
        $count = 0;
        foreach ($list_ppk as $ppk) {
            $trader = $traderModel->where('id_trader', $ppk->id_trader)->get();
            array_push($list_data_ppk, [
                'nama_trader' => $trader[0]->nm_trader,
                'tgl' => 'tes'
            ]);
            $count++;
        }
        return view('jpp.pemeriksaan', [
            "title" => "pemeriksaan",
            "list_ppk" => $list_ppk,
            "list_data_ppk" => $list_data_ppk
        ]);
    }
    
}
