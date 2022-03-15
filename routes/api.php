<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MemberController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OutletController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', [UserController::class,'register']);
Route::post('login', [UserController::class, 'login']);

Route::group(['middleware' => ['jwt.verify']], function(){
    Route::group(['middleware' => ['api.admin']], function ()
    {
        Route::delete('/deletemember/{id_member}',[MemberController::class,'destroy']);
        Route::delete('/deleteoutlet/{id_outlet}',[OutletController::class,'destroy']);
        Route::delete('/deletepaket/{id_paket}',[ProdukController::class,'destroy']);
    });
    Route::group(['middleware' => ['api.admin,kasir']], function ()
    {
        Route::get('login/check', [UserController::class,'loginCheck']);
        Route::post('logout', [UserController::class,'logout']);

        

        Route::get('/showoutlet',[OutletController::class,'show']);
	    Route::post('/insertoutlet',[OutletController::class,'store']);
	    Route::put('/updateoutlet/{id_outlet}',[OutletController::class,'update']);
	
        Route::get('/showpaket',[ProdukController::class,'show']);
	    Route::post('/insertpaket',[ProdukController::class,'store']);
	    Route::put('/updatepaket/{id_paket}',[ProdukController::class,'update']);
	
        
    });
});

Route::post('/tambah', [TransaksiController::class, 'store']);
        Route::get('/transaksi/tampil', [TransaksiController::class, 'getAll']);
    

        Route::get('/showmember',[MemberController::class,'show']);
	    Route::post('/insertmember',[MemberController::class,'store']);
	    Route::put('/updatemember/{id_member}',[MemberController::class,'update']);