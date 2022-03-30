<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\OutletController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\TransaksiController;

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


//login
Route::get('/', function () {
    return view('login');
});
Route::post('/', [UserController::class, 'login'])->name('postlogin');

//register
Route::get('/register', function () {
    return view('register');
});
Route::post('/postregister', [UserController::class, 'register'])->name('postregister');

//logout
Route::get('/logout', [UserController::class, 'logout'])->name('logout');

Route::get('/index', [UserController::class,'show']);


//Admin

    Route::get('/index',[UserController::class,'show']); 
    //member
    Route::get('/member', [MemberController::class,'show'])->name('member');
    Route::post('/membertambah', [MemberController::class,'store'])->name('member_tambah');
    Route::post('/memberedit/{id_member}', [MemberController::class,'update'])->name('member_edit');
    Route::get('/edit_member/{id_member}', [MemberController::class,'edit'])->name('editmember');
    Route::delete('/delete_member/{id_member}', [MemberController::class,'destroy'])->name('deletemember');
    Route::get('/tambahmember', function () {
        return view('tambah_member');
    });

    //paket
    Route::get('/paket', [ProdukController::class,'show'])->name('paket');
    Route::post('/pakettambah', [ProdukController::class,'store'])->name('paket_tambah');
    Route::post('/paketedit/{id_paket}', [ProdukController::class,'update'])->name('paket_edit');
    Route::get('/edit_paket/{id_paket}', [ProdukController::class,'edit'])->name('editpaket');
    Route::delete('/delete_paket/{id_paket}', [ProdukController::class,'destroy'])->name('deletepaket');
    Route::get('/tambahpaket', function () {
        return view('tambah_paket');
    });

    //outlet
    Route::get('/outlet',[OutletController::class,'show'])->name('outlet');
    Route::post('/outlettambah',[OutletController::class,'store'])->name('outlet_tambah');
    Route::post('/outletedit/{id_outlet}',[OutletController::class,'update'])->name('outlet_edit');
    Route::get('/edit_outlet/{id_outlet}',[OutletController::class,'edit'])->name('editoutlet');
    Route::delete('/delete_outlet/{id_outlet}',[OutletController::class,'destroy'])->name('deleteoutlet');
    Route::get('/tambahoutlet', function () { 
        return view('tambah_outlet'); 
    });

    //transaksi
    Route::get('/transaksi', [TransaksiController::class,'getAll'])->name('transaksi');
    Route::post('/transaksitambah', [TransaksiController::class,'store'])->name('transaksi_tambah');
    Route::get('/tambahtransaksi', [TransaksiController::class,'tambah'])->name('tambahtransaksi');


    



