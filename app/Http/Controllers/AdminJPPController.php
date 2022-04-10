<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jpp;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class AdminJPPController extends Controller
{
    /// 
    /// Pemeriksaan Klinis Virtual - Jasper
    ///

    public function index() {
        $jpps = DB::table('jpp')
                ->leftJoin('kurir', 'kurir.id', '=', 'jpp.id_kurir')
                ->select('jpp.*', 'kurir.namaKurir') 
                ->get();
        $kurirs = DB::table('kurir')
                ->select('*') 
                ->get();
        return view('admin.PK-jasper_management', [
            "title"=>"PKJasper",
            "jpps"=>$jpps,
            "kurirs"=>$kurirs
        ]);
    }

    public function addJPP(Request $request) {
        $messages = [
            'required' => ':attribute wajib diisi ',
        ];
        
        $validator = $request->validate([
            'kode_counter' => 'required',
            'nama_counter' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'penanggungJawab' => 'required',
            'jenis_kurir' => 'required',
            'password' => 'required'
        ], $messages);

        if($validator==false){
            return redirect('admin/jasper_management');
        }

        try {
            Jpp::insert([
                'kode_counter' => $request->kode_counter,
                'nama_counter' => $request->nama_counter,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'penanggungJawab' => $request->penanggungJawab,
                'id_kurir' => $request->jenis_kurir,
                'password' => Hash::make($request->password)
            ]);
        } catch (Exception){
            return redirect('admin/jasper_management')->withErrors(['Konter '.$request->nama_counter.' gagal ditambahkan']);
        }
        return redirect('admin/jasper_management')->with('success', 'Konter '.$request->nama_counter.' telah ditambahkan');
        
    }
}
