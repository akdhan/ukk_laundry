<?php

namespace App\Http\Controllers;

use App\Models\paket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use JWTAuth;

class ProdukController extends Controller
{
    public function index()
    {
        $index = paket::get();
        return Response()->json($index);
    }

    public function create()
    {
        //
    }

    public function store(Request $req)
    {
        $v = Validator::make($req->all(),[
            // 'id_paket'=>'required',
            'jenis'=>'required',
            'harga'=>'required|numeric',
        ]);
        if ($v->fails()){
            return Response()->json($v->errors());
        }
        $sv = paket::create([
            'id_paket'=>$req->id_paket,
            'jenis'=>$req->jenis,
            'harga'=>$req->harga,
        ]);
        if ($sv) {
            return Response()->json(['status'=>'Berhasil']);
        }else{
            return Response()->json(['status'=>'Gagal']);
        }
    }

    public function show()
    {
        $show = paket::get();
        return Response()->json($show);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $req, $id)
    {
        $v = Validator::make($req->all(),[
            'id_paket'=>'required|max:255',
            'jenis'=>'required',
            'harga'=>'required',
        ]);
        if ($v->fails()) {
            $data['status']=false;
            $data['message']=$v->errors();
            return Response()->json($data);
        }
        $sv = paket::where('id_paket',$id)->update([
            'id_paket'=>$req->id_paket,
            'jenis'=>$req->jenis,
            'harga'=>$req->harga,
        ]);
        if ($sv) {
            return Response()->json(['status'=>'Berhasil']);
        }else{
            return Response()->json(['status'=>'Gagal']);
        }
    }

    public function destroy($id)
    {
        $del = paket::where('id_paket', $id)->delete();
        if($del) {
            return Response()->json(['status'=>'Berhasil']);
        }else{
            return Response()->json(['status'=>'Gagal']);
        }
    }
}
