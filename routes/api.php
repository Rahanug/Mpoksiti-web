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
Route::post('/regisuser', [App\Http\Controllers\api\AuthController::class, 'register'])->name('mobile.regis');
Route::post('/loginuser', [App\Http\Controllers\api\AuthController::class, 'login'])->name('mobile.login');
Route::post('/npwp', [App\Http\Controllers\api\AuthController::class, 'checknpwp'])->name('mobile.checknpwp');
Route::get('/menu/{id_menu}', [App\Http\Controllers\api\AuthController::class, 'getMenuUrl'])->name('mobile.getmenu');

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::post('/logoutuser', [App\Http\Controllers\api\AuthController::class, 'logout'])->name('mobile.logout');
    Route::post('/user', [App\Http\Controllers\api\AuthController::class, 'getUserData'])->name('mobile.checkuser');
    Route::post('/farm', [App\Http\Controllers\api\AuthController::class, 'getFarmLocation'])->name('mobile.checkfarm');
    Route::apiResource('/pemeriksaan_klinis', 'App\Http\Controllers\api\PemeriksaanKlinisAPIController');
    Route::apiResource('/addimage', 'App\Http\Controllers\api\ImageController');
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::apiResource('/stuffing', 'App\Http\Controllers\api\StuffingController');
Route::apiResource('/jpp', 'App\Http\Controllers\api\JPPController');
Route::apiResource('/kurirs', 'App\Http\Controllers\api\JenisKurirController');

Route::get('/checkPemeriksaanKlinis', [App\Http\Controllers\api\NotifAPIController::class, 'check']);
Route::get('/checkPemeriksaanKlinisJPP/{id}', [App\Http\Controllers\api\NotifAPIController::class, 'checkJPP']);
