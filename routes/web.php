<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\DeveloperController;
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
    return view('welcome');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::middleware(['admin'])->group(function () {
        Route::resource('admin', AdminController::class);
    });

    Route::middleware(['kasir'])->group(function () {
        Route::resource('kasir', KasirController::class);
    });

    Route::middleware(['developer'])->group(function () {
        Route::resource('developer', DeveloperController::class);
    });

    Route::get('/logout', function () {
        Auth::logout();
        redirect('/');
    });
});
