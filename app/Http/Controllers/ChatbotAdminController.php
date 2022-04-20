<?php

namespace App\Http\Controllers;

use App\Models\chatbotAdminModel;
use Illuminate\Http\Request;

class ChatbotAdminController extends Controller
{
    public function index()
    {
        $chatbot_admin = array();
        return view('admin.tabelDaftarAdmin', [
            "title" => "Chatbot Admin",
            "chatbot_admin" => chatbotAdminModel::all(),
        ]);
    }

    public function master(Request $request)
    {
        return view('admin.addAdmin', [
            "title" => "Add Admin",
            // "kategori" => KategoriDokumen::all(),
        ]);
    }

    public function masterEdit($id)
    {
        $edit = chatbotAdminModel::where('id', $id)->get();
        return view('admin.updateAdmin', [
            "title" => "Update Admin",
            "edit" => $edit,
            "id" => $id
            // "kategori" => KategoriDokumen::all(),
        ]);
    }

    public function deleteAdmin($id)
    {
        chatbotAdminModel::where('id', $id)->delete();
        return redirect('/admin/admin-chatbot');
    }

    public function storeAdmin(Request $request)
    {
        $messages = [
            'required' => ':attribute wajib diisi ',
            'min' => ':attribute harus diisi minimal :min karakter !!!',
            'max' => ':attribute harus diisi maksimal :max karakter !!!',
            'numeric' => ':attribute harus diisi angka !!!',
            'email' => ':attribute harus diisi dalam bentuk email !!!',
        ];

        $this->validate($request, [
            'no_wa' => 'required',
            "username" => 'required',
        ], $messages);

        // $nm_dokumen = $request->file('nm_dokumen');
        // $name = $nm_dokumen->getClientOriginalName();
        // $path = 'files';
        // $nm_dokumen->move($path, $name);

        chatbotAdminModel::insert([
            'no_wa' => $request->no_wa,
            'username' => $request->username
            // 'no_dokumen' => $request->no_dokumen,
            // 'nm_dokumen' => $name,
            // "tgl_terbit" => $request->tgl_terbit,
            // "tgl_expired" => Carbon::createFromFormat('Y-m-d', $request->tgl_terbit)->addMonth(),
            // "status" => "non-Aktif",
            // "tipe_dokumen" => 1,
            // "id_kategori" => $request->id_kategori,
            // "id_trader" => Auth::user()->id_trader,
        ]);

        // $master = new MasterDokumen();
        // $master->no_dokumen = $request->no_dokumen;
        // $master->tgl_terbit = $request->tgl_terbit;
        // $master->id_kategori = $request->nm_dokumen;
        // $master->id_trader = Auth::user()->id_trader;

        return redirect('/admin/admin-chatbot');
    }

    public function updateAdmin(Request $request, $id)
    {
        $messages = [
            'required' => ':attribute wajib diisi ',
            'min' => ':attribute harus diisi minimal :min karakter !!!',
            'max' => ':attribute harus diisi maksimal :max karakter !!!',
            'numeric' => ':attribute harus diisi angka !!!',
        ];

        $this->validate($request, [
            'no_wa' => 'required',
            "username" => 'required',
        ], $messages);

        chatbotAdminModel::where('id', $id)->update([
            'no_wa' => $request->no_wa,
            'username' => $request->username
        ]);

        return redirect('/admin/admin-chatbot');
    }
}