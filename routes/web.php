<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LihatNilai;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NotFoundController;
use App\Http\Controllers\KartuController;
use App\Http\Controllers\JenisProdukController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\PelangganController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', function () {
    return view('welcome');
});

Route::get('/salam', function(){
    return "Assalamualaikum Selamat Belajar Laravel";
});

Route::get('/staff/{nama}/{divisi}', function ($nama, $divisi) {
    return 'Nama : '.$nama. '<br> Departemen : '.$divisi;
});

Route::get('/kondisi', function () {
    return view('kondisi');
});

Route::get('/nilai', function () {
    return view('coba.nilai');
});

Route::get('/daftarnilai', function () {
    return view('coba.daftar');
});

Route::get('/datamahasiswa', [LihatNilai::class, 'dataMahasiswa']);


Route::get('/notfound', [NotFoundController::class, 'notfound']);

Route::prefix('/admin')->group(function(){
    Route::get('/dashboard', [DashboardController::class, 'index']);

    //menggunakan resource memanggil seluruh fungsi yang ada pada controller
    Route::resource('kartu', KartuController::class);

    Route::get('produk', [ProdukController::class, 'index']);
    Route::get('produk/create', [ProdukController::class, 'create']);
    Route::post('produk/store', [ProdukController::class, 'store']);
    Route::get('/produk/show/{id}', [ProdukController::class, 'show']);
    Route::get('/produk/edit/{id}', [ProdukController::class, 'edit']);
    Route::post('/produk/update/{id}', [ProdukController::class, 'update']);
    Route::get('/produk/delete/{id}', [ProdukController::class, 'destroy']);
    Route::get('/exportPDF', [ProdukController::class,'exportPdf']);
    Route::get('produk/produkPDF', [ProdukController::class,'produkPDF']);
    Route::get('produk/exportdtPDF/{id}', [ProdukController::class,'produkExport']);
    Route::get('produk/exportExcel', [ProdukController::class,'exportExcel']);
    Route::post('produk/importExcel', [ProdukController::class,'importExcel']);

    //memanggil fungsi satu persatu
    Route::get('/jenis_produk', [JenisProdukController::class, 'index']);
    Route::get('/jenis_produk/create', [JenisProdukController::class, 'create']);
    Route::post('/jenis_produk/store', [JenisProdukController::class, 'store']);
    Route::get('/jenis_produk/show/{id}', [JenisProdukController::class, 'show']);
    Route::get('/jenis_produk/edit/{id}', [JenisProdukController::class, 'edit']);
    Route::post('/jenis_produk/update/{id}', [JenisProdukController::class, 'update']);
    Route::get('/jenis_produk/delete/{id}', [JenisProdukController::class, 'destroy']);
    

    Route::resource('/pelanggan', PelangganController::class);
});