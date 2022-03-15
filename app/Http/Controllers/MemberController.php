<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\member;
use DB;
use Illuminate\Support\Facades\Validator;

class MemberController extends Controller
{
    public function index()
    {
        // $index = member::all();
        // return Response()->json($index);
        return view('member');
    }

    public function create()
    {
        //
    }

    public function store(Request $req)
    {
        $v = Validator::make($req->all(),[
            // 'id_member'=>'required',
            'nama_member'=>'required',
            'alamat'=>'required',
            'jenis_kelamin'=>'required',
            'tlp'=>'required|min:10',
        ]);
        if ($v->fails()){
            return Response()->json($v->errors());
        }
        $sv = member::create([
            'id_member'=>$req->id_member,
            'nama_member'=>$req->nama_member,
            'alamat'=>$req->alamat,
            'jenis_kelamin'=>$req->jenis_kelamin,
            'tlp'=>$req->tlp,
        ]);
        if ($sv) {
            return Response()->json(['status'=>'Berhasil']);
        }else{
            return Response()->json(['status'=>'Gagal']);
        }
    }

    public function show()
    {
        $show = member::get();
        return Response()->json($show);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $req, $id)
    {
        $v = Validator::make($req->all(),[
            'id_member'=>'required|max:255',
            'nama_member'=>'required',
            'alamat'=>'required',
            'jenis_kelamin'=>'required',
            'tlp'=>'required',
        ]);
        if ($v->fails()) {
            $data['status']=false;
            $data['message']=$v->errors();
            return Response()->json($data);
        }
        $sv = member::where('id_member',$id)->update([
            'id_member'=>$req->id_member,
            'nama_member'=>$req->nama_member,
            'alamat'=>$req->alamat,
            'jenis_kelamin'=>$req->jenis_kelamin,
            'tlp'=>$req->tlp,
        ]);
        if ($sv) {
            return Response()->json(['status'=>'Berhasil']);
        }else{
            return Response()->json(['status'=>'Gagal']);
        }
    }

    public function destroy($id)
    {
        $del = member::where('id_member', $id)->delete();
        if($del) {
            return Response()->json(['status'=>'Berhasil']);
        }else{
            return Response()->json(['status'=>'Gagal']);
        }
    }
    public function jmlh(){
        $count=DB::table('members')->count();

        return view('index', compact('count'));
    }
}
