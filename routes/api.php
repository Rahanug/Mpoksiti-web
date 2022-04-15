<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::post('/regis', [App\Http\Controllers\api\AuthController::class, 'register'])->name('mobile.regis');
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('/jpp', 'App\Http\Controllers\api\JPPController');
Route::apiResource('/pemeriksaan_klinis', 'App\Http\Controllers\api\PemeriksaanKlinisAPIController');
Route::apiResource('/kurirs', 'App\Http\Controllers\api\JenisKurirController');
Route::apiResource('/addimage', 'App\Http\Controllers\api\ImageController');
