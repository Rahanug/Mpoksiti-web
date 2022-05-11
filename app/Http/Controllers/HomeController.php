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
// use App\Models\vDataHeader;
use App\Models\MasterSubform;
use App\Models\Subform;
use App\Models\ImageStuffing;
use DOMPDF;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $id_ppk = $request->input('id_ppk');
        $master = array();
        foreach (MasterSubform::all() as $item) {
            $master[$item->id_masterSubform] = $item->indikator;
        }
        $trader = array();
        foreach (Trader::all() as $item) {
            $trader[$item->id_trader] = $item->nm_trader;
        }
        $ppks = new PpkController();
        $ppkModel = new Ppk();
        // $vdataHeader = new vDataHeader();
        $dbView = DB::connection('sqlsrv')->getDatabaseName() . '.dbo';
        $dbView2 = DB::connection('sqlsrv2')->getDatabaseName() . '.dbo';
        $viewPpk = DB::connection('sqlsrv2')->table('v_data_header')
            ->leftJoin("$dbView.ppks AS ppks", 'v_data_header.id_ppk', '=', "ppks.id_ppk")
            ->where('v_data_header.kd_kegiatan', 'E')
            ->where("v_data_header.id_trader", Auth::user()->id_trader)
            ->where( 'v_data_header.tgl_ppk', '>', Carbon::now()->subDays(4))
            ->select('ppks.*', 'v_data_header.*')
            ->orderBy('v_data_header.tgl_ppk', 'ASC')
            ->get();
        foreach ($viewPpk as $data) {
            $data->subform = Subform::rightJoin("ppks as ppks", "subform.id_ppk", "ppks.id_ppk")
                ->select("ppks.*", "subform.*")
                ->where("subform.id_ppk", $data->id_ppk)
                ->get();
        }
        foreach ($viewPpk as $image) {
            $image->stuffing = ImageStuffing::rightJoin("$dbView2.v_data_header as v_data_header", "images_stuffing.id_ppk", "v_data_header.id_ppk")
                ->select('v_data_header.*', 'images_stuffing.*')
                ->where("images_stuffing.id_ppk", $image->id_ppk)
                ->get();
        }
        return view('trader.home', [
            "title" => "Dashboard",
            "ppks" => $viewPpk,
            "trader" => $trader,
            "master" => $master,
        ]);
    }

    public function dokumen($id_ppk)
    {
        $ppks = new PpkController();
        $ppk = $ppks->getIf($id_ppk)[0];
        $dbView = DB::connection('sqlsrv2')->getDatabaseName() . '.dbo';

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
        $dbView = DB::connection('sqlsrv2')->getDatabaseName() . '.dbo';
        $masterDokumenModel = new MasterDokumen();
        return view('trader.document', [
            "title" => "Unggah Dokumen",
            "ppk" => $ppk,
            "kategoris" => $kategoriModel->where('status', 1)->get(),
            "dokumens" => $this->getDetailDokumen($id_ppk),
            "masters" => $masterDokumenModel->where("id_trader", Auth::user()->id_trader)->get(),
            "kategoriMaster" => $kategori,
            "masterDokumens" => $this->getMasterDokumen(),
            "id_ppk" => $id_ppk,
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

    // Tidak dipakai karena yg dipakai get detail dokumen 
    // private function getNamaDokumen($id_ppk)
    // {
    //     $dokumens = new Dokumen();
    //     $list_dokumen = $dokumens->where('id_ppk', $id_ppk)->get();
    //     $result = array();
    //     foreach ($list_dokumen as $dokumen) {
    //         $result[$dokumen['id_kategori']] = array('id_master' => $dokumen['id_master']);
    //         $result[$dokumen['id_kategori']] += array('id_dokumen' => $dokumen['id_dokumen']);
    //     }
    //     return $result;
    // }

    private function getDetailDokumen($id_ppk)
    {
        $dokumens = new Dokumen();
        $list_dokumen = $dokumens->where('id_ppk', $id_ppk)
            ->join('master_dokumens', 'dokumens.id_master', '=', 'master_dokumens.id_master')
            ->get();
        $result = array();
        foreach ($list_dokumen as $dokumen) {
            $result[$dokumen['id_kategori']] = array('nm_dokumen' => $dokumen['nm_dokumen']);
            $result[$dokumen['id_kategori']] += array('no_dokumen' => $dokumen['no_dokumen']);
            $result[$dokumen['id_kategori']] += array('tgl_terbit' => $dokumen['tgl_terbit']);
            $result[$dokumen['id_kategori']] += array('id_dokumen' => $dokumen['id_dokumen']);
        }
        return $result;
    }


    private function getMasterDokumen()
    {
        $dokumens = new MasterDokumen();
        $list_dokumen = $dokumens
            ->where('status', 'Aktif')
            ->where('tipe_dokumen', 1)
            ->where('id_trader', Auth::user()->id_trader)
            ->get();
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
    public function storeDokumen(Request $request)
    {

        $messages = [
            'required' => ':attribute wajib diisi ',
            'min' => ':attribute harus diisi minimal :min karakter !!!',
            'max' => ':attribute harus diisi maksimal :max karakter !!!',
            'numeric' => ':attribute harus diisi angka !!!',
            'email' => ':attribute harus diisi dalam bentuk email !!!',
            'nm_dokumen.mimes'=> 'Format dokumen harus berupa pdf, jpg, jpeg, atau png!!!'
        ];

        $this->validate($request, [
            "id_kategori" => 'required',
            'no_dokumen' => 'required',
            "tgl_terbit" => 'required',
            'nm_dokumen'=> 'required|mimes:pdf,jpg,jpeg,png',
        ], $messages);

        $nm_dokumen = $request->file('nm_dokumen');
        $name = $nm_dokumen->getClientOriginalName();
        $path = 'files';
        $nm_dokumen->move($path, $name);

        DB::beginTransaction();
        $id = MasterDokumen::insertGetId([
            'no_dokumen' => $request->no_dokumen,
            'nm_dokumen' => $name,
            "tgl_terbit" => $request->tgl_terbit,
            "tgl_expired" => Carbon::createFromFormat('Y-m-d', $request->tgl_terbit)->addMonth(),
            "status" => "Aktif",
            "tipe_dokumen" => 0,
            "id_kategori" => $request->id_kategori,
            "id_trader" => Auth::user()->id_trader,
        ]);
        Dokumen::create([
            'id_master' => $id,
            'id_ppk' => $request->input('id_ppk'),
        ],
        );
        Ppk::updateOrCreate(
        [
            'id_ppk' => $request->input('id_ppk')
        ],
        [
            'status' => 'verifikasi'
        ]);
        DB::commit();
        // $master = new MasterDokumen();
        // $master->no_dokumen = $request->no_dokumen;
        // $master->tgl_terbit = $request->tgl_terbit;
        // $master->id_kategori = $request->nm_dokumen;
        // $master->id_trader = Auth::user()->id_trader;

        return redirect()->back();
    }

    // Tidak dipakai, harusnya untuk store Dokumen tanpa no dokumen
    // public function store(Request $request, $id_ppk)
    // {
    //     // $validatedData = $request->validate([
    //     //     'Dokumen' => 'required|csv,txt,xlx,pdf|max:2048',
    //     // ]);
    //     $now = now();
    //     $ppks = new PpkController();
    //     $ppk = $ppks->getIf($id_ppk)[0];
    //     $listIdKategori = KategoriDokumen::pluck('id_kategori');
    //     DB::beginTransaction();
    //     foreach ($listIdKategori as $idKategori) {
    //         $name_file = $request->file('nm_dokumen-' . $idKategori);
    //         if (isset($name_file)) {
    //             $name = $name_file->getClientOriginalName();
    //             $path = 'files';
    //             $name_file->move($path, $name);
    //             Dokumen::create([
    //                 "no_dokumen" => "1",
    //                 "nm_dokumen" => $name,
    //                 // "tgl_dokumen" => $now,
    //                 // "tgl_berlaku" => $now,
    //                 // "tgl_lulus" => $now,
    //                 "id_ppk" => $ppk->id_ppk,
    //                 "id_kategori" => $idKategori,
    //             ]);
    //         }
    //     }
    //     DB::commit();
    //     return redirect('/home')->with('status', 'File Success');
    // }


    public function pilihMaster(Request $request)
    {
        $id_master = $request->input('id_master');
        $id_ppk = $request->input('id_ppk');

        if (isset($id_master) && isset($id_ppk)) {
            DB::beginTransaction();
            Dokumen::insert([
                'id_ppk' => $id_ppk,
                'id_master' => $id_master,
            ]);
            Ppk::updateOrCreate(
                [
                    'id_ppk' => $request->input('id_ppk')
                ],
                [
                    'status' => 'verifikasi'
                ]);
            DB::commit();
            echo json_encode([
                'error' => false
            ]);
        } else {
            echo json_encode([
                'error' => true
            ]);
        }
        // echo json_encode([
        //         'error'=>true,
        //         'id_master'=>$id_master,
        //         'id_ppk'=>$id_ppk,
        // ]);
    }

    public function previewDokumen(Request $request, $id_ppk, $id_dokumen)
    {
        $dokumens = new Dokumen();
        $list_dokumen = $dokumens->where('id_ppk', $id_ppk)
            ->join('master_dokumens', 'dokumens.id_master', '=', 'master_dokumens.id_master')
            ->get();
        $result = array();
        foreach ($list_dokumen as $dokumen) {
            $result[$dokumen['id_kategori']] = array('nm_dokumen' => $dokumen['nm_dokumen']);
        }
        $nm_dokumen = $request->file($result);
        $name = $nm_dokumen->getClientOriginalName();
        $path = 'files';
        $nm_dokumen->response()->file($path, $name);
        // if (Dokumen::where('id_dokumen', $id_dokumen)){
        //     return $nm_dokumen;
        // }
    }

    public function deleteDokumen($id_ppk, $id_dokumen)
    {
        if (Dokumen::where('id_dokumen', $id_dokumen)->delete()) {
            return redirect()->back();
        }
        echo $id_dokumen;
    }

    // public function getDateStartAttribute($value)
    // {
    //     return Carbon::parse($value)->format('Y-m-d\TH:i');
    // }

    public function ajukanTanggal(Request $request, $id_ppk)
    {
        $messages = [
            'required' => ':attribute wajib diisi ',
            'jadwal_periksa.required'=> 'Jadwal wajib diisi!!',
            'min' => ':attribute harus diisi minimal :min karakter !!!',
            'max' => ':attribute harus diisi maksimal :max karakter !!!',
            'numeric' => ':attribute harus diisi angka !!!',
            'email' => ':attribute harus diisi dalam bentuk email !!!',
        ];

        $this->validate($request, [
            "jadwal_periksa" => 'required',
        ], $messages);

        Ppk::where('id_ppk', $id_ppk)->update([
            'status' => 'Menunggu',
            'jadwal_periksa' => date('Y-m-d H:i', strtotime($request->jadwal_periksa)),
        ]);
        return redirect()->back();
    }


    public function cetakHC(Request $request, $id_ppk)
    {
        $master = array();
        foreach (MasterSubform::all() as $item) {
            $master[$item->id_masterSubform] = $item->indikator;
        }
        $trader = array();
        foreach (Trader::all() as $item) {
            $trader[$item->id_trader] = $item->nm_trader;
        }
        // $vdataHeader = new vDataHeader();
        $dbView = DB::connection('sqlsrv')->getDatabaseName() . '.dbo';
        $viewPpk = DB::connection('sqlsrv2')->table('v_data_header')
            ->leftJoin("$dbView.ppks AS ppks", 'v_data_header.id_ppk', '=', "ppks.id_ppk")
            ->leftJoin("$dbView.subform as subform", 'v_data_header.id_ppk', '=', "subform.id_ppk")
            ->where("v_data_header.id_ppk", $id_ppk)
            ->select('ppks.*', 'v_data_header.*', 'subform.*')->get();
        $selectName = DB::connection('sqlsrv2')
        ->table('v_data_header')
        ->where("id_ppk", $id_ppk)
        ->get("no_aju_ppk");
        $images = DB::connection('sqlsrv2')->table('v_data_header')
            ->leftJoin("$dbView.images_stuffing AS images", 'v_data_header.id_ppk', '=', "images.id_ppk")
            ->where("v_data_header.id_ppk", $id_ppk)
            ->select('v_data_header.*', 'images.*')->get();
        $data = [
            "title" => "Dashboard",
            "ppks" => $viewPpk,
            "trader" => $trader,
            "master" => $master,
            "trader"=> $trader
            
        ];
        $pdf = DOMPDF::loadView('trader.cetakHC', [
            "title" => "Dashboard",
            "ppks" => $viewPpk,
            "trader" => $trader,
            "master" => $master,
            "trader"=> $trader,
            "images"=> $images
        ])->setOptions([
            'defaultFont' => 'Times New Roman',
            'isPhpEnabled' => true,
            // 'isRemoteEnabled' => true,
        ]);
        
        $pdf->render();
        return $pdf->stream($selectName);
        
        // return view('trader.cetakHC', [
        //         "title" => "Dashboard",
        //         "ppks" => $viewPpk,
        //         "trader" => $trader,
        //         "master" => $master,
        //         "trader"=> $trader
        // ]);
    }

    public function detail(Request $request, $id_ppk)
    {
        $dbView = DB::connection('sqlsrv')->getDatabaseName() . '.dbo';
        $viewPpk = DB::connection('sqlsrv2')->table('v_data_header')
            ->leftJoin("$dbView.ppks AS ppks", 'v_data_header.id_ppk', '=', "ppks.id_ppk")
            ->leftJoin("$dbView.subform as subform", 'v_data_header.id_ppk', '=', "subform.id_ppk")
            ->where("v_data_header.id_ppk", $id_ppk)
            ->select('ppks.*', 'v_data_header.*', 'subform.*')->get();
        $detailPpk = DB::connection('sqlsrv2')->table('v_data_header')->where("v_data_header.id_ppk", $id_ppk)->get();
        $detailStuf = DB::table('Ppks')->where("Ppks.id_ppk", $id_ppk)->get();
        $dokumen = DB::table('dokumens')
        ->leftJoin('master_dokumens as master', 'dokumens.id_master', 'master.id_master')
        ->where('dokumens.id_ppk', $id_ppk)
        ->select('dokumens.*', 'master.*')->get();
        $kategori = array();
        foreach (KategoriDokumen::all() as $item) {
            $kategori[$item->id_kategori] = $item->nama_kategori;
        }
        return view('trader.detail', [
            "title"=> "Detail Stuffing",
            "details"=>$detailPpk,
            "stuffing"=>$detailStuf,
            "dokumen"=>$dokumen,
            "kategori"=>$kategori,
        ]);
    }
}
