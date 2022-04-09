<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Trader;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class JPPController extends Controller
{
    public function index(Request $request) {
        return view('jpp.home', [
            "title" => "dashboard",
        ]);
    }

    public function pemeriksaan() {
        $dbView = DB::connection('sqlsrv2')->getDatabaseName().'.dbo';
        $list_ppk = DB::table("pemeriksaan_klinis")
            ->joinSub("SELECT v_data_header.*, v_for_qr.seri, v_for_qr.no_sertifikat, v_for_qr.tgl_sertifikat 
                FROM $dbView.v_data_header 
                LEFT JOIN $dbView.v_for_qr ON v_data_header.id_ppk = v_for_qr.id_ppk",
                'data_view', function ($join) {
                $join->on('pemeriksaan_klinis.id_ppk', '=', 'data_view.id_ppk');
            })
            ->join('traders', 'data_view.id_trader', '=', 'traders.id_trader')
            ->select('*') //TODO dont select everything
            ->where("id_jpp", Auth::user()->id)
            ->get();
        foreach($list_ppk as $data){
            $data_segel = DB::connection('sqlsrv2')
                ->table('v_for_qr')
                ->rightJoin('tr_mst_pelaporan', 'v_for_qr.id_ppk', '=', 'tr_mst_pelaporan.id_ppk')
                ->select('v_for_qr.nm_kegiatan',  'v_for_qr.no_sertifikat', 'v_for_qr.tgl_sertifikat', 'v_for_qr.seri', 
                'v_for_qr.kd_pel_muat', 'v_for_qr.kd_pel_bongkar', 'tr_mst_pelaporan.code_qr')
                ->where('v_for_qr.id_ppk', $data->id_ppk)
                ->get();
            $data->data_segel = response()->json($data_segel);
        }
            
        return view('jpp.pemeriksaan', [
            "title" => "pemeriksaan",
            "list_ppk" => $list_ppk
        ]);
    }

    public function permohonan(Request $request){
        DB::table('pemeriksaan_klinis')
              ->where('id_ppk', $request->id_ppk)
              ->update(['status_periksa' => 1]);
        return redirect('/jpp/pemeriksaan');
    }
    
}
