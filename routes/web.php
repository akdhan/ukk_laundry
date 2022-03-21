<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\OutletController;
use App\Http\Controllers\ProdukController;
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
    return view('index'); 
});
//member
Route::get('/member',[MemberController::class,'show'])->name('member');
Route::get('/tambahmember', function () { 
    return view('tambah_member'); 
});

//paket
Route::get('/paket',[ProdukController::class,'show'])->name('paket');
Route::get('/tambahpaket', function () { 
    return view('tambah_paket'); 
});

//outlet
Route::get('/outlet',[OutletController::class,'show'])->name('outlet');
Route::get('/tambahoutlet', function () { 
    return view('tambah_outlet'); 
});

//transaksi
Route::get('/transaksi', function () { 
    return view('transaksi'); 
});






