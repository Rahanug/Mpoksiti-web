<?php

namespace App\Http\Controllers\api;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\PemeriksaanKlinis;
use App\Models\vDataHeader;
use App\Models\Jpp;
use Illuminate\Support\Facades\DB;

class PemeriksaanKlinisAPIController extends Controller
{

    public function index(Request $request)
    {
        //TODO ini hanya untuk sementara selama fitur auth trader dari app mobile
        $id_trader = $request->id_trader;
        $vDataHeaders = vDataHeader::leftJoin('pemeriksaan_klinis', 'v_data_header.id_ppk', '=', 'pemeriksaan_klinis.id_ppk')
                ->select('v_data_header.id_ppk', 'v_data_header.no_aju_ppk', 'pemeriksaan_klinis.id_jpp as nama_counter', 'pemeriksaan_klinis.status')
                ->where('id_trader', $request->id_trader)
                ->get();
        foreach ($vDataHeaders as $data){
            $ikans = DB::select("
                SELECT kd_ikan, nm_lokal, nm_umum, nm_latin, satuan, jumlah 
                FROM v_dtl_pelaporan WHERE id_ppk=".$data['id_ppk']
            );
            $data['ikan'] = $ikans;
            if ($data['nama_counter']!=null){
                $jpp = DB::table('jpp')->where('id', (int)$data['nama_counter'])->first();
                $data['nama_counter'] = $jpp->nama_counter;
            }
        }
        return response()->json($vDataHeaders);
    }

    public function store(Request $request)
    {
        //
        $validator = $request->validate([
            'id_jpp' => 'required',
            'status' => 'required',
            'id_ppk' => 'required'
        ]);

        if($validator==false){
            return response()->json('Gagal');       
        }

        PemeriksaanKlinis::updateOrCreate([
            'id_ppk' => (int)($request->id_ppk)],
            [
            'status' => $request->status,
            'id_jpp' => (int)($request->id_jpp)]
        );

        return response()->json('Berhasil');
    }
}
