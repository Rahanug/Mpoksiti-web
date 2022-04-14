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
        $image->id_ppk = (int)$request->id_ppk;
        $image->no_aju_ppk = $request->no_aju_ppk;
        $image->id_trader = (int)($request->id_trader);
        $image->latitude = $request->latitude;
        $image->longitude = $request->longitude;
        $image->kd_ikan = $request->kd_ikan;
        if ($request->hasFile('image')) {
            $file_gambar = $request->file('image');
            $tujuan_upload = 'img/pemeriksaan_klinis';
            if ($request->is_video == '1'){
                $nama_file = 'video-'.$file_gambar->getClientOriginalName();
                if ($request->hasFile('thumb')) {
                    $file_thumb = $request->file('thumb');
                    $nama_thumb = "thumb-".$nama_file;
                    $file_thumb->move($tujuan_upload, $nama_thumb);
                }
            }else{
                $nama_file = 'image-'.$file_gambar->getClientOriginalName();
            }
            $file_gambar->move($tujuan_upload, $nama_file);
            $image->url_file = $nama_file;
        }
        $image->save();        
        return response()->json([
            "success" => true,
            "message" => "File successfully uploaded",
            "file" => $image
        ]);
    }
}
