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
use App\Models\vDataHeader;

class KategoriController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.kategori_dokumen',[
            "title"=>"Kategori Dokumen",
            "kategoris"=>KategoriDokumen::all(),
        ]);
    }
    public function addKategori(Request $request)
    {
        return view('admin.addKategori',[
            "title"=>"Tambah Kategori",
            "kategoris"=>KategoriDokumen::all(),
        ]);
    }
    public function storeKategori(Request $request)
    {
        $messages = [
            'required' => ':attribute wajib diisi ',
            'min' => ':attribute harus diisi minimal :min karakter !!!',
            'max' => ':attribute harus diisi maksimal :max karakter !!!',
            'numeric' => ':attribute harus diisi angka !!!',
            'email' => ':attribute harus diisi dalam bentuk email !!!',
        ];

        $this->validate($request,[
            "nama_kategori" => 'required',
            'status' => 'required',
            "instansi_penerbit" => 'required',
        ],$messages);
                
        KategoriDokumen::insert([
            "nama_kategori" => $request->nama_kategori,
            'status' => $request->status,
            "instansi_penerbit" => $request->instansi_penerbit,
        ]);
        return redirect('/admin/kategori');
    }
    
}
