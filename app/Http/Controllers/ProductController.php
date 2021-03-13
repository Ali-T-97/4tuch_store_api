<?php

namespace App\Http\Controllers;
use Illuminate\Validation;
use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function create(Request $request){
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'price' => 'required',
            'dec' => 'nullable',
            'image'=>'required',
            'catg'=>'required'
        ]);
        $result = $result=$request->file('file') ? $request->file('file')->store('public/productImage') : null;
        $product = new product();
        $product->title = $request->title;
        $product->price = $request->price;
        $product->dec = $request->dec;
        $product->catg = $request->catg;
        $product->image = $result;
        $re=$product->save();
        if($re){
            return response()->json(['save']);
        }
        {
            return response()->json(['filed']);
        }
    }
    public function update(Request $request , $id){
        $request->validate( [
            'title' => 'nullable',
            'price' => 'nullable',
            'dec' => 'nullable',
            'image'=>'nullable',
            'catg'=>'nullable'
        ]);

        $res=product::find($id)->update([
            'title' => $request->get('title'),
            'price' => $request->get('price'),
            'dec' => $request->get('dec'),
            'catg' => $request->get('catg'),

        ]);
        if ($res){
            return response()->json(['updated']);
        }
        {
            return response()->json(['filed']);
        }

    }
    public function delete($id){

        $ship=product::find($id);
        $res=$ship->delete();
        if ($res){
            return response()->json(['delete']);
        }
        {
            return response()->json(['filed']);
        }
    }
    public function index(){
        return product::all();
    }

}
