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
        Route::post('/home/{id_ppk}/store', [App\Http\Controllers\HomeController::class, 'store'])->name('store');
        Route::get('/home/{id_ppk}/delete/{id_dokumen}', [App\Http\Controllers\HomeController::class, 'deleteDokumen'])->name('deleteDokumen');

        Route::post('/home/storeDokumen', [App\Http\Controllers\HomeController::class, 'storeDokumen'])->name('trader.storeDocument');
        Route::post('/home/dokumen/pilihMaster', [App\Http\Controllers\HomeController::class, 'pilihMaster'])->name('trader.pilihMaster');

        Route::get('/master', [App\Http\Controllers\MasterDokumenController::class, 'index'])->name('trader.master_dokumen');
        Route::get('/master/addMaster', [App\Http\Controllers\MasterDokumenController::class, 'master'])->name('trader.addMaster');
        Route::post('/master/addMaster/storeMaster', [App\Http\Controllers\MasterDokumenController::class, 'storeMaster'])->name('trader.storeMaster');
    });
    // Login untuk trader
    Route::get('/', [\App\Http\Controllers\LoginController::class, 'formLogin'])->name('login');
    Route::post('/', [\App\Http\Controllers\LoginController::class, 'login'])->name('login');
    Route::get('/logout', [\App\Http\Controllers\LoginController::class, 'logout'])->name('logout');

    //login untuk admin
    Route::group(['middleware' => 'auth:admin'], function () {
        Route::get('/admin/manage', [App\Http\Controllers\AdminController::class, 'manage'])->name('admin.manage');
        Route::get('/admin/manage/addUser', [App\Http\Controllers\AdminController::class, 'tambahUser'])->name('admin.addUser');
        Route::get('/admin/manage/delete/{id_trader}', [App\Http\Controllers\AdminController::class, 'deleteUser'])->name('admin.deleteUser');
        Route::get('/admin/menu', [App\Http\Controllers\AdminController::class, 'allMenu'])->name('admin.menu');
        Route::get('/admin/menu/editMenu/{id_menu}', [App\Http\Controllers\AdminController::class, 'editMenu'])->name('admin.editMenu');
        Route::get('/admin/publikasi', [App\Http\Controllers\AdminController::class, 'allGambar'])->name('admin.publikasi');
        Route::get('/admin/publikasi/addGambar', [App\Http\Controllers\AdminController::class, 'tambahGambar'])->name('admin.addGambar');
        Route::get('/admin/publikasi/delete/{id_gambar}', [App\Http\Controllers\AdminController::class, 'deleteGambar'])->name('admin.deleteGambar');
        Route::post('/admin/search', [App\Http\Controllers\AdminController::class, 'searchUser'])->name('admin.search');
        Route::post('/admin/menu/update', [App\Http\Controllers\AdminController::class, 'updateMenu'])->name('admin.updateMenu');
        Route::post('/admin/publikasi/addGambar/sukses', [App\Http\Controllers\AdminController::class, 'storeGambar'])->name('admin.storeGambar');
        Route::post('/admin/manage/addUser/sukses', [App\Http\Controllers\AdminController::class, 'storeUser'])->name('admin.storeUser');
        Route::post('/admin/search/gambar', [App\Http\Controllers\AdminController::class, 'searchGambar'])->name('admin.searchGambar');

    });
    Route::get('/loginadmin', [\App\Http\Controllers\LoginAdminController::class, 'formLogin'])->name('loginadmin');
    Route::post('/loginadmin', [\App\Http\Controllers\LoginAdminController::class, 'loginAdmin'])->name('loginadmin');
    Route::get('/logoutadmin', [\App\Http\Controllers\LoginAdminController::class, 'logoutadmin'])->name('logoutadmin');

    //Login untuk jasper
    Route::group(['middleware' => 'auth:jpp'], function () {
        Route::get('/jpp/home', [App\Http\Controllers\JPPController::class, 'index'])->name('jpp.home');
        Route::get('/jpp/pemeriksaan', [App\Http\Controllers\JPPController::class, 'pemeriksaan'])->name('jpp.pemeriksaan');

    });
    Route::get('/loginjpp', [\App\Http\Controllers\LoginJPPController::class, 'formLogin'])->name('loginjpp');
    Route::post('/loginjpp', [\App\Http\Controllers\LoginJPPController::class, 'login'])->name('loginjpp');
    Route::get('/logoutjpp', [\App\Http\Controllers\LoginJPPController::class, 'logout'])->name('logoutjpp');
});
