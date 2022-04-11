<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Trader;
use App\Models\Ppk;
use App\Models\KategoriDokumen;
use App\Models\MasterDokumen;
use App\Models\Dokumen;
use App\Models\MasterSubform;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use App\Models\vDataHeader;
use App\Models\Subform;

class StuffingController extends Controller
{
    public function index(Request $request)
    {
        $trader = array();
        foreach (Trader::all() as $item) {
            $trader[$item->id_trader] = $item->nm_trader;
        }
        $ppks = new PpkController();
        $ppkModel = new Ppk();
        $vdataHeader = new vDataHeader();
        $dbView = DB::connection('sqlsrv')->getDatabaseName().'.dbo';
        return view('admin.stuffing', [
            "title" => "Stuffing",
            // "ppks" => $ppkModel->where("id_trader", Auth::user()->id_trader)->get(),
            "ppks" => $vdataHeader
                ->leftJoin("$dbView.ppks AS ppks", 'v_data_header.id_ppk', '=', 'ppks.id_ppk')
                ->where('v_data_header.kd_kegiatan', 'E')
                ->whereNotNull('ppks.status')
                ->select('ppks.*', 'v_data_header.*')->get(),
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
        return view('admin.document_stuffing', [
            "title" => "Unggah Dokumen",
            "ppk" => $ppk,
            "kategoris" => $kategoriModel->all(),
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
            ->where('tipe_dokumen', 1)->get();
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

    // Untuk Terima dan Tolak Dokumen
    public function accept($id_ppk)
    {
        // $id_master = $request->input('id_master');
        Ppk::where('id_ppk', $id_ppk)->update([
            "status" => "Penjadwalan",
            "deskripsi" => null
        ]);


        return redirect('/admin/stuffing')->with('success', 'Dokumen telah disetujui!');
    }

    public function decline(Request $request, $id_ppk)
    {
        // $id_master = $request->input('id_master');
        Ppk::where('id_ppk', $id_ppk)->update([
            "status" => "Gagal",
            "deskripsi" => $request->deskripsi
        ]);


        return redirect('/admin/stuffing')->with('error', 'Dokumen tidak disetujui!');
    }

    // Untuk Terima dan Tolak Jadwal
    public function terima(Request $request, $id_ppk)
    {
        // $id_ppk = $request->input('id_ppk');
        Ppk::where('id_ppk', $id_ppk)->update([
            "status" => "Stuffing",
            "deskripsi" => null,
            "url_periksa"=> $request->url_periksa
        ]);

        // Validasi jangan lupa
        // Select dari table subform where id ppk = id ppk
        // if number of row lebih dari 0, empty
        // else select(*) from master, nanti dapet id_masternya terus pake
        // 
        $count = Subform::where('id_ppk', $id_ppk)->count();
        if($count == 0){
            $master = MasterSubform::all();
            DB::beginTransaction();
            foreach($master as $key=>$m){
                Subform::insert([
                    'urutan'=>++$key,
                    'value'=>'',
                    'visibility'=>'show',
                    'id_masterSubform'=>$m->id_masterSubform,
                    'id_ppk'=>$id_ppk,
                ]);
            }
            DB::commit();

        }

        return redirect('/admin/stuffing')->with('success', 'Jadwal telah disetujui!');
    }

    public function tolak(Request $request, $id_ppk)
    {
        // $id_ppk = $request->input('id_ppk');
        Ppk::where('id_ppk', $id_ppk)->update([
            "status" => "Ditolak",
            "deskripsi" => $request->deskripsi,
            "url_periksa"=> null,
        ]);


        return redirect('/admin/stuffing')->with('error', 'Jadwal tidak disetujui!');
    }
}
