<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Trader;
use App\Models\Ppk;
use App\Models\KategoriDokumen;
use App\Models\MasterDokumen;
use App\Models\Dokumen;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $trader = array();
        foreach (Trader::all() as $item) {
            $trader[$item->id_trader] = $item->nm_trader;
        }
        $ppks = new PpkController();
        $ppkModel = new Ppk();
        return view('trader.home', [
            "title" => "Proses Stuffing",
            "ppks" => $ppkModel->where("id_trader", Auth::user()->id_trader)->get(),
            "trader" => $trader,
        ]);
    }

    public function dokumen($id_ppk)
    {
        $ppks = new PpkController();
        $ppk = $ppks->getIf($id_ppk)[0];
        $dokumens = new Dokumen();
        $kategoriModel = new KategoriDokumen();
        // $dokumen = $dokumens->getIf($id_dokumen)[0];
        // $kategoriJoinDokumen = KategoriDokumen::leftJoin('dokumens','kategori_dokumens.id_kategori','=','dokumens.id_kategori')
        // ->where('kategori_dokumens.status', 1)
        // ->get(['dokumens.nm_dokumen','kategori_dokumens.id_kategori', 'kategori_dokumens.nama_dokumen', 'dokumens.no_dokumen']);
        // $filter = $this->filterDocumentByIdPPK($kategoriJoinDokumen, $id_ppk);
        $kategori = array();
        foreach (KategoriDokumen::all() as $item) {
            $kategori[$item->id_kategori] = $item->nama_kategori;
        }
        $masterDokumenModel = new MasterDokumen();
        return view('trader.document', [
            "title" => "Unggah Dokumen",
            "ppk" => $ppk,
            "kategoris" => $kategoriModel->all(),
            "dokumens" => $this->getNamaDokumen($id_ppk),
            "masters" => $masterDokumenModel->where("id_trader", Auth::user()->id_trader)->get(),
            "kategoriMaster" => $kategori,
            "masterDokumens" => $this->getMasterDokumen(),
            "id_ppk"=>$id_ppk,
            // "delDokumen"=> $dokumens
        ]);
        // echo json_encode( [
        //     "title" => "Unggah Dokumen",
        //     "ppk" => $ppk,
        //     "kategoris" => $kategoriModel->all(),
        //     "dokumens" => $this->getNamaDokumen($id_ppk),
        //     "masters" => $masterDokumenModel->where("id_trader", Auth::user()->id_trader)->get(),
        //     "kategoriMaster" => $kategori,
        //     "masterDokumens" => $this->getMasterDokumen(),
        //     // "delDokumen"=> $dokumens
        // ]);
    }

    private function getNamaDokumen($id_ppk)
    {
        $dokumens = new Dokumen();
        $list_dokumen = $dokumens->where('id_ppk', $id_ppk)->get();
        $result = array();
        foreach ($list_dokumen as $dokumen) {
            $result[$dokumen['id_kategori']] = array('nm_dokumen' => $dokumen['nm_dokumen']);
            $result[$dokumen['id_kategori']] += array('id_dokumen' => $dokumen['id_dokumen']);
        }
        return $result;
    }


    private function getMasterDokumen(){
        $dokumens = new MasterDokumen();
        $list_dokumen = $dokumens->all();
        $result = array();
        foreach ($list_dokumen as $dokumen) {
            $result[$dokumen['id_kategori']] = array();
        }
        foreach ($list_dokumen as $dokumen) {
            array_push($result[$dokumen['id_kategori']], [
                'id_master' => $dokumen['id_master'],
                'nm_dokumen' => $dokumen['nm_dokumen'],
                'no_dokumen' => $dokumen['no_dokumen'],
                'tgl_terbit' => $dokumen['tgl_terbit'],
                'status' => $dokumen['status'],
            ]);
        }
        return $result;
    }

    // Store Upload Dokumen
    public function storeDokumen(Request $request){
        
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
                
        MasterDokumen::create([
            'no_dokumen' => $request->no_dokumen,
            'nm_dokumen'=> $name,
            "tgl_terbit" => $request->tgl_terbit,
            "tgl_expired" =>Carbon::createFromFormat('Y-m-d', $request->tgl_terbit)->addMonth(),
            "status" => "non-Aktif",
            "tipe_dokumen" => 0,
            "id_kategori" => $request->id_kategori,
            "id_trader" => Auth::user()->id_trader,
        ]);
        
        // $master = new MasterDokumen();
        // $master->no_dokumen = $request->no_dokumen;
        // $master->tgl_terbit = $request->tgl_terbit;
        // $master->id_kategori = $request->nm_dokumen;
        // $master->id_trader = Auth::user()->id_trader;

        return redirect()->back();
    }

    public function store(Request $request, $id_ppk)
    {
        // $validatedData = $request->validate([
        //     'Dokumen' => 'required|csv,txt,xlx,pdf|max:2048',
        // ]);
        // $id_ppk = DB::select("SELECT id_ppk FROM ppks WHERE id_ppk='$id_ppk'");
        $now = now();
        // $ppkModel = new Ppk();
        // $request = new Request();
        // $KategoriDokumen = new KategoriDokumen();
        // $no_ppk = $ppkModel->where('id_ppk', $id_ppk)->first();
        $ppks = new PpkController();
        $ppk = $ppks->getIf($id_ppk)[0];
        $listIdKategori = KategoriDokumen::pluck('id_kategori');
        DB::beginTransaction();
        foreach ($listIdKategori as $idKategori) {
            $name_file = $request->file('nm_dokumen-' . $idKategori);
            if (isset($name_file)) {
                $name = $name_file->getClientOriginalName();
                $path = 'files';
                $name_file->move($path, $name);
                Dokumen::create([
                    "no_dokumen" => "1",
                    "nm_dokumen" => $name,
                    // "tgl_dokumen" => $now,
                    // "tgl_berlaku" => $now,
                    // "tgl_lulus" => $now,
                    "id_ppk" => $ppk->id_ppk,
                    "id_kategori" => $idKategori,
                ]);
            }
        }
        DB::commit();
        return redirect('/home')->with('status', 'File Success');
    }


    public function pilihMaster(Request $request){
        $id_master = $request->input('id_master');
        $id_ppk = $request->input('id_ppk');

        if(isset($id_master) && isset($id_ppk)){
            Dokumen::insert([
                'id_ppk'=> $id_ppk,
                'id_master'=>$id_master,
            ]);
            echo json_encode([
                'error'=>false
            ]);
        }
        else{
            echo json_encode([
                'error'=>true
            ]);
        }
        // echo json_encode([
        //         'error'=>true,
        //         'id_master'=>$id_master,
        //         'id_ppk'=>$id_ppk,
        // ]);
    }
    public function deleteDokumen($id_ppk, $id_dokumen){
        if (Dokumen::where('id_dokumen', $id_dokumen)->delete()){
            return redirect()->back();
        }
        echo $id_dokumen;
    }
}
