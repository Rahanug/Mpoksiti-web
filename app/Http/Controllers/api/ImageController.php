<?php

namespace App\Http\Controllers\api;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Image;

class ImageController extends Controller
{

    /// store files to server
    ///
    /// store image to storage/app/pemeriksaan_klinis

    public function store(Request $request)
    {
        
        $image = new Image;        
        $image->no_aju_ppk = $request->no_aju_ppk;
        $image->id_trader = (int)($request->id_trader);
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('pemeriksaan_klinis');            
            $image->url_file = $path;
        }
        $image->save();        
        return response()->json([
            "success" => true,
            "message" => "File successfully uploaded",
            "file" => $image
        ]);
    }
}
