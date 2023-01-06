<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BiayaPengirimanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DetailPengirimanController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\InformasiPerusahaanController;
use App\Http\Controllers\JenisPengirimanController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\PengeluaranController;
use App\Http\Controllers\PengirimanController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\SyaratKetentuanController;
use App\Http\Controllers\UnitController;
use Illuminate\Support\Facades\Artisan;
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




Route::get('/', [FrontController::class, 'index']);
Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('login', [AuthController::class, 'proses_login'])->name('login');
Route::get('register', [AuthController::class, 'register'])->name('register');
Route::post('register', [AuthController::class, 'proses_register'])->name('register');




Route::group(['middleware' => ['auth', 'ceklevel:koordinator,owner,staff,pelanggan']], function () {
    //dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    //pengiriman
    Route::get('/pengiriman', [PengirimanController::class, 'index'])->name('pengiriman');
    Route::get('pengiriman/detail/{id}', [PengirimanController::class, 'detail_data']);
    Route::get('/pengiriman/cetak_pemasukan', [PengirimanController::class, 'cetak_pemasukan']);
    //pengeluaran
    Route::get('/pengeluaran', [PengeluaranController::class, 'index']);
    Route::get('/cetak_pengeluaran', [PengeluaranController::class, 'cetak_pengeluaran']);
    //PROFIL
    Route::get('profil', [ProfilController::class, 'index'])->name('profil');
    Route::put('akun', [ProfilController::class, 'akun'])->name('profil.akun');
    Route::put('password', [ProfilController::class, 'password'])->name('profil.password');
    //auth
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});


Route::group(['middleware' => ['auth', 'ceklevel:koordinator,staff,pelanggan']], function () {
    //pengiriman
    Route::get('/pengiriman/input', [PengirimanController::class, 'create_pengiriman']);
    Route::post('/pengiriman', [PengirimanController::class, 'store_pengiriman']);
    Route::get('/pengiriman/edit/{id}', [PengirimanController::class, 'edit_pengiriman']);
    Route::put('/pengiriman/update/{id}', [PengirimanController::class, 'update_pengiriman']);
    Route::get('get/BiayaPengiriman/{id}', [PengirimanController::class, 'getBiayaPengiriman'])->name('getBiayaPengiriman');
    //detail pengiriman
    Route::post('/pengiriman/store_detail', [DetailPengirimanController::class, 'store_detail']);
    Route::delete('/pengiriman/delete_detail/{id}', [DetailPengirimanController::class, 'delete_detail']);
    Route::get('/pengiriman/edit_detail/{id}', [DetailPengirimanController::class, 'edit_detail']);
    Route::put('/pengiriman/update_detail/{id}', [DetailPengirimanController::class, 'update_detail']);
    Route::get('/pengiriman/berita_acara/{id}', [PengirimanController::class, 'berita_acara']);
    Route::get('/pengiriman/cetak_tagihan/{id}', [PengirimanController::class, 'cetak_tagihan']);

    //keranjang
    Route::post('/pengiriman/keranjang', [KeranjangController::class, 'store_keranjang']);
    Route::get('/pengiriman/edit_keranjang/{id}', [KeranjangController::class, 'edit_keranjang']);
    Route::put('/pengiriman/update_keranjang/{id}', [KeranjangController::class, 'update_keranjang']);
    Route::delete('/pengiriman/delete_keranjang/{id}', [KeranjangController::class, 'delete_keranjang']);
});


Route::group(['middleware' => ['auth', 'ceklevel:koordinator,staff']], function () {
    Route::get('/pengeluaran/input', [PengeluaranController::class, 'create']);
    Route::post('/pengeluaran/input', [PengeluaranController::class, 'store']);
    Route::get('/pengeluaran/edit/{id}', [PengeluaranController::class, 'edit']);
    Route::put('/pengeluaran/update/{id}', [PengeluaranController::class, 'update']);
    //informasi perusahaan
    Route::put('/informasi_perusahaan/{id}', [InformasiPerusahaanController::class, 'update']);
    //verifikasi pengiriman
    Route::get('/status_pengiriman/{id}', [PengirimanController::class, 'status_pengiriman']);
    Route::get('/show/{id}', [PengirimanController::class, 'show']);
});


Route::group(['middleware' => ['auth', 'ceklevel:owner,koordinator']], function () {
    //unit
    Route::get('/unit', [UnitController::class, 'index']);
    //jenis pengiriman
    Route::get('/jenis', [JenisPengirimanController::class, 'index']);
    //syarat & ketentuan
    Route::get('/syarat_ketentuan', [SyaratKetentuanController::class, 'index']);
});





Route::group(['middleware' => ['auth', 'ceklevel:koordinator']], function () {
    //manajemen pengguna
    Route::get('/pengguna', [AuthController::class, 'pengguna']);
    Route::get('/pengguna/input', [AuthController::class, 'input_pengguna']);
    Route::post('/pengguna/input', [AuthController::class, 'store_pengguna']);
    Route::get('/pengguna/edit/{id}', [AuthController::class, 'edit_pengguna']);
    Route::put('/pengguna/update/{id}', [AuthController::class, 'update_pengguna']);
    Route::delete('/pengguna/delete/{id}', [AuthController::class, 'delete_pengguna']);
    //unit
    Route::get('/unit/input', [UnitController::class, 'create']);
    Route::post('/unit/input', [UnitController::class, 'store']);
    Route::get('/unit/edit/{id}', [UnitController::class, 'edit']);
    Route::put('/unit/update/{id}', [UnitController::class, 'update']);
    Route::delete('/unit/delete/{id}', [UnitController::class, 'destroy']);
    //jenis pengiriman
    Route::get('/jenis/input', [JenisPengirimanController::class, 'create']);
    Route::post('/jenis/input', [JenisPengirimanController::class, 'store']);
    Route::get('/jenis/edit/{id}', [JenisPengirimanController::class, 'edit']);
    Route::put('/jenis/update/{id}', [JenisPengirimanController::class, 'update']);
    Route::delete('/jenis/delete/{id}', [JenisPengirimanController::class, 'destroy']);
    //syarat & ketentuan
    Route::get('/syarat_ketentuan/input', [SyaratKetentuanController::class, 'create']);
    Route::post('/syarat_ketentuan/input', [SyaratKetentuanController::class, 'store']);
    Route::get('/syarat_ketentuan/edit/{id}', [SyaratKetentuanController::class, 'edit']);
    Route::put('/syarat_ketentuan/update/{id}', [SyaratKetentuanController::class, 'update']);
    Route::delete('/syarat_ketentuan/delete/{id}', [SyaratKetentuanController::class, 'destroy']);
    //biaya pengiriman
    Route::get('/biaya_pengiriman/input', [BiayaPengirimanController::class, 'create']);
    Route::post('/biaya_pengiriman/input', [BiayaPengirimanController::class, 'store']);
    Route::get('/biaya_pengiriman/edit/{id}', [BiayaPengirimanController::class, 'edit']);
    Route::put('/biaya_pengiriman/update/{id}', [BiayaPengirimanController::class, 'update']);
    Route::delete('/biaya_pengiriman/delete/{id}', [BiayaPengirimanController::class, 'destroy']);
    //pengeluaran
    Route::delete('/pengeluaran/delete/{id}', [PengeluaranController::class, 'destroy']);
});

Route::group(['middleware' => ['auth', 'ceklevel:koordinator,pelanggan']], function () {
    //pengiriman
    Route::delete('/pengiriman/delete/{id}', [PengirimanController::class, 'delete_pengiriman']);
});

Route::group(['middleware' => ['auth', 'ceklevel:koordinator,staff,owner']], function () {
    //biaya pengiriman
    Route::get('/biaya_pengiriman', [BiayaPengirimanController::class, 'index']);
    //informasi perusahaan
    Route::get('/informasi_perusahaan', [InformasiPerusahaanController::class, 'index']);
});



Route::get(' / foo', function () {
    Artisan::call('storage: link');
});
