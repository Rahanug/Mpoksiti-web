<?php

namespace App\Http\Controllers\api;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\PemeriksaanKlinis;
use Illuminate\Support\Facades\DB;

class NotifAPIController extends Controller
{

    public function check(Request $request)
    {
        $data = DB::select("
                SELECT *
                FROM notif WHERE updated_at < '2022-04-15 14:53:40.043' AND id = ". $request->id
            );
        return response()->json(count($data));
    }

    public function store(Request $request)
    {
        //
    }
}
