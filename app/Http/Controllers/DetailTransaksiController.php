<?php

namespace App\Http\Controllers;
use App\Models\detil_transaksi;
use App\Models\paket;
use App\Helpers\ResponseHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use JWTAuth;

class DetailTransaksiController extends Controller
{
    public $user;
    public $response;
    public function __construct()
    {
        $this->response = new ResponseHelper();
        $this->user = JWTAuth::parseToken()->authenticate();
    }

    //tambah
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_transaksi' => 'required',
            'id_paket' => 'required',
            'qty' => 'required',
        ]);

        if($validator->fails()) {
            return $this->response->errorResponse($validator->fails());
        }
        
        $detail = new detil_transaksi();
        $detail->id_transaksi = $request->id_transaksi;
        $detail->id_paket = $request->id_paket;

        //tampil
        $paket = Paket::where('id', '=', $detail->id_paket)->first();
        $harga = $paket->harga;

        $detail->qty = $request->qty;
        $detail->subtotal = $detail->qty * $harga;

        $detail->save();

        $data = detil_transaksi::where('id', '=', $detail->id)->first();

        return response()->json(['message' => 'Berhasil tambah detail transaksi', 'data' => $data]);

        //*
    }

    public function getById($id)
    {
        //ambil detail dari transaksi tertentu

        $data = DB::table('detil_transaksi')->join('paket', 'detil_transaksi.id_paket', 'paket.id')
                                            ->select('detil_transaksi.*', 'paket.jenis')
                                            ->where('detil_transaksi.id_transaksi', '=', $id)
                                            ->get();
        return response()->json($data);                        
    }

    public function getTotal($id)
    {
        $total = detil_transaksi::where('id_transaksi', $id)->sum('subtotal');
        
        return response()->json([
            'total' => $total
        ]);
    }
}
// return $this->response->successResponseData('Berhasil tambah detail transaksi', $data);