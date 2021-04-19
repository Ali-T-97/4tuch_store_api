<?php

namespace App\Http\Controllers;

use App\Http\Resources\userResurce;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class authntication extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'role'=>'nullable',
            'address'=>'nullable'
        ]);
        if ($validator->fails()) {
            return response()->json(['status_code' => 401, 'message' => 'validator error']);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'address'=>$request->address,
            'role'=>$request->role,

        ]);
        $user->save();
        return response()->json(['status_code' => 200, 'message' => 'Register complete']);
    }
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['status_code' => 401, 'message' => 'request error']);
        }
        $credenils = request(['email', 'password']);
        if (!Auth::attempt($credenils)) {
            return response()->json(['status_code' => 401, 'message' => 'request error']);
        }
        $user = Auth::user()::where('email', $request->email)->first();
        $tokenresulat = $user->createToken('authtoken')->plainTextToken;
        return response()->json([
            'status_code' => 200,
            'suer'=> $user,
            'token' => $tokenresulat

        ]);
    }

    public function logout (Request $request){
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'status_code' => 200,
            'message' => 'token was delete'
        ]);
    }
    public function show($id){
        $user=User::find($id);
        return new userResurce($user);
    }
    public function index(){
        return User::all();
    }
    public function updateRole($id ,Request $request ){
        $validator = Validator::make($request->all(), [
            'role' => 'nullable',
        ]);
        $res=User::find($id)->update([
            'role' => $request->get('role'),

        ]);
        if ($res){
            return response()->json(['save']);
        }
        {
            return response()->json(['filed']);
        }
    }
}
