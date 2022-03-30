<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\outlet;
use App\Models\member;
use App\Models\paket;
use App\Models\transaksi;
use App\Models\User;
use App\Models\detil_transaksi;
use Carbon\Carbon;
use JWTAuth;
use Auth;

class TransaksiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
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

        $user = User::where('id', Auth::user()->id)->first();

        $transaksi = transaksi::create([
            'id_member'=>$request->get('id_member'),
            'id_paket'=>$request->get('id_paket'),
            'qty'=>$request->get('qty'),
            'tgl'=>$request->date('Y-m-d'),
            'batas_waktu'=>date('Y-m-d', strtotime('+3 days', strtotime(date("Y-m-d")))),
            'status'=>$request->get('status'),
            'dibayar'=>$request->get('dibayar'),
            'id_user'=>$user,
            ]);
            $id = $request->get('id_paket');
            $paket = paket::all()->find($id);

        $data = transaksi::where('id_transaksi', '=', $transaksi->id)->first();

        return redirect()->route('index')->with('message-simpan','Data berhasil disimpan!');
    }

    public function getAll()
    {

        $transaksi = DB::table('transaksis') ->select('transaksis.id_transaksi as id_transaksi','transaksis.*','members.*','pakets.*')
                                            // ->join('outlets','outlets.id_outlet', '=', 'transaksis.id_outlet')
                                            ->join('pakets','pakets.id_paket', '=', 'transaksis.id_paket')
                                            ->join('members','members.id_member', '=', 'transaksis.id_member')->paginate(5);
        return view('transaksi', compact('transaksi'));
    }

    //tampil tambah data transaksi
    public function tambah(){
        $outlet = outlet::all();
        $member = member::all();
        $paket = paket::all();
        return view('tambah_transaksi', compact('outlet', 'member', 'paket'));
    }
    
}
