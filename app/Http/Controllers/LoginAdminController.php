<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginAdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logoutadmin');
        $this->middleware('guest:admin')->except('logoutadmin');
    }

    public function formLogin()
    {
        return view('loginadmin');
    }

    public function loginAdmin(Request $request)
    {
        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->intended(route('admin.home'));
        }
        return back()->with('error', 'Email atau Password Salah!');
    }

    public function logoutadmin()
    {
        Auth::guard('admin')->logout();
        return redirect('/loginadmin');
    }
}
