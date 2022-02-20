<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Jpp;

class LoginJPPController extends Controller
{
    public function __construct(){
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:jpp')->except('logout');
    }

    public function formLogin(){
        return view('jpp.loginjpp');
    }

    public function login(Request $request) { 
        // dd([$request->email, $request->password]);
        if(Auth::guard('jpp')->attempt(['kode_counter'=>$request->kode_counter, "password" => $request->password])) {
            return redirect()->intended(route('jpp.home'));
        }
        return back()->with('error', 'Kode Counter atau Password salah!');
    }

    public function logout() {
        Auth::guard('jpp')->logout();
        return redirect('/loginjpp');
    }
}
