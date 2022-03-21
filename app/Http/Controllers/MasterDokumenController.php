<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Trader;
use App\Models\Ppk;
use App\Models\KategoriDokumen;
use App\Models\MasterDokumen;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class MasterDokumenController extends Controller
{
    public function index(Request $request)
    {
        $ppkModel = new Ppk();
        $kategori = array();
        foreach (KategoriDokumen::all() as $item) {
            $kategori[$item->id_kategori] = $item->nama_kategori;
        }
        $masterDokumenModel = new MasterDokumen();
        return view('trader.master_dokumen', [
            "title" => "Dokumen",
            "masters" => $masterDokumenModel->where("id_trader", Auth::user()->id_trader)->where("tipe_dokumen", 1)->get(),
            "kategori" => $kategori,
            "ppks" => $ppkModel->where("id_trader", Auth::user()->id_trader)->get(),
        ]);
    }

    public function master(Request $request){
        return view('trader.addMaster', [
            "title" => "Master Dokumen",
            "kategori" => KategoriDokumen::all(),
        ]);
    }

    public function storeMaster(Request $request){
        
        $messages = [
            'required' => ':attribute wajib diisi ',
            'min' => ':attribute harus diisi minimal :min karakter !!!',
            'max' => ':attribute harus diisi maksimal :max karakter !!!',
            'numeric' => ':attribute harus diisi angka !!!',
            'email' => ':attribute harus diisi dalam bentuk email !!!',
        ];

        $this->validate($request,[
            "id_kategori" => 'required',
            'no_dokumen' => 'required',
            "tgl_terbit" => 'required',
        ],$messages);

        $nm_dokumen = $request->file('nm_dokumen');
        $name = $nm_dokumen->getClientOriginalName();
        $path = 'files';
        $nm_dokumen->move($path, $name);
                
        MasterDokumen::insert([
            'no_dokumen' => $request->no_dokumen,
            'nm_dokumen'=> $name,
            "tgl_terbit" => $request->tgl_terbit,
            "tgl_expired" =>Carbon::createFromFormat('Y-m-d', $request->tgl_terbit)->addMonth(),
            "status" => "non-Aktif",
            "tipe_dokumen" => 1,
            "id_kategori" => $request->id_kategori,
            "id_trader" => Auth::user()->id_trader,
        ]);
        
        // $master = new MasterDokumen();
        // $master->no_dokumen = $request->no_dokumen;
        // $master->tgl_terbit = $request->tgl_terbit;
        // $master->id_kategori = $request->nm_dokumen;
        // $master->id_trader = Auth::user()->id_trader;

        return redirect('/master');
    }

    public function getIf($id_master){
        $master = DB::select("SELECT * FROM $this->table WHERE id_master='$id_master'");
        return $master;
    }
}
