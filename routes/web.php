<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\DeveloperController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderDetailController;
use App\Http\Controllers\PemasukanController;
use App\Http\Controllers\PengeluaranController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\SupervisorController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return redirect()->route('home');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {

    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::middleware(['admin'])->group(function () {
        Route::resource('admin', AdminController::class);
        Route::resource('pengeluaran', PengeluaranController::class);
        Route::resource('pembayaran', PembayaranController::class);
        Route::get('/pengeluaran/previewPengeluaran/{params}', [PengeluaranController::class, 'previewPengeluaran'])->name('previewPengeluaran');
        Route::get('/bukukas/index',[AdminController::class, 'bukuKasRekap'])->name('bukukas.rekap');
        Route::get('/bukukas/{tahun}/{bulan}/{hari}',[AdminController::class, 'bukuKasRekapHarian'])->name('bukukas.rekapHarian');
        Route::get('/bukukas/{tahun}/{bulan}',[AdminController::class, 'bukuKasRekapBulanan'])->name('bukukas.rekapBulanan');
        Route::get('/bukukas/{tahun}',[AdminController::class, 'bukuKasRekapTahunan'])->name('bukukas.rekapTahunan');
    });

    Route::middleware(['supervisor'])->group(function () {
        Route::resource('supervisor', SupervisorController::class);
        Route::get('/rekapData/index', [SupervisorController::class, 'bukuKasRekap'])->name('rekapData.all');
        Route::get('/rekapData/{tahun}/{bulan}/{hari}',[SupervisorController::class, 'rekapDataHarian'])->name('rekapData.rekapHarian');
        Route::get('/rekapData/{tahun}/{bulan}',[SupervisorController::class, 'rekapDataBulanan'])->name('rekapData.rekapBulanan');
        Route::get('/rekapData/{tahun}',[SupervisorController::class, 'rekapDataTahunan'])->name('rekapData.rekapTahunan');
    });

    Route::middleware(['kasir'])->group(function () {
        Route::resource('kasir', KasirController::class);
        Route::resource('order', OrderController::class);
        Route::put('/order/{id}/batal', [OrderController::class, 'batal'])->name('order.batal');        
        Route::put('/order/{id}/selesai', [OrderController::class, 'selesai'])->name('order.selesai');        
        Route::resource('orderDetail', OrderDetailController::class);  
        Route::post('/orderDetail/storeFromCart', [OrderDetailController::class, 'storeFromCart'])->name('storeFromCart');        
        Route::resource('pemasukan', PemasukanController::class); 
        Route::get('/pemasukan/previewFotoBukti/{params}', [PemasukanController::class, 'previewFoto'])->name('previewFoto'); 
        Route::get('/pemasukan/createWithId/{params}', [PemasukanController::class, 'createWithId'])->name('createWithId');
        Route::get('/pemasukan/backToEditOrder/{params}', [PemasukanController::class, 'backToEditOrder'])->name('backToEditOrder');  
        Route::get('/order/cetakNotaPemesanan/{params}', [OrderController::class, 'cetakNotaPemesanan'])->name('cetakNotaPemesanan');  
        Route::get('/order/cetakNotaKeseluruhan/{params}', [OrderController::class, 'cetakNotaKeseluruhan'])->name('cetakNotaKeseluruhan');
        Route::get('/order/cetakNotaPembayaran/{params}', [PemasukanController::class, 'cetakNotaPembayaran'])->name('cetakNotaPembayaran'); 


    });

    Route::middleware(['developer'])->group(function () {
        Route::resource('developer', DeveloperController::class);
        Route::resource('product', ProductController::class);
        Route::resource('user', UserController::class);
    });

    Route::get('/logout', function () {
        Auth::logout();
        redirect('/');
    });
    
});
