<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\PemeriksaanKlinisAPIController;
use App\Http\Controllers\api\JenisKurirController;
use App\Http\Controllers\api\JPPController;
use App\Http\Controllers\api\ImageController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('/jpp', 'App\Http\Controllers\api\JPPController');
Route::apiResource('/pemeriksaan_klinis', 'App\Http\Controllers\api\PemeriksaanKlinisAPIController');
Route::apiResource('/kurirs', 'App\Http\Controllers\api\JenisKurirController');
Route::apiResource('/addimage', 'App\Http\Controllers\api\ImageController');