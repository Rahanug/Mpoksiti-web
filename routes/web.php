<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

// Routes untuk Dashboard pada Halaman trader
Route::group(['middleware' => 'revalidate'], function () {
    Route::group(['middleware' => 'auth:trader'], function () {

        Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('trader.home');
    });
    // Login untuk trader
    Route::get('/login', [\App\Http\Controllers\LoginController::class, 'formLogin'])->name('login');
    Route::post('/login', [\App\Http\Controllers\LoginController::class, 'login'])->name('login');
    Route::get('/logout', [\App\Http\Controllers\LoginController::class, 'logout'])->name('logout');

    //login untuk admin
    Route::group(['middleware' => 'auth:admin'], function () {
        Route::get('/homeadmin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.home');
    });
    Route::get('/loginadmin', [\App\Http\Controllers\LoginAdminController::class, 'formLogin'])->name('loginadmin');
    Route::post('/loginadmin', [\App\Http\Controllers\LoginAdminController::class, 'loginAdmin'])->name('loginadmin');
    Route::get('/logoutadmin', [\App\Http\Controllers\LoginAdminController::class, 'logoutadmin'])->name('logoutadmin');

});
