<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\PemeriksaanKlinis;
use Illuminate\Support\Facades\DB;

class NotifAPIController extends Controller
{

    public function check()
    {
        $data = DB::select(
            "SELECT updated_at
            FROM notif WHERE id = 1"
        );

        return response()->json($data[0]);
    }

    public function checkJPP(Request $request)
    {
        $data = DB::select(
            "SELECT last_notif
            FROM jpp_notif WHERE id_jpp =" . $request->id
        );

        return response()->json($data[0]);
    }
}
