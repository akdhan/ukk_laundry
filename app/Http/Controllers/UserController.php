<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\member;
use App\Models\transaksi;
use Illuminate\Support\Facades\Hash;
use JWTAuth;
use Auth;
use Tymon\JWTAuth\Exceptions\JWTException;
use DB;
use Illuminate\Pagination\Paginator;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name'=>'required|string|max:255',
            'email'=>'required|string|email|max:255|unique:users',
            'password'=>'required|string|min:6',
            'type'=>'required'
        ]);
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        $user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
            'type' => $request->get('type'),
        ]);

        // $token = JWTAuth::fromUser($user);

        return redirect('/index')->with('message-simpan', 'Berhasil Membuat Akun');
    }
    
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect('/index')->with('message', 'Berhasil Login');
        }

        return redirect('/')->with('alert', 'Email atau password salah!');
    } 
    
    public function getAuthenticatedUser()
    {
        try {
            if (! $user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }
        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            return response()->json(['token_expired'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return response()->json(['token_invalid'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {
            return response()->json(['token_absent'], $e->getStatusCode());
        }
        return response()->json(compact('user'));
    }

    public function loginCheck(){
		try {
			if(!$user = JWTAuth::parseToken()->authenticate()){
				return $this->response->errorResponse('Invalid token!');
			}
		} catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e){
			return response()->json([
                'success' => false,
                'message' => 'Token Expired.',
            ]);
		} catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e){
			return response()->json([
                'success' => false,
                'message' => 'Token invalid.',
            ]);
		} catch (Tymon\JWTAuth\Exceptions\JWTException $e){
			return response()->json([
                'success' => false,
                'message' => 'Authorization token not found.',
            ]);
		}

        return response()->json([
            'success' => true,
            'message' => 'Authentication success',
            'data' => $user
        ]);

	}

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/');
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
			'id_outlet' => 'required|numeric',
			'nama' => 'required|string|max:255',
			'type' => 'required|string',
		]);

		if($validator->fails()){
            return response()->json([
                'success' => false,
                'message' => $validator->errors(),
            ]);
		}

		$user = User::where('id', $id)->first();
		$user->id_outlet= $request->id_outlet;
		$user->nama 	= $request->nama;
		$user->username = $request->username;
		$user->type 	= $request->type;
        if($request->password != NULL){
            $user->password = Hash::make($request->password);
        }
		
		$user->save();

        return response()->json([
            'success' => true,
            'message' => 'Data user berhasil diubah!.'
        ]);
    }

    public function delete($id)
    {
        $delete = User::where('id', $id)->delete();

        if($delete){
            return response()->json([
                'success' => true,
                'message' => 'Data user berhasil dihapus!.'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Data user gagal dihapus!.'
            ]);
        }
    }

    public function getAll()
    {
        $data["count"] = User::count();
        $data['user'] = User::with('outlet')->get();
        
        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }

    public function getById($id)
    {   
        $data["user"] = User::where('id', $id)->get();

        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }
    public function halamanlogin()
    {
        return view ('login');
    }

    public function show()
    {
        $owner = User::where('type', 'Owner')->count();
        $kasir = User::where('type', 'Kasir')->count();
        $member = member::count();

        $transaksi = DB::table('transaksis') ->select('transaksis.id_transaksi as id_transaksi','transaksis.*','members.*','pakets.*','users.*')
                                            // ->join('outlets','outlets.id_outlet', '=', 'transaksis.id_outlet')
                                            ->join('pakets','pakets.id_paket', '=', 'transaksis.id_paket')
                                            ->join('users','users.id', '=', 'transaksis.id_user')
                                            ->join('members','members.id_member', '=', 'transaksis.id_member')->paginate(5);

        return view('index', compact('owner', 'kasir', 'member', 'transaksi'));

    }

    public function tampil(){
        $data = DB::table('users')->paginate(5);
        Paginator::useBootstrap();
        return view('profile',['user' => $data]);
        
    }
}
