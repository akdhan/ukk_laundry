<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\transaksi;
use App\Models\detil_transaksi;
use Carbon\Carbon;
use JWTAuth;

class TransaksiController extends Controller
{
    public $user;

    public function __construct()
    {
        $this->user = JWTAuth::parseToken()->authenticate();
    }
    
    //tambah
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_member' => 'required',
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors());
        }

        $transaksi = new transaksi();
        $transaksi->id_member = $request->id_member;
        $transaksi->tgl = Carbon::now();
        $transaksi->batas_waktu = Carbon::now()->addDays(3);
        $transaksi->status = 'baru';
        $transaksi->dibayar = 'belum_bayar';
        $transaksi->id_user = $this->user->id;

        $transaksi->save();

        $data = transaksi::where('id_transaksi', '=', $transaksi->id)->first();

        return response()->json(['message' => 'Data transaksi berhasil ditambahkan', 'data' => $data]);}

    public function getAll()
    {
        $data = DB::table('transaksis')->join('members', 'transaksis.id_member', '=', 'members.id_member')
                    ->select('transaksis.*', 'members.nama_member')
                    ->get();
                    
        return response()->json(['success' => true, 'data' => $data]);
    }
}
