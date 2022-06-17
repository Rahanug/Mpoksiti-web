<?php

namespace App\Http\Controllers\CPIB;

use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function loginCPIB()
    {
        return view('cpib.loginuser', [
            "title" => "Login CPIB",
        ]);
    }

    public function regisCPIB()
    {
        return view('cpib.regisuser', [
            "title" => "Register CPIB",
        ]);
    }
}
