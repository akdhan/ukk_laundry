<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\outlet;
use DB;
use Illuminate\Support\Facades\Validator;

class OutletController extends Controller
{
    public function index()
    {
        $index = outlet::get();
        return Response()->json($index);
    }

    public function create()
    {
        //
    }

    public function store(Request $req)
    {
        $v = Validator::make($req->all(),[
            // 'id_outlet'=>'required',
            'alamat'=>'required',
            'telp'=>'required|min:10',
        ]);
        if ($v->fails()){
            return Response()->json($v->errors());
        }
        $sv = outlet::create([
            'id_outlet'=>$req->id_outlet,
            'alamat'=>$req->alamat,
            'telp'=>$req->telp,
        ]);
        return redirect('/outlet');
        // if ($sv) {
        //     return Response()->json(['status'=>'Berhasil']);
        // }else{
        //     return Response()->json(['status'=>'Gagal']);
        // }
    }

    public function show()
    {
        $show = outlet::all();
        return view('outlet', ['outlet' => $show]);
    }

    public function edit($id)
    {
        $outlet1 = DB::table('outlets')->where('id_outlet',$id)->first();
    
        return view ('edit_outlet', ['editoutlet' => $outlet1]);
    }

    public function update(Request $req, $id)
    {
        $v = Validator::make($req->all(),[
            'id_outlet'=>'required|max:255',
            'alamat'=>'required',
            'telp'=>'required',
        ]);
        // if ($v->fails()) {
        //     $data['status']=false;
        //     $data['message']=$v->errors();
        //     return Response()->json($data);
        // }
        $sv = outlet::where('id_outlet',$id)->update([
            'id_outlet'=>$req->id_outlet,
            'alamat'=>$req->alamat,
            'telp'=>$req->telp,
        ]);
        return redirect('/outlet');
        // if ($sv) {
        //     return Response()->json(['status'=>'Berhasil']);
        // }else{
        //     return Response()->json(['status'=>'Gagal']);
        // }
    }

    public function destroy($id)
    {
        $del = outlet::where('id_outlet', $id)->delete();
        return redirect('/outlet');
    //     if($del) {
    //         return Response()->json(['status'=>'Berhasil']);
    //     }else{
    //         return Response()->json(['status'=>'Gagal']);
    //     }
     }
}
