<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\PemeriksaanKlinis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PemeriksaanKlinisAPIController extends Controller
{

    public function index(Request $request)
    {
        //TODO ini hanya untuk sementara selama fitur auth trader dari app mobile
        $dbMpok = DB::connection('mysql')->getDatabaseName() . '.dbo';
        $vDataHeaders = DB::connection('mysql2')
            ->table('v_data_header')
            ->leftJoinSub("SELECT * FROM $dbMpok.pemeriksaan_klinis", 'pk', function ($join) {
                $join->on('v_data_header.id_ppk', '=', 'pk.id_ppk');
            })
            ->leftJoinSub("SELECT * FROM $dbMpok.jpp", 'jpp', function ($join) {
                $join->on('pk.id_jpp', '=', 'jpp.id');
            })
            ->select('v_data_header.id_ppk', 'v_data_header.no_aju_ppk', 'v_data_header.nm_penerima', 'pk.status', 'jpp.nama_counter')
            ->where('id_trader', $request->id_trader)
            ->where('kd_kegiatan', 'K')
            ->orderBy('pk.status', 'asc')
            ->get();
        foreach ($vDataHeaders as $data) {
            $data->ikan = DB::connection('mysql2')->select("
                SELECT kd_ikan, nm_lokal, nm_umum, nm_latin, satuan, jumlah
                FROM v_dtl_pelaporan WHERE id_ppk=" . (int) $data->id_ppk
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
            'id_ppk' => 'required',
        ]);

        if ($validator == false) {
            return response()->json('Gagal');
        }

        PemeriksaanKlinis::updateOrCreate([
            'id_ppk' => (int) ($request->id_ppk)],
            [
                'status' => $request->status,
                'id_jpp' => (int) ($request->id_jpp)]
        );

        //notify
        DB::table('jpp_notif')
            ->where('id_jpp', $request->id_jpp)
            ->update(['last_notif' => date('Y-m-d H:i:s')]);
        return response()->json('Berhasil');
    }
}
