<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Trader;

class LoginController extends Controller
{
    public function __construct(){
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:trader')->except('logout');
    }

    public function formLogin(){
        return view('login');
    }

    public function login(Request $request) { 
        // dd([$request->email, $request->password]);
        if(Auth::guard('trader')->attempt(['email'=>$request->email, "password" => $request->password])) {
            return redirect()->intended(route('trader.home'));
        }
        return back()->with('error', 'Email atau Password salah!');
    }

    public function logout() {
        Auth::guard('trader')->logout();
        return redirect('/login');
    }
}
