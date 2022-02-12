<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Trader;
use App\Models\Ppk;
use App\Models\KategoriDokumen;
use App\Models\Dokumen;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

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
        $dokumens = new Dokumen();
        $kategoriModel = new KategoriDokumen();
        // $kategoriJoinDokumen = KategoriDokumen::leftJoin('dokumens','kategori_dokumens.id_kategori','=','dokumens.id_kategori')
        // ->where('kategori_dokumens.status', 1)
        // ->get(['dokumens.nm_dokumen','kategori_dokumens.id_kategori', 'kategori_dokumens.nama_dokumen', 'dokumens.no_dokumen']);
        // $filter = $this->filterDocumentByIdPPK($kategoriJoinDokumen, $id_ppk);
           
        return view('trader.document',[
            "title"=>"Unggah Dokumen",
            "ppk"=> $ppk,
            "kategoris"=> $kategoriModel->all(),
            "dokumens"=>$this->getNamaDokumen($id_ppk),
        ]);
        // echo json_encode($this->getNamaDokumen($id_ppk));
    }

    private function getNamaDokumen($id_ppk){
        $dokumens = new Dokumen();
        $list_dokumen = $dokumens->where('no_dokumen',$id_ppk)->get();
        $result = array();
        foreach($list_dokumen as $dokumen){
            $result[$dokumen['id_kategori']] = array();
        }
        foreach($list_dokumen as $dokumen){
            $result[$dokumen['id_kategori']] = array('nm_dokumen' => $dokumen['nm_dokumen']);
        }
        return $result;
    }

    // private function filterDocumentByIdPPK($list_dokumen, $id_ppk){
    //     $result = array();
    //     foreach($list_dokumen as $dokumen){
    //         if ($dokumen['no_dokumen'] == $id_ppk) {
    //             array_push($result, $dokumen);
    //         }
    //     }
    //     return $result; 
    // }

    public function store(Request $request){
        // $validatedData = $request->validate([
        //     'Dokumen' => 'required|csv,txt,xlx,pdf|max:2048',
        // ]);

        $name_file = $request->file('nm_dokumen');
        $name = $name_file->getClientOriginalName();
        $path = 'files';
        $name_file->move($path, $name);
        
        // $id_ppk = DB::select("SELECT id_ppk FROM ppks WHERE id_ppk='$id_ppk'");
        $now = now();
        $ppkModel = new Ppk();

        Dokumen::create([
            "no_dokumen"=> "1",
            "nm_dokumen"=>$name,
            "tgl_dokumen"=>$now,
            "tgl_berlaku"=>$now,
            "tgl_lulus"=>$now,
            "id_kategori"=>"1",
        ]);
        // $save->no_dokumen = $ppk->no_ppk;
        // $save->nm_dokumen = $name;
        // $save->tgl_dokumen = $now;
        // $save->tgl_berlaku = $now;
        // $save->tgl_lulus = $now;
        // $save->id_trader = $ppkModel->where("id_trader", Auth::user()->id_trader)->get();
        // $save->id_ppk = $ppk->id_ppk;
        // $save->id_dokumen = '1';

        
        return redirect('/home')->with('status', 'File Success');
    }
}
