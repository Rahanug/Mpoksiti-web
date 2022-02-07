<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ManagementUserController;
use App\Models\Menu;
use App\Models\Trader;
use Illuminate\Http\Request;

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
}
