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
use Illuminate\Support\Facades\Auth;

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
            'id_member' => 'required|string',
            'id_paket'=>'required',
            'qty'=>'required|integer',
            'tgl'=>'',
            'batas_waktu'=>'',
            'status'=>'required',
            'dibayar'=>'required',
            // 'id_user'=>'required',
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors());
        }

        $transaksi = transaksi::create([
            'id_member'=>$request->get('id_member'),
            'id_paket'=>$request->get('id_paket'),
            'qty'=>$request->get('qty'),
            'tgl'=>$request->date('tgl'),
            'batas_waktu'=>$request->date('batas_waktu'),
            'status'=>$request->get('status'),
            'dibayar'=>$request->get('dibayar'),
            'id_user'=>Auth()->user()->id,
            ]);

            $id = $request->get('id_paket');
            $paket = paket::select('pakets.*')->where('id_paket', $id)->first();
            // $transaksi = transaksi::where('id_transaksi', '=', $transaksi->id_transaksi)->first();

            $detail = detil_transaksi::create([
                'id_transaksi'=> $transaksi->id,
                'id_paket'=> $paket->id_paket,
                'qty'=> $transaksi->qty * $paket->harga,
        ]);
        // return redirect()->route('index')->with('message-simpan','Data berhasil disimpan!');
        return redirect('/index');
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
        $member = member::all();
        $paket = paket::all();
        return view('tambah_transaksi', compact('member', 'paket'));
    }
        //tampil edit data
        public function edit($id){
        
            $transaksi = DB::table('transaksis')->select('*')->where('id_transaksi', $id)->first();
            $paket = DB::table('pakets')->select('id_paket','jenis')->get();
            $member = DB::table('members')->select('id_member','nama_member')->get();
            return view('edit_transaksi', compact('transaksi','member','paket'));
    
        }

    //update data
    public function update(Request $request, $id){
        $validator = $request->validate([
            'id_member' => 'required|string',
            'id_paket'=>'required',
            'tgl'=>'',
            'batas_waktu'=>'',
            'status'=>'required',
            'dibayar'=>'required',
        ]);
        $transaksi = transaksi::where('id_transaksi',$id)->update([
            'id_member'=>$request->get('id_member'),
            'id_paket'=>$request->get('id_paket'),
            'tgl'=>$request->get('tgl'),
            'batas_waktu'=>$request->get('batas_waktu'),
            'status'=>$request->get('status'),
            'dibayar'=>$request->get('dibayar'),
        ]);
        return redirect('/index');
    }

    public function destroy($id)
    {
        $detail = detil_transaksi::where('id_transaksi',$id)->delete();
        $del = transaksi::where('id_transaksi', $id)->delete();
        return redirect('/index');
    //     if($del) {
    //         return Response()->json(['status'=>'Berhasil']);
    //     }else{
    //         return Response()->json(['status'=>'Gagal']);
    //     }
     }
}
