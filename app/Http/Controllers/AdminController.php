<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ManagementUserController;
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

    public function traderByNpwp(Request $request)
    {
        $manages = new ManagementUserController();
        return view('admin.manage', [
            "title" => "Management",
            "traders" => $manages->getTraderByNpwp($request->npwp),
        ]);
    }
}
