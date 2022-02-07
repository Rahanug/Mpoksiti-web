<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Trader;
use App\Models\Ppk;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(Request $request) {
        $trader = array();
        foreach(Trader::all() as $item) {
            $trader[$item->id_trader] = $item->nm_trader;
        }
        $ppks = new PpkController();
        $ppkModel = new Ppk(); 
        return view('trader.home',[
            "title" => "Upload Dokumen", 
            "ppks" => $ppkModel->where("id_trader", Auth::user()->id_trader)->get(),
            "trader" => $trader,
            "status1"=> $ppkModel->where("status", "lPengajuan"),
        ]); 
    }
}
