<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\DataPegawaiController;
use App\Http\Controllers\DataPelangganController;
use App\Http\Controllers\EntriPadamController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
// Route::controller(AuthenticatedSessionController::class)->group(function(){
//     Route::get('/', 'create')->name('login');
//     Route::post('/store', 'store');
//     Route::get('/destroy', 'destroy');
// });
// Route::controller(RegisteredUserController::class)->group(function(){
//     Route::get('/create', 'create')->name('register');
//     Route::get('/store', 'store')->name('store');
// });
Route::controller(UserController::class)->group(function () {
    Route::get('/', 'index')->name('login');
    Route::get('/register', 'register');
    Route::post('/store', 'store');
    Route::post('/proseslogin', 'authenticate')->name('authenticate');
    Route::get('/logout', 'logout')->name('authenticate');
});
Route::controller(DataPelangganController::class)->group(function () {
    Route::get('/beranda', 'index')->middleware('auth');
    Route::get('/entripadam', 'entri_padam')->middleware('auth');
    Route::delete('/hapus_pelanggan', 'hapusPelanggan');
    Route::get('/kirimwhatsapp', 'sendWhatsAppMessage');
    Route::get('/inputpelanggan', 'input_pelanggan')->middleware('auth');
    Route::get('/inputpelanggan/export_excel', 'export_excel');
    Route::post('/inputpelanggan/import_excel', 'import_excel');
    Route::get('/inputpelanggan/hapus_pelanggan', 'hapusPelanggan');
});
Route::controller(EntriPadamController::class)->group(function () {
    Route::get('/petapadam', 'petapadam')->middleware('auth');
    Route::get('/transaksipadam', 'index')->middleware('auth');
    Route::get('/transaksiaktif', 'transaksiaktif')->middleware('auth');
    Route::post('/entripadam/insertentripadam', 'insertEntriPadam');
    Route::post('/entripadam', 'insertPadam');
    Route::get('/transaksipadam/export_kali_padam', 'export_kali_padam');
    Route::get('/transaksiaktif/export_pelanggan_padam', 'export_pelanggan_padam');
    Route::get('/transaksiaktif/export_pelanggan_padam_csv', 'export_pelanggan_padam_csv');
    Route::post('/entripadam/import_excel_penyulangsection', 'import_excel_penyulangsection');
    Route::get('/transaksipadam/hapus_entri', 'hapusEntriPadam');
    Route::post('/transaksipadam/edit_status_padam', 'editStatusPadam');
});
Route::controller(DataPegawaiController::class)->group(function(){
    Route::post('/tambah_pegawai', 'tambah_pegawai');
    Route::post('/edit_pegawai/{id}', 'edit_pegawai');
    Route::delete('/hapus_pegawai', 'hapus_pegawai');
});