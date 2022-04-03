<?php

namespace App\Http\Controllers;
use App\Models\detil_transaksi;
use App\Models\paket;
use App\Models\member;
use App\Models\transaksi;
use App\Helpers\ResponseHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use PDF;
use Illuminate\Pagination\Paginator;

class DetailTransaksiController extends Controller
{
    public function tampil($id)
    {
        $transaksi = DB::table('transaksis') ->select('*')->where('id_transaksi',$id)->first();
        $member = DB::table('members')->where('id_member',$transaksi->id_member)->get();
        $paket = DB::table('pakets')->where('id_paket',$transaksi->id_paket)->get();
        $detail = DB::table('detil_transaksis')->where('id_transaksi',$id)->get();
                            
        return view('detail', compact('transaksi','member','paket','detail'));
        
    }

    public function export($id){
        $transaksi = DB::table('transaksis') ->select('*')->where('id_transaksi',$id)->first();
        $member = DB::table('members')->where('id_member',$transaksi->id_member)->get();
        $paket = DB::table('pakets')->where('id_paket',$transaksi->id_paket)->get();
        $detail = DB::table('detil_transaksis')->where('id_transaksi',$id)->get();
        //mengambil data dan tampilan dari halaman laporan_pdf
        //data di bawah ini bisa kalian ganti nantinya dengan data dari database
        
        $data = PDF::loadview('laporan_pdf',compact('transaksi','member','paket','detail'));
        // $data = PDF::loadview('laporan_pdf',compact('transaksi','outlet','member','paket','detail'));
        //mendownload laporan.pdf
    	return $data->download('laporan.pdf');
    }

    public function tunjuk(){
        $detail = DB::table('detail_transaksis')->join('transaksis','transaksis.id_transaksi', '=', 'detail_transaksis.id_transaksi')
                                               ->join('pakets','pakets.id_paket', '=', 'detail_transaksis.id_paket')->paginate(5);
        Paginator::useBootstrap();
        return view('detail-transaksi', compact('detail'));
    }

    //tampil tambah
    public function tambah(){
        $transaksi = transaksi::all();
        $paket = paket::all();
        return view('detail-tambah', compact('transaksi','paket'));
    }
}