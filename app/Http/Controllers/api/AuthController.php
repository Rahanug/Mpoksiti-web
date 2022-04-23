<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\tbRTrader;
use App\Models\Trader;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;



class AuthController extends Controller
{
    public function checknpwp(Request $request)
    {
        $npwp = $request->input('npwp');
        if (isset($npwp)) {
            $id_trader = $this->getIdTraderFromNpwp($npwp);

            if (isset($id_trader)) {
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

    private function getIdTraderFromNpwp($npwp){
        $checkNPWP = tbRTrader::where('npwp', $npwp)->get(['npwp','id_trader'])->first();
        return $checkNPWP['id_trader'] ?? null;
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
        $id_trader = $this->getIdTraderFromNpwp($npwp);
        if(!isset($id_trader)){
            return Response([
                'status' => false,
                'message' => 'NPWP tidak ada',
            ], 401);
        }else{
            $user = Trader::create([
                'id_trader'=>$id_trader,
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
        $user = Trader::select('npwp', 'id_trader')->where('email', $fields['email'])->first();

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
        $user = Trader::select('id_trader', 'npwp')->where('npwp', auth()->user()->npwp)->first();
        return response()->json($user);
    }
}