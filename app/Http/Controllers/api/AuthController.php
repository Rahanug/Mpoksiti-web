<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\tbRTrader;
use App\Models\Trader;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function checknpwp(Request $request)
    {
        $npwp = $request->input('npwp');
        if (isset($npwp)) {
            $result = $this->getIDandNameTrader($npwp);

            if (isset($result)) {
                return Response([
                    'status' => true,
                    'message' => 'NPWP bisa dipakai',
                ], 200);
            } else {
                return Response([
                    'status' => false,
                    'message' => 'NPWP tidak ada',
                ], 401);
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

    private function getIDandNameTrader($npwp)
    {
        $checkNPWP = tbRTrader::where('npwp', $npwp)->get(['id_trader', 'nm_trader'])->first();
        return $checkNPWP ?? null;
    }

    public function register(Request $request)
    {
        $fields = $request->validate([
            'npwp' => 'required',
            'no_hp' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        $npwp = $request->input('npwp');
        $result = $this->getIDandNameTrader($npwp);
        if (!isset($result)) {
            return Response([
                'status' => false,
                'message' => 'NPWP tidak ada',
            ], 401);
        } else {
            $user = Trader::create([
                'id_trader' => $result['id_trader'],
                'nm_trader' => $result['nm_trader'],
                'npwp' => $fields['npwp'],
                'no_hp' => $fields['no_hp'],
                'email' => $fields['email'],
                'password' => bcrypt($fields['password']),
            ]);

            $response = [
                'user' => $user,
                'message' => 'Registered',
            ];

            return response($response, 200);
        }

    }

    public function login(Request $request)
    {
        $fields = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $user_check = Trader::where('email', $fields['email'])->first();
        $user = Trader::select('id_trader')->where('email', $fields['email'])->first();

        if (!$user_check || !Hash::check($fields['password'], $user_check->password)) {
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
        //auth()->user()->tokens()->delete();
        $request->user()->currentAccessToken()->delete();

        return [
            'message' => 'Logged out',
        ];
    }

    public function getFarmLocation(Request $request)
    {
        //farm location from token
        $id = auth()->user()->id_trader;
        $trader = DB::connection('sqlsrv2')
            ->table('tb_r_trader')
            ->select('latitude', 'longitude')
            ->where('id_trader', $id)
            ->first();

        return response()->json($trader);
    }

    public function getUserData(Request $request)
    {
        //user from token
        $user = DB::connection('sqlsrv2')
            ->table('tb_r_trader')
            ->select('id_trader')
            ->where('id_trader', auth()->user()->id_trader)
            ->first();
        return response()->json($user);
    }

    public function getMenuUrl($id_menu)
    {
        $getMenu = Menu::where('id_menu', $id_menu)->get(['url'])->first();
        return $getMenu ?? null;
    }
}
