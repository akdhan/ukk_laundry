<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MemberController;
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

Route::get('/member', function () { 
    return view('member'); 
});

Route::get('/paket', function () { 
    return view('paket'); 
});

Route::get('/outlet', function () { 
    return view('outlet'); 
});

Route::get('/transaksi', function () { 
    return view('transaksi'); 
});

Route::get('/tambahmember', function () { 
    return view('tambah_member'); 
});

Route::get('/tambahoutlet', function () { 
    return view('tambah_outlet'); 
});


