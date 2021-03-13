<?php

namespace App\Http\Controllers;

use App\Http\Resources\orderResource;
use App\Models\order;
use App\Models\product;
use App\Models\User;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function create(Request $request){
        $validator = Validator($request->all(), [
            'User_id' => 'nullbal',
            'adddres' => 'required',
            'count'=>'required',
            'phone'=>'required',
        ]);

        $product = new order();
        $product->adddres = $request->adddres;
        $product->count = $request->count;
        $product->phone = $request->phone;
        $product->User_id =$request->User_id;


        $re=$product->save();
        if($re){
            return response()->json(['save']);
        }
        {
            return response()->json(['filed']);
        }
    }
    public function index(){
        return product::all();
    }
    public function show($id){
        $user=User::find($id);
        $ord=$user->order;
        return new orderResource($ord);
    }
}
