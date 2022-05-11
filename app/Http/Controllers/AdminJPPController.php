<?php

namespace App\Http\Controllers;

use App\Models\JenisKurir;
use Illuminate\Http\Request;
use App\Models\Jpp;
use App\Models\JPPNotif;
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
            'nama_counter' => 'required|max:16',
            'alamat_counter' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'penanggungJawab' => 'required|max:16',
            'jenis_kurir' => 'required',
            'password' => 'required'
        ], $messages);

        if($validator==false){
            return redirect('admin/jasper_management');
        }

        try {
            $id = Jpp::insertGetId([
                'kode_counter' => $request->kode_counter,
                'nama_counter' => $request->nama_counter,
                'alamat_counter' => $request->alamat_counter,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'penanggungJawab' => $request->penanggungJawab,
                'id_kurir' => $request->jenis_kurir,
                'is_active' => 1,
                'password' => Hash::make($request->password)
            ]);
            JPPNotif::insert([
                'id_jpp' => $id,
                'last_notif' => date('Y-m-d H:i:s')
            ]);
        } catch (Exception){
            return redirect('admin/jasper_management')->withErrors(['Konter '.$request->nama_counter.' gagal ditambahkan']);
        }
        return redirect('admin/jasper_management')->with('success', 'Konter '.$request->nama_counter.' telah ditambahkan');
        
    }

    public function updateJPP(Request $request) {
        $messages = [
            'required' => ':attribute wajib diisi ',
        ];
        
        $validator = $request->validate([
            'id' => 'required',
            'nama_counter' => 'required|max:16',
            'alamat_counter' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'penanggungJawab' => 'required|max:16',
            'jenis_kurir' => 'required',
        ], $messages);

        if($validator==false){
            return redirect('admin/jasper_management');
        }

        $currentJpp = DB::table('jpp')
            ->select('*')
            ->where('id', $request->id)->first();
        $adaPerubahan = false;
        $suksesMsg = "";
        if ($currentJpp->nama_counter != $request->nama_counter ){
            $suksesMsg .= "- Nama counter = ".$request->nama_counter."\n";
            $adaPerubahan=true;
        }
        if ($currentJpp->alamat_counter != $request->alamat_counter ){
            $suksesMsg .= "- Alamat counter = ".$request->alamat_counter."\n";
            $adaPerubahan=true;
        }
        if ($currentJpp->latitude != $request->latitude){
            $suksesMsg .= "- Latitude = ".$request->latitude."\n";
            $adaPerubahan=true;
        }
        if ($currentJpp->longitude != $request->longitude){
            $suksesMsg .= "- Longitude = ".$request->longitude."\n";
            $adaPerubahan=true;
        }
        if ($currentJpp->penanggungJawab != $request->penanggungJawab){
            $suksesMsg .= "- Penanggung Jawab = ".$request->penanggungJawab."\n";
            $adaPerubahan=true;
        }
        if ($currentJpp->id_kurir != $request->jenis_kurir){
            $newKurir = DB::table('kurir')->select('*')->where('id', $request->jenis_kurir)->first();
            $suksesMsg .= "- Kurir = ".$newKurir->namaKurir."\n";
            $adaPerubahan=true;
        }
        if (isset($request->password)){
            $suksesMsg .= "- Password";
        }
        if ($adaPerubahan){
            $suksesMsg = "Konter ". $currentJpp->nama_counter. " berhasil diubah\n".$suksesMsg;
        }else{
            $suksesMsg = "Konter ". $currentJpp->nama_counter. " tidak ada perubahan\n";
        }
        try {
            if (isset($request->password)){
                DB::table('jpp')
                ->where('id', $request->id)
                ->update([
                    'nama_counter' => $request->nama_counter,
                    'alamat_counter' => $request->alamat_counter,
                    'latitude' => $request->latitude,
                    'longitude' => $request->longitude,
                    'penanggungJawab' => $request->penanggungJawab,
                    'id_kurir' => $request->jenis_kurir,
                    'password' => Hash::make($request->password)
                ]);
            }else{
                DB::table('jpp')
                ->where('id', $request->id)
                ->update([
                    'nama_counter' => $request->nama_counter,
                    'alamat_counter' => $request->alamat_counter,
                    'latitude' => $request->latitude,
                    'longitude' => $request->longitude,
                    'penanggungJawab' => $request->penanggungJawab,
                    'id_kurir' => $request->jenis_kurir,
                ]);
            }
        } catch (Exception){
            return redirect('admin/jasper_management')->withErrors(['Konter '.$request->nama_counter.' gagal diubah']);
        }
        return redirect('admin/jasper_management')->with('success', $suksesMsg);
        
    }

    public function toggleJPP(Request $request){
        DB::table('jpp')
            ->where('id', $request->id)
            ->update([
                'is_active' => $request->status 
            ]);
        return redirect('admin/jasper_management');
    }

    /// 
    /// Pemeriksaan Klinis Virtual - Kurirs
    ///

    public function kurir() {
        $kurirs = DB::table('kurir')
                ->select('*') 
                ->orderBy('id', 'asc')
                ->get();
        return view('admin.PK-kurir_management', [
            "title"=>"PKKurir",
            "kurirs"=>$kurirs
        ]);
    }

    public function addKurir(Request $request) {
        $messages = [
            'required' => ':attribute wajib diisi ',
        ];
        
        $validator = $request->validate([
            'nama_kurir' => 'required'
        ], $messages);

        if($validator==false){
            return redirect('admin/kurir_management');
        }

        try {
            JenisKurir::insert([
                'namaKurir' => $request->nama_kurir,
                'is_active' => 0
            ]);
        } catch (Exception){
            return redirect('admin/kurir_management')->withErrors(['JPP/Kurir '.$request->nama_kurir.' gagal ditambahkan']);
        }
        return redirect('admin/kurir_management')->with('success', 'JPP/Kurir '.$request->nama_kurir.' telah ditambahkan');
    }

    public function updateKurir(Request $request) {
        $messages = [
            'required' => ':attribute wajib diisi ',
        ];
        
        $validator = $request->validate([
            'id' => 'required',
            'nama_kurir' => 'required'
        ], $messages);

        if($validator==false){
            return redirect('admin/kurir_management');
        }

        try {
            DB::table('kurir')
            ->where('id', $request->id)
            ->update([
                'namaKurir' => $request->nama_kurir
            ]);
        } catch (Exception){
            return redirect('admin/kurir_management')->withErrors(['JPP/Kurir gagal diubah']);
        }
        return redirect('admin/kurir_management')->with('success', 'JPP/Kurir berhasil diubah');
    }

    public function toggleKurir(Request $request){
        DB::table('kurir')
            ->where('id', $request->id)
            ->update([
                'is_active' => $request->status 
            ]);
        return redirect('admin/kurir_management');
    }
}
