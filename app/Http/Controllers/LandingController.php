<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
// use App\Models\User;

class LandingController extends Controller
{
    public function index()
    {
        return view('landing', [
            "title" => "Add Admin",
            // "kategori" => KategoriDokumen::all(),
        ]);
    }
}