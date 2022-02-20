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
        /*$trader = array();
        foreach(Trader::all() as $item) {
            $trader[$item->id_trader] = $item->nm_trader;
        }
        $ppks = new PpkController();
        $ppkModel = new Ppk(); 
        return view('trader.home',[
            "title" => "Proses Stuffing", 
            "ppks" => $ppkModel->where("id_trader", Auth::user()->id_trader)->get(),
            "trader" => $trader,
        ]);*/
    }

    public function pemeriksaan(Request $request) {
        return view('jpp.pemeriksaan', [
            "title" => "pemeriksaan",
        ]);
        /*$trader = array();
        foreach(Trader::all() as $item) {
            $trader[$item->id_trader] = $item->nm_trader;
        }
        $ppks = new PpkController();
        $ppkModel = new Ppk(); 
        return view('trader.home',[
            "title" => "Proses Stuffing", 
            "ppks" => $ppkModel->where("id_trader", Auth::user()->id_trader)->get(),
            "trader" => $trader,
        ]);*/
    }
    
}
