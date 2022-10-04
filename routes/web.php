<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminRtController;
use App\Http\Controllers\LayoutController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;


Route::get('/', [LayoutController::class, 'index'])->middleware('auth');
Route::get('/home', [LayoutController::class, 'index'])->middleware('auth');

// route login
Route::controller(LoginController::class)->group(function () {
    Route::get('login', 'index')->name('login');
    Route::post('login/proses', 'proses');
    Route::get('logout', 'logout');
});


// route group
Route::group(['middleware' => ['auth']], function () {

    // user level 1
    Route::group(['middleware' => ['cekUserLogin:1']], function () {

        // admin dasawisma
        Route::get('admin/daftar-dasawisma', [AdminController::class, 'index']);
        Route::get('admin/tambah-dasawisma', [AdminController::class, 'tambah']);
        Route::post('admin/proses-tambah', [AdminController::class, 'prosesTambah']);
        Route::get('admin/edit-dasawisma/{username}', [AdminController::class, 'edit']);
        Route::put('admin/proses-edit/{username}', [AdminController::class, 'prosesEdit']);
        Route::delete('/admin/hapus/{username}', [AdminController::class, 'hapus']);


        // admin Rt/Dusun
        Route::get('admin/daftar-admin', [AdminRtController::class, 'index']);
        Route::get('admin/tambah-admin', [AdminRtController::class, 'tambah']);
        Route::post('admin/proses-tambah-admin', [AdminRtController::class, 'prosesTambah']);
        Route::get('admin/edit-admin/{username}', [AdminRtController::class, 'edit']);
        Route::put('admin/proses-edit-admin/{username}', [AdminRtController::class, 'prosesEdit']);
        Route::delete('/admin/hapus-admin/{username}', [AdminRtController::class, 'hapus']);


        // admin Kelurahan/desa
        Route::get('admin/daftar-admin-kelurahan', [AdminController::class, 'dataAdminKelurahan']);
        Route::get('admin/tambah-admin-kelurahan', [AdminController::class, 'tambahAdminKelurahan']);
        Route::post('admin/proses-tambah-admin-kelurahan', [AdminController::class, 'prosesTambahAdminKelurahan']);
        Route::get('admin/edit-admin-kelurahan/{username}', [AdminController::class, 'editAdminKelurahan']);
        Route::put('admin/proses-edit-admin-kelurahan/{username}', [AdminController::class, 'prosesEditAdminKelurahan']);
        Route::delete('admin/hapus-admin-kelurahan/{username}', [AdminController::class, 'hapusAdminKelurahan']);
    });

    // user level 2
    Route::group(['middleware' => ['cekUserLogin:2']], function () {

        // akun RT
        Route::get('admin2/daftar-admin', [AdminRtController::class, 'dataByDukuh']);
        Route::get('admin2/tambah-admin', [AdminRtController::class, 'tambahAdminRt']);
        Route::post('admin2/proses-tambah', [AdminRtController::class, 'prosesTambahAdminRt']);
        Route::get('admin2/edit-admin/{username}', [AdminRtController::class, 'editAdminRt']);
        Route::put('admin2/proses-edit-admin/{username}', [AdminRtController::class, 'prosesEditAdminRt']);
        Route::delete('admin2/hapus-admin/{username}', [AdminRtController::class, 'hapusAdminRt']);


        // akun dasawisma
        Route::get('admin2/daftar-dasawisma', [AdminRtController::class, 'dasawismaByDukuh']);
        Route::get('admin2/tambah-dasawisma', [AdminRtController::class, 'tambahAdminDasawisma']);
        Route::post('admin2/proses-tambah-dasawisma', [AdminRtController::class, 'prosesTambahAdminDasawisma']);
        Route::get('admin2/edit-dasawisma/{username}', [AdminRtController::class, 'editAdminDasawisma']);
        Route::put('admin2/proses-edit-dasawisma/{username}', [AdminRtController::class, 'prosesEditAdminDasawisma']);
        Route::delete('admin2/hapus-dasawisma/{username}', [AdminRtController::class, 'hapusAdminDasawisma']);


        // daftar warga tp pkk
        Route::get('admin2/daftar-warga-tp-pkk', [AdminRtController::class, 'wargaTpPkk']);
    });

    Route::group(['middleware' => ['cekUserLogin:3']], function () {
    });
});
