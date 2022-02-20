<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Trader;
use App\Models\Ppk;
use App\Models\KategoriDokumen;
use App\Models\MasterDokumen;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class MasterDokumenController extends Controller
{
    public function index(Request $request)
    {
        $kategori = array();
        foreach (KategoriDokumen::all() as $item) {
            $kategori[$item->id_kategori] = $item->nama_kategori;
        }
        $masterDokumenModel = new MasterDokumen();
        return view('trader.master_dokumen', [
            "title" => "Master Dokumen",
            "masters" => $masterDokumenModel->where("id_trader", Auth::user()->id_trader)->get(),
            "kategori" => $kategori,
        ]);
    }

    public function master(Request $request){
        return view('trader.addMaster', [
            "title" => "Master Dokumen",
            "kategori" => KategoriDokumen::all(),
        ]);
    }

    public function storeMaster(Request $request){
        MasterDokumen::create([
            'no_dokumen' => $request->no_dokumen,
            "tgl_terbit" => $request->tgl_terbit,
            "id_kategori" => $request->nm_dokumen,
            "id_trader" => Auth::user()->id_trader,
        ]);
        
        // $master = new MasterDokumen();
        // $master->no_dokumen = $request->no_dokumen;
        // $master->tgl_terbit = $request->tgl_terbit;
        // $master->id_kategori = $request->nm_dokumen;
        // $master->id_trader = Auth::user()->id_trader;

        return redirect('/master');
    }
}
