<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ManagementUserController;
use App\Models\Menu;
use App\Models\Publikasi;
use App\Models\tbRTrader;
use App\Models\Trader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{

    //Method Untuk Pemanggilan Halaman Management User
    public function manage()
    {
        $manages = new ManagementUserController();
        return view('admin.manage', [
            "title" => "Management",
            "traders" => $manages->all(),
        ]);
    }

    public function checkNpwp(Request $request)
    {
        $npwp = $request->get('npwp');
        if (isset($npwp)) {
            $result = $this->getIDandNameTrader($npwp);

            if (isset($result)) {
                echo 'unique';
            } else {
                echo 'not_unique';
            }
        }
    }

    private function getIDandNameTrader($npwp)
    {
        $checkNPWP = tbRTrader::where('npwp', $npwp)->get(['id_trader', 'nm_trader'])->first();
        return $checkNPWP ?? null;
    }

    public function searchUser(Request $request)
    {
        $manages = Trader::all();
        if ($request->keyword != '') {
            $manages = Trader::where('npwp', 'LIKE', '%' . $request->keyword . '%')->orWhere('nm_trader', 'LIKE', '%' . $request->keyword . '%')->get();
        }
        return response()->json([
            'traders' => $manages,
        ]);
    }

    public function tambahUser()
    {
        return view('admin.addUser', [
            "title" => "Tambah User",
        ]);
    }

    public function storeUser(Request $request)
    {
        $messages = [
            'required' => ':attribute wajib diisi',
        ];

        $this->validate($request, [
            'npwp' => 'required',
            'no_hp' => 'required',
            'email' => 'required',
            'password' => 'required',
        ], $messages);

        $npwp = $request->input('npwp');
        $result = $this->getIDandNameTrader($npwp);
        if (!isset($result)) {
            return redirect('/admin/manage')->with('error', 'NPWP Tidak Ada');
        } else {
            Trader::insert([
                'id_trader' => $result['id_trader'],
                'nm_trader' => $result['nm_trader'],
                'npwp' => $request->npwp,
                'no_hp' => $request->no_hp,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            return redirect('/admin/manage')->with('success', 'New user has been added');
        }
    }

    public function editUser($id_trader)
    {
        $edit = Trader::where('id_trader', $id_trader)->get();
        return view('admin.editUser', [
            "title" => "Edit User",
            "edit" => $edit,
            "id_trader" => $id_trader,
        ]);
    }

    public function updateUser(Request $request, $id_trader)
    {
        $messages = [
            'required' => ':attribute wajib diisi',
        ];

        $this->validate($request, [
            'no_hp' => 'required',
            'email' => 'required',
        ], $messages);

        if (isset($request->password)) {
            Trader::where('id_trader', $id_trader)->update([
                'nm_trader' => $request->nm_trader,
                'npwp' => $request->npwp,
                'no_hp' => $request->no_hp,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            return redirect('/admin/manage')->with('success', 'User has been Edited');
        } else {
            Trader::where('id_trader', $id_trader)->update([
                'nm_trader' => $request->nm_trader,
                'npwp' => $request->npwp,
                'no_hp' => $request->no_hp,
                'email' => $request->email,
            ]);

            return redirect('/admin/manage')->with('success', 'User has been Edited');
        }

    }

    public function deleteUser($id_trader)
    {
        Trader::where('id_trader', $id_trader)->delete();
        return redirect('/admin/manage')->with('error', 'User has been removed');
    }

    //Method Untuk Pemanggilan Halaman Menu
    public function allMenu()
    {
        return view('admin.menu', [
            "title" => "Menu",
            "menus" => Menu::all(),
        ]);
    }

    public function editMenu($id_menu)
    {
        $edit_menu = Menu::where('id_menu', $id_menu)->get();
        return view('admin.editMenu', [
            "title" => "Edit Menu",
            "editMenu" => $edit_menu,
        ]);
    }

    public function updateMenu(Request $request)
    {
        $messages = [
            'required' => ':attribute wajib diisi',
        ];

        $this->validate($request, [
            'nm_menu' => 'required',
            'url' => 'required',
        ], $messages);

        Menu::where('id_menu', $request->id_menu)->update([
            'nm_menu' => $request->nm_menu,
            'url' => $request->url,
        ]);
        return redirect('/admin/menu')->with('info', 'Menu has been changed');
    }

    //Method Untuk Pemanggilan Halaman Publikasi
    public function allGambar()
    {
        return view('admin.publikasi', [
            "title" => "Publikasi",
            "allGambar" => Publikasi::all(),
        ]);
    }

    public function tambahGambar()
    {
        return view('admin.addGambar', [
            "title" => "Tambah Gambar",
        ]);
    }

    public function storeGambar(Request $request)
    {
        $file_gambar = $request->file('file_gambar');

        $nama_file = $file_gambar->getClientOriginalName();

        $tujuan_upload = 'img';
        $file_gambar->move($tujuan_upload, $nama_file);

        Publikasi::create([
            'nm_gambar' => $request->nm_gambar,
            'deskripsi' => $request->deskripsi,
            'file_gambar' => $nama_file,
        ]);

        return redirect('/admin/publikasi')->with('success', 'New Picture has been added');
    }

    public function searchGambar(Request $request)
    {
        $gambar = Publikasi::all();
        if ($request->keyword != '') {
            $gambar = Publikasi::where('nm_gambar', 'LIKE', '%' . $request->keyword . '%')->get();
        }
        return response()->json([
            'publikasi' => $gambar,
        ]);
    }

    public function deleteGambar($id_gambar)
    {
        Publikasi::where('id_gambar', $id_gambar)->delete();
        return redirect('/admin/publikasi')->with('error', 'Picture has been removed');
    }

}
