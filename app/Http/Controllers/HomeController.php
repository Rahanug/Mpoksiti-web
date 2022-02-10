<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Trader;
use App\Models\Ppk;
use App\Models\KategoriDokumen;
use Illuminate\Support\Facades\DB;
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
            "title" => "Proses Stuffing", 
            "ppks" => $ppkModel->where("id_trader", Auth::user()->id_trader)->get(),
            "trader" => $trader,
        ]); 
    }

    public function dokumen($id_ppk){
        $ppks = new PpkController();
        $ppk = $ppks->getIf($id_ppk)[0];
        $dokumens = new DokumenController();
        $dokumenModel = new KategoriDokumen();
        return view('trader.document',[
            "title"=>"Unggah Dokumen",
            "ppk"=> $ppk,
            "dokumens"=>$dokumens->all(),
        ]);
    }
}
