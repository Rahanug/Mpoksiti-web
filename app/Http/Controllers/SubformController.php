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
use App\Models\MasterSubform;


class SubformController extends Controller
{
    public function index(Request $request){
        return view('admin.master_subform',[
            'title'=>'Master Subform',
            'masters'=> MasterSubform::all(),
        ]);
    }

    public function addSubform(Request $request){
        return view('admin.addSubform', [
            'title'=>'Tambah Subform',
        ]);
    }

    public function storeSubform(Request $request){
        $messages = [
            'required' => ':attribute wajib diisi ',
            'min' => ':attribute harus diisi minimal :min karakter !!!',
            'max' => ':attribute harus diisi maksimal :max karakter !!!',
            'numeric' => ':attribute harus diisi angka !!!',
            'email' => ':attribute harus diisi dalam bentuk email !!!',
        ];

        $this->validate($request,[
            "indikator" => 'required',
            'tipe_data' => 'required',
        ],$messages);
                
        MasterSubform::insert([
            "indikator" => $request->indikator,
            'tipe_data' => $request->tipe_data,
        ]);
        return redirect('/admin/subform')->with('success', 'Subform telah ditambahkan');
    }

    public function editSubform(Request $request, $id_masterSubform){
        $edit = MasterSubform::where('id_masterSubform', $id_masterSubform)->get();
        return view('admin.editSubform', [
            'title'=>'Tambah Master Subform',
            "id"=> $id_masterSubform,
            "edit"=> $edit,
        ]);
    }

    public function updateSubform(Request $request, $id_masterSubform){
        $messages = [
            'required' => ':attribute wajib diisi ',
            'min' => ':attribute harus diisi minimal :min karakter !!!',
            'max' => ':attribute harus diisi maksimal :max karakter !!!',
            'numeric' => ':attribute harus diisi angka !!!',
            'email' => ':attribute harus diisi dalam bentuk email !!!',
        ];

        $this->validate($request,[
            "indikator" => 'required',
            'tipe_data' => 'required',
        ],$messages);
                
        MasterSubform::where('id_masterSubform', $id_masterSubform)->update([
            "indikator" => $request->indikator,
            'tipe_data' => $request->tipe_data,
        ]);
        return redirect('/admin/subform')->with('info', 'Subform telah diupdate');
    }
}
