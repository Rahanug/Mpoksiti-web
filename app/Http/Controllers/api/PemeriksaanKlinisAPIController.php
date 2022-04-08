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
        $dbMpok = DB::connection('sqlsrv')->getDatabaseName().'.dbo';
        $vDataHeaders = DB::connection('sqlsrv2')
            ->table('v_data_header')
            ->leftJoinSub("SELECT * FROM $dbMpok.pemeriksaan_klinis", 'pk', function ($join) {
                $join->on('v_data_header.id_ppk', '=', 'pk.id_ppk');
            })
            ->leftJoinSub("SELECT * FROM $dbMpok.jpp", 'jpp', function ($join) {
                $join->on('pk.id_jpp', '=', 'jpp.id');
            })
            ->select('v_data_header.id_ppk', 'v_data_header.no_aju_ppk', 'pk.status', 'jpp.nama_counter')
            ->where('id_trader', $request->id_trader)
            ->where('kd_kegiatan', 'K')
            ->get();
        foreach ($vDataHeaders as $data){
            $data->ikan = DB::connection('sqlsrv2')->select("
                SELECT kd_ikan, nm_lokal, nm_umum, nm_latin, satuan, jumlah 
                FROM v_dtl_pelaporan WHERE id_ppk=".(int)$data->id_ppk
            );
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
