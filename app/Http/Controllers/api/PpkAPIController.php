<?php

namespace App\Http\Controllers\api;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Ppk;
use Illuminate\Support\Facades\DB;

class PpkAPIController extends Controller
{

    public function index(Request $request)
    {
        //TODO ini hanya untuk sementara selama fitur auth trader dari app mobile
        $id_trader = $request->id_trader;
        $ppks = Ppk::select('id_ppk','no_aju_ppk', 'status')->where('id_trader', $id_trader)->get();
        foreach ($ppks as $ppk){
            $ikans = DB::select("
                SELECT kd_ikan, nm_lokal, nm_umum, nm_latin, satuan, jumlah 
                FROM v_dtl_pelaporan WHERE id_ppk=".$ppk['id_ppk']
            );
            $ppk['ikan'] = $ikans;
        }
        return response()->json($ppks);
    }

    public function store(Request $request)
    {
        //
        $validator = $request->validate([
            'kode_counter' => 'required|string|max:255',
            'status' => 'required',
            'no_aju_ppk' => 'required'
        ]);

        if($validator==false){
            return response()->json('Gagal');       
        }

        DB::table('ppks')
            ->where('no_aju_ppk', $request->no_aju_ppk)
            ->update(['status' => $request->status, 'kode_counter_jpp' => $request->kode_counter]);

        return response()->json('Berhasil');
    }
}
