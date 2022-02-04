<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Trader;
class HomeController extends Controller
{
    public function index(Request $request) {
        $trader = array();
        foreach(Trader::all() as $item) {
            $trader[$item->id_trader] = $item->nm_trader;
        }
        $ppks = new PpkController(); 
        return view('trader.home',[
            "title" => "Upload Dokumen", 
            "ppks" => $ppks->all(),
            "trader" => $trader,
        ]); 
    }
}
