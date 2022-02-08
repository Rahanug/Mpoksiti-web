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
        Route::get('/home/{id_ppk}', [App\Http\Controllers\HomeController::class, 'dokumen'])->name('trader.document');
    });
    // Login untuk trader
    Route::get('/login', [\App\Http\Controllers\LoginController::class, 'formLogin'])->name('login');
    Route::post('/login', [\App\Http\Controllers\LoginController::class, 'login'])->name('login');
    Route::get('/logout', [\App\Http\Controllers\LoginController::class, 'logout'])->name('logout');

    //login untuk admin
    Route::group(['middleware' => 'auth:admin'], function () {
        Route::get('/admin/manage', [App\Http\Controllers\AdminController::class, 'manage'])->name('admin.manage');
        Route::get('/admin/manage/delete/{id_trader}', [App\Http\Controllers\AdminController::class, 'deleteUser'])->name('admin.deleteUser');
        Route::get('/admin/menu', [App\Http\Controllers\AdminController::class, 'allMenu'])->name('admin.menu');
        Route::get('/admin/menu/editMenu/{id_menu}', [App\Http\Controllers\AdminController::class, 'editMenu'])->name('admin.editMenu');
        Route::get('/admin/publikasi', [App\Http\Controllers\AdminController::class, 'allGambar'])->name('admin.publikasi');
        Route::get('/admin/publikasi/addGambar', [App\Http\Controllers\AdminController::class, 'tambahGambar'])->name('admin.addGambar');
        Route::get('/admin/publikasi/delete/{id_gambar}', [App\Http\Controllers\AdminController::class, 'deleteGambar'])->name('admin.deleteGambar');
        Route::post('/admin/search', [App\Http\Controllers\AdminController::class, 'searchUser'])->name('admin.search');
        Route::post('/admin/menu/update', [App\Http\Controllers\AdminController::class, 'updateMenu'])->name('admin.updateMenu');
        Route::post('/admin/publikasi/addGambar/sukses', [App\Http\Controllers\AdminController::class, 'storeGambar'])->name('admin.storeGambar');
        Route::post('/admin/search/gambar', [App\Http\Controllers\AdminController::class, 'searchGambar'])->name('admin.searchGambar');

    });
    Route::get('/loginadmin', [\App\Http\Controllers\LoginAdminController::class, 'formLogin'])->name('loginadmin');
    Route::post('/loginadmin', [\App\Http\Controllers\LoginAdminController::class, 'loginAdmin'])->name('loginadmin');
    Route::get('/logoutadmin', [\App\Http\Controllers\LoginAdminController::class, 'logoutadmin'])->name('logoutadmin');

});
