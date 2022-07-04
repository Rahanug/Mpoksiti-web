<?php

namespace App\Http\Controllers\CPIB;

use App\Http\Controllers\Controller;
use App\Models\Penanganan;
use App\Models\Pengolahan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest')->except('logoutPenanganan');
        $this->middleware('guest:penanganan')->except('logoutPenanganan');
        $this->middleware('guest:pengolahan')->except('logoutPengolahan');
    }

    public function index_penanganan()
    {
        return view('cpib.loginpenanganan', [
            "title" => "Login Penanganan",
        ]);
    }

    public function index_pengolahan()
    {
        return view('cpib.loginpengolahan', [
            "title" => "Login Pengolahan",
        ]);
    }

    public function regisCPIB()
    {
        return view('cpib.regisuser', [
            "title" => "Register CPIB",
        ]);
    }

    //Penanganan
    public function loginPenanganan(Request $request)
    {
        // dd([$request->email, $request->password]);
        if (Auth::guard('penanganan')->attempt(['email' => $request->email, "password" => $request->password])) {
            return redirect()->intended(route('penanganan.dashboard'));
        }
        return back()->with('error', 'Email atau Password salah!');
    }

    public function regisPenanganan(Request $request)
    {
        $messages = [
            'required' => ':attribute wajib diisi',
        ];

        $this->validate($request, [
            'nm_user' => 'required',
            'npwp' => 'required',
            'no_hp' => 'required',
            'email' => 'required',
            'password' => 'required',
        ], $messages);

        $userPenanganan = Penanganan::insert([
            'nm_user' => $request->nm_user,
            'npwp' => $request->npwp,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        if ($userPenanganan) {
            return response()->json([
                'success' => true,
                'message' => 'Register Berhasil!',
            ], 201);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Register Gagal!',
            ], 400);
        }
    }

    public function logoutPenanganan()
    {
        Auth::guard('penanganan')->logout();
        return redirect()->route('penanganan.logincpib');
    }

    //Pengolahan
    public function loginPengolahan(Request $request)
    {
        // dd([$request->email, $request->password]);
        if (Auth::guard('pengolahan')->attempt(['email' => $request->email, "password" => $request->password])) {
            return redirect()->intended(route('pengolahan.dashboard'));
        }
        return back()->with('error', 'Email atau Password salah!');
    }

    public function regisPengolahan(Request $request)
    {
        $messages = [
            'required' => ':attribute wajib diisi',
        ];

        $this->validate($request, [
            'nm_user' => 'required',
            'npwp' => 'required',
            'no_hp' => 'required',
            'email' => 'required',
            'password' => 'required',
        ], $messages);

        $userPengolahan = Pengolahan::insert([
            'nm_user' => $request->nm_user,
            'npwp' => $request->npwp,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        if ($userPengolahan) {
            return response()->json([
                'success' => true,
                'message' => 'Register Berhasil!',
            ], 201);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Register Gagal!',
            ], 400);
        }
    }

    public function logoutPengolahan()
    {
        Auth::guard('pengolahan')->logout();
        return redirect()->route('pengolahan.logincpib');
    }

}
