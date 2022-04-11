<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Trader;
use App\Models\Ppk;
use App\Models\KategoriDokumen;
use App\Models\MasterDokumen;
use App\Models\vDataHeader;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class MasterDokumenController extends Controller
{
    // Halaman Trader
    public function index(Request $request)
    {
        $ppkModel = new vDataHeader();
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
            'id_kategori.required' => 'Kategori wajib dipilih',
            'no_dokumen.required' => 'Nomor dokumen wajib diisi',
            'tgl_terbit.required' => 'Tanggal terbit diisi',
            'nm_dokumen.required' => 'Dokumen wajib diunggah',
            'min' => ':attribute harus diisi minimal :min karakter !!!',
            'max' => ':attribute harus diisi maksimal :max karakter !!!',
            'numeric' => ':attribute harus diisi angka !!!',
            'email' => ':attribute harus diisi dalam bentuk email !!!',
            'nm_dokumen.mimes'=> 'Format dokumen harus berupa pdf!!!'
        ];

        $this->validate($request,[
            "id_kategori" => 'required',
            'no_dokumen' => 'required',
            "tgl_terbit" => 'required',
            'nm_dokumen'=> 'required|mimes:pdf,'
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

        return redirect('/master')->with('success', 'Master dokumen telah ditambahkan!!!');
    }

    

    // Halaman Admin
    public function indexAdmin(Request $request)
    {
        $traderModel = new Trader();
        $traderNon = $traderModel->join('master_dokumens', 'traders.id_trader', '=', 'master_dokumens.id_trader')->where('master_dokumens.status', '=', 'non-Aktif')->where('master_dokumens.tipe_dokumen', '=', 1)->count();
        $traderAktif = $traderModel->join('master_dokumens', 'traders.id_trader', '=', 'master_dokumens.id_trader')->where('master_dokumens.status', '=', 'Aktif')->where('master_dokumens.tipe_dokumen', '=', 1)->count();
        $traderUserNons = $traderModel->selectRaw('traders.id_trader, COUNT(master_dokumens.id_master) AS count')->leftJoin('master_dokumens', 'traders.id_trader', '=', 'master_dokumens.id_trader')->where('master_dokumens.status', '=', 'non-Aktif')->where('master_dokumens.tipe_dokumen', '=', 1)->groupby('traders.id_trader')->get();
        return view('admin.master_dokumen_admin', [
            "title"=>"Master Dokumen Trader",
            "traders"=>$traderModel->all(),
            "countNon"=>$traderNon,
            "countAktif"=>$traderAktif,
            "countMaster"=> $this->mapCountMaster($traderUserNons)
        ]);
    }
    // HashMap menghitung master tidak aktif
    private function mapCountMaster($listCount){
        $result = array();
        foreach ($listCount as $count){
            $result[$count['id_trader']] = $count['count'];
        }
        return $result;
    }

    // Halaman verifikasi
    public function verifikasi($trader)
    {
        $master_dokumen = new MasterDokumen;
        return view('admin.verifikasi',[
            "title"=>"Verifikasi",
            "masters"=>$master_dokumen->where('id_trader', $trader)->where('tipe_dokumen', '1')->get(),
        ]);
    }

    // Setuju
    public function accept($id_master){
        // $id_master = $request->input('id_master');
            MasterDokumen::where('id_master', $id_master)->update([
                "status"=>"Aktif",
            ]);
        
        
        return redirect()->back()->with('accept', 'Master dokumen telah diterima!!!');;
    }

    public function decline($id_master){
        // $id_master = $request->input('id_master');
            MasterDokumen::where('id_master', $id_master)->update([
                "status"=>"Gagal",
            ]);
        
        
        return redirect()->back()->with('decline', 'Master dokumen telah ditolak!!!');
    }


    public function getIf($id_master){
        $master = DB::select("SELECT * FROM master_dokumens WHERE id_master='$id_master'");
        return $master;
    }

    public function editMaster($id_master)
    {   
        return view('trader.editMaster', [
            "title" => "Edit Order",
            'editMasters' => $this->getIf($id_master), 
            "kategori" => KategoriDokumen::all(),
            "id_master"=> $id_master
        ]);
    }



    public function updateMaster(Request $request, $id_master){
        
        $messages = [
            'required' => ':attribute wajib diisi ',
            'id_kategori.required' => 'Kategori wajib dipilih',
            'no_dokumen.required' => 'Nomor dokumen wajib diisi',
            'tgl_terbit.required' => 'Tanggal terbit diisi',
            'nm_dokumen.required' => 'Dokumen wajib diunggah',
            'min' => ':attribute harus diisi minimal :min karakter !!!',
            'max' => ':attribute harus diisi maksimal :max karakter !!!',
            'numeric' => ':attribute harus diisi angka !!!',
            'email' => ':attribute harus diisi dalam bentuk email !!!',
            'nm_dokumen.mimes'=> 'Format dokumen harus berupa pdf!!!'
        ];

        $this->validate($request,[
            "id_kategori" => 'required',
            'no_dokumen' => 'required',
            "tgl_terbit" => 'required',
            'nm_dokumen'=> 'required|mimes:pdf,'
        ],$messages);

        $nm_dokumen = $request->file('nm_dokumen');
        $name = $nm_dokumen->getClientOriginalName();
        $path = 'files';
        $nm_dokumen->move($path, $name);
                
        MasterDokumen::where('id_master', $id_master)->update([
            'no_dokumen' => $request->no_dokumen,
            'nm_dokumen'=> $name,
            "tgl_terbit" => $request->tgl_terbit,
            "id_kategori" => $request->id_kategori,
        ]);
        
        // $master = new MasterDokumen();
        // $master->no_dokumen = $request->no_dokumen;
        // $master->tgl_terbit = $request->tgl_terbit;
        // $master->id_kategori = $request->nm_dokumen;
        // $master->id_trader = Auth::user()->id_trader;

        return redirect('/master')->with('info', 'Master dokumen telah terganti!!!');
    }
}
