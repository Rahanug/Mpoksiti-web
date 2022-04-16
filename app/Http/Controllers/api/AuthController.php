<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\tbRTrader;
use App\Models\Trader;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function checknpwp(Request $request)
    {
        $npwp = $request->input('npwp');
        if (isset($npwp)) {
            $checkNPWP = tbRTrader::where('npwp', $npwp)->get(['npwp']);

            if (count($checkNPWP) > 0) {
                return Response([
                    'status' => true,
                    'message' => 'NPWP bisa dipakai',
                ], 200);
            } else {
                return Response([
                    'status' => false,
                    'message' => 'NPWP tidak ada',
                ], 400);
            }
        } else {
            return Response([
                'status' => false,
                'message' => 'Input NPWP',
            ], 400);
        }

        // $checkNPWP = DB::connection('sqlsrv2')->select(
        //     "SELECT COUNT(*) FROM tb_r_trader WHERE npwp = $npwp"
        // );
        // if ($checkNPWP == '1') {
        //     return Response([
        //         'message' => '1',
        //     ], 201);
        // }
        // return [
        //     'message' => $npwp,
        // ];
    }

    public function register(Request $request)
    {
        $fields = $request->validate([
            'npwp' => 'required',
            'no_hp' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        $user = Trader::create([
            'npwp' => $fields['npwp'],
            'no_hp' => $fields['no_hp'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password']),
        ]);

        $token = $user->createToken('mpoksititoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token,
        ];

        return response($response, 201);
    }

    public function login(Request $request)
    {
        $fields = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $user = Trader::where('email', $fields['email'])->first();

        if (!$user || !Hash::check($fields['password'], $user->password)) {
            return response([
                'message' => 'Bad Creds',
            ], 401);
        }

        $token = $user->createToken('mpoksititoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token,
        ];

        return response($response, 201);
    }

    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();

        return [
            'message' => 'Logged out',
        ];
    }
}
