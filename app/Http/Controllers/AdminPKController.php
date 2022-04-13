<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Trader;
use App\Models\PemeriksaanKlinis;
use DateTime;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\ServiceProvider;


class AdminPKController extends Controller
{
    /// 
    /// Pemeriksaan Klinis Virtual
    ///

    public function index() {
        $dbView = DB::connection('sqlsrv2')->getDatabaseName().'.dbo';
        $pks = DB::table('pemeriksaan_klinis')
                ->joinSub("SELECT * FROM $dbView.v_data_header", 'data_view', function ($join) {
                    $join->on('pemeriksaan_klinis.id_ppk', '=', 'data_view.id_ppk');
                })
                ->join('jpp', 'jpp.id', '=', 'pemeriksaan_klinis.id_jpp')
                ->join('kurir', 'kurir.id', '=', 'jpp.id_kurir')
                ->join('traders', 'data_view.id_trader', '=', 'traders.id_trader')
                ->select('jpp.*', 'pemeriksaan_klinis.*', 'data_view.*', 'traders.*', 'kurir.namaKurir') //TODO dont select everything
                ->whereNotNull('pemeriksaan_klinis.status_periksa')
                ->get();
        foreach ($pks as $data){
            $data->ikan = DB::connection('sqlsrv2')->select("
                SELECT kd_ikan, nm_lokal, nm_umum, nm_latin, satuan, jumlah 
                FROM v_dtl_pelaporan WHERE id_ppk=".(int)$data->id_ppk
            );
            foreach ($data->ikan as $ikan){
                $ikan->images = DB::table('images')
                    ->select('*')
                    ->where('kd_ikan', $ikan->kd_ikan)
                    ->get();
            }
        }
        return view('admin.PK-pemeriksaan_klinis', [
            "title"=>"PKVirtual",
            "pks"=>$pks
        ]);
    }
    
    public function sendLinkPemeriksaanKlinis(Request $request) {
        $messages = [
            'required' => ':attribute wajib diisi ',
        ];
        
        $validator = $request->validate([
            'id_ppk' => 'required',
            'linkMeet' => 'required',
            'jadwalMeet' => 'required',
            'jamMeet' => 'required',
        ], $messages);

        if ((date('H:i')>$request->jamMeet) && (date('Y-m-d')==$request->jadwalMeet)){
            return redirect('admin/pemeriksaan_klinis')->withErrors(['msg' => 'jam pemeriksaan tidak tepat']);
        }

        if($validator==false){
            return redirect('admin/pemeriksaan_klinis')->withErrors(['msg' => 'jadwal Pemeriksaan Klinis Virtual tidak tepat']);
        }

        DB::table('pemeriksaan_klinis')
            ->where('id_ppk', $request->id_ppk)
            ->update([
                'status_periksa' => 2,
                'jadwal_periksa' => date('Y-m-d H:i', strtotime($request->jadwalMeet.' '.$request->jamMeet)),
                'url_periksa' => $request->linkMeet
            ]);
            
        return redirect('admin/pemeriksaan_klinis')->with('success', 'Jadwal meet telah dikirim untuk ID PPK '.$request->id_ppk);;
    }

    public function sendAction(Request $request){
        $messages = [
            'required' => ':attribute wajib diisi ',
            'max' => ':attribute harus diisi maksimal :max karakter !!!',
        ];
        
        $validator = $request->validate([
            'id_ppk' => 'required',
            'action' => 'required',
            'keterangan' => 'required|max:200',
        ], $messages);

        if($validator==false){
            return redirect('admin/pemeriksaan_klinis')->withErrors(['msg' => 'keterangan singkat wajib diisi']);
        }

        $statusPPK = null;
        $text = '';
        if ($request->action=='Tolak'){
            $statusPPK = 2;
            $text = 'ditolak';
        }else if ($request->action=='Setuju'){
            $statusPPK = 3;
            $text = 'disetujui';
        }
        DB::table('pemeriksaan_klinis')
            ->where('id_ppk', $request->id_ppk)
            ->update([
                'status' => $statusPPK,
                'keterangan' => $request->keterangan
            ]);
        return redirect('admin/pemeriksaan_klinis')->with('success', 'ID PPK '.$request->id_ppk.' telah '.$text);
    }
}
