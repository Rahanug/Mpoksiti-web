<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Trader;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AuthController extends Controller
{
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
}
