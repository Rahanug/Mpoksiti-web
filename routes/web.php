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
        Route::get('/home/{id_ppk}/preview/{id_dokumen}', [App\Http\Controllers\HomeController::class, 'previewDokumen'])->name('previewDokumen');
        Route::post('/home/ajukan/{id_ppk}', [App\Http\Controllers\HomeController::class, 'ajukanTanggal'])->name('ajukanTanggal');
        Route::get('/home/cetakHC/{id_ppk}', [App\Http\Controllers\HomeController::class, 'cetakHC'])->name('trader.cetakHC');
        Route::get('/home/detail/{id_ppk}', [App\Http\Controllers\HomeController::class, 'detail'])->name('trader.detail');

        Route::post('/home/storeDokumen', [App\Http\Controllers\HomeController::class, 'storeDokumen'])->name('trader.storeDocument');
        Route::post('/home/dokumen/pilihMaster', [App\Http\Controllers\HomeController::class, 'pilihMaster'])->name('trader.pilihMaster');

        Route::get('/master', [App\Http\Controllers\MasterDokumenController::class, 'index'])->name('trader.master_dokumen');
        Route::get('/master/addMaster', [App\Http\Controllers\MasterDokumenController::class, 'master'])->name('trader.addMaster');
        Route::post('/master/addMaster/storeMaster', [App\Http\Controllers\MasterDokumenController::class, 'storeMaster'])->name('trader.storeMaster');
        Route::get('/master/editMaster/{id_master}', [App\Http\Controllers\MasterDokumenController::class, 'editMaster'])->name('trader.editMaster');
        Route::post('/master/editMaster/{id_master}/updateMaster', [App\Http\Controllers\MasterDokumenController::class, 'updateMaster'])->name('trader.editMaster');

        Route::get('/home/form/{id_ppk}', [App\Http\Controllers\FormController::class, 'Hasil'])->name('trader.hasil_form');
    });
    // Login untuk trader
    Route::get('/login', [\App\Http\Controllers\LoginController::class, 'formLogin'])->name('login');
    Route::post('/login', [\App\Http\Controllers\LoginController::class, 'login'])->name('login');
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

        // Ekspor
        Route::get('/admin/master', [App\Http\Controllers\MasterDokumenController::class, 'indexAdmin'])->name('admin.master_dokumen_trader');
        Route::get('/admin/master/{id_trader}', [App\Http\Controllers\MasterDokumenController::class, 'verifikasi'])->name('admin.verifikasi');
        Route::get('/admin/master/accept/{id_master}', [App\Http\Controllers\MasterDokumenController::class, 'accept'])->name('admin.verifikasi');
        Route::get('/admin/master/decline/{id_master}', [App\Http\Controllers\MasterDokumenController::class, 'decline'])->name('admin.verifikasi');
        Route::get('/admin/stuffing', [App\Http\Controllers\StuffingController::class, 'index'])->name('admin.stuffing');
        Route::get('/admin/stuffing/{id_ppk}', [App\Http\Controllers\StuffingController::class, 'dokumen'])->name('admin.document_stuffing');
        Route::get('/admin/stuffing/{id_ppk}/accept', [App\Http\Controllers\StuffingController::class, 'accept'])->name('admin.stuffing');
        Route::post('/admin/stuffing/{id_ppk}/decline', [App\Http\Controllers\StuffingController::class, 'decline'])->name('admin.stuffing');
        Route::post('/admin/stuffing/{id_ppk}/terima', [App\Http\Controllers\StuffingController::class, 'terima'])->name('admin.stuffing');
        Route::post('/admin/stuffing/{id_ppk}/tolak', [App\Http\Controllers\StuffingController::class, 'tolak'])->name('admin.stuffing');
        Route::get('/admin/stuffing/form/{id_ppk}', [App\Http\Controllers\FormController::class, 'index'])->name('admin.form_stuffing');
        Route::post('/admin/stuffing/form/{id_ppk}/storeSubform', [App\Http\Controllers\FormController::class, 'storeSubform'])->name('admin.form_stuffing');
        Route::post('/admin/stuffing/{id_ppk}/izin', [App\Http\Controllers\StuffingController::class, 'izin'])->name('admin.stuffing');
        Route::get('/admin/stuffing/detail/{id_ppk}', [App\Http\Controllers\StuffingController::class, 'detail'])->name('admin.detail');

        // Kategori
        Route::get('/admin/kategori', [App\Http\Controllers\KategoriController::class, 'index'])->name('admin.kategori_dokumen');
        Route::get('/admin/kategori/TambahKategori', [App\Http\Controllers\KategoriController::class, 'addKategori'])->name('admin.addKategori');
        Route::get('/admin/kategori/editKategori/{id_kategori}', [App\Http\Controllers\KategoriController::class, 'editKategori'])->name('admin.editKategori');
        Route::post('/admin/kategori/editKategori/{id_kategori}/update', [App\Http\Controllers\KategoriController::class, 'updateKategori'])->name('admin.editKategori');
        Route::post('/admin/kategori/TambahKategori/add', [App\Http\Controllers\KategoriController::class, 'storeKategori'])->name('admin.addKategori');
        // Form
        Route::get('/admin/subform', [App\Http\Controllers\SubformController::class, 'index'])->name('admin.master_subform');
        Route::get('/admin/subform/TambahSubform', [App\Http\Controllers\SubformController::class, 'addSubform'])->name('admin.master_subform');
        Route::post('/admin/subform/TambahSubform/add', [App\Http\Controllers\SubformController::class, 'storeSubform'])->name('admin.addSubform');
        Route::get('/admin/subform/EditSubform/{id_masterSubform}', [App\Http\Controllers\SubformController::class, 'editSubform'])->name('admin.editSubform');
        Route::post('/admin/subform/EditSubform/{id_masterSubform}/update', [App\Http\Controllers\SubformController::class, 'updateSubform'])->name('admin.editSubform');

        //Pemeriksaan Klinis
        Route::get('/admin/pemeriksaan_klinis', [App\Http\Controllers\AdminPKController::class, 'index'])->name('admin.PK-pemeriksaan_klinis');
        Route::post('/admin/pemeriksaan_klinis/kirim_url', [App\Http\Controllers\AdminPKController::class, 'sendLinkPemeriksaanKlinis']);
        Route::post('/admin/pemeriksaan_klinis/action', [App\Http\Controllers\AdminPKController::class, 'sendAction']);
        Route::get('/admin/jasper_management', [App\Http\Controllers\AdminJPPController::class, 'index'])->name('admin.PK-jasper_management');
        Route::post('/admin/jasper_management/add_jasper', [App\Http\Controllers\AdminJPPController::class, 'addJPP']);
        Route::post('/admin/jasper_management/update_jasper', [App\Http\Controllers\AdminJPPController::class, 'updateJPP']);
        Route::post('/admin/jasper_management/toggle_jasper', [App\Http\Controllers\AdminJPPController::class, 'toggleJPP']);
        Route::get('/admin/kurir_management', [App\Http\Controllers\AdminJPPController::class, 'kurir'])->name('admin.PK-kurir_management');
        Route::post('/admin/kurir_management/add_kurir', [App\Http\Controllers\AdminJPPController::class, 'addKurir']);
        Route::post('/admin/kurir_management/update_kurir', [App\Http\Controllers\AdminJPPController::class, 'updateKurir']);
    });
    Route::get('/loginadmin', [\App\Http\Controllers\LoginAdminController::class, 'formLogin'])->name('loginadmin');
    Route::post('/loginadmin', [\App\Http\Controllers\LoginAdminController::class, 'loginAdmin'])->name('loginadmin');
    Route::get('/logoutadmin', [\App\Http\Controllers\LoginAdminController::class, 'logoutadmin'])->name('logoutadmin');

    //Login untuk jasper
    Route::group(['middleware' => 'auth:jpp'], function () {
        Route::get('/jpp/home', [App\Http\Controllers\JPPController::class, 'index'])->name('jpp.home');
        Route::get('/jpp/pemeriksaan', [App\Http\Controllers\JPPController::class, 'pemeriksaan'])->name('jpp.pemeriksaan');
        Route::post('/jpp/permohonan', [App\Http\Controllers\JPPController::class, 'permohonan'])->name('jpp.permohonan');
    });
    Route::get('/loginjpp', [\App\Http\Controllers\LoginJPPController::class, 'formLogin'])->name('loginjpp');
    Route::post('/loginjpp', [\App\Http\Controllers\LoginJPPController::class, 'login'])->name('loginjpp');
    Route::get('/logoutjpp', [\App\Http\Controllers\LoginJPPController::class, 'logout'])->name('logoutjpp');
});
