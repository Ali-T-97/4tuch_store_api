<?php

use App\Http\Controllers\authntication;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
   //user
Route::post('/register',[authntication::class,'register']);
Route::post('/login',[authntication::class,'login']);
Route::post('/create_product',[ProductController::class,'create']);
Route::put('/update_product/{id}',[ProductController::class,'update']);
Route::delete('/delete_product/{id}',[ProductController::class,'delete']);
Route::get('/index',[ProductController::class,'index']);

Route::post('/create_order',[OrderController::class,'create']);
Route::get('/show_order/{id}',[OrderController::class,'show']);
Route::get('index/{id}',[OrderController::class,'index']);


Route::group(['middleware'=>['auth:sanctum']],function () {
    //user and admin
Route::post('/logout', [authntication::class, 'logout']);
Route::get('/index', [authntication::class, 'index']);
Route::get('/show/{id}', [authntication::class, 'show']);
Route::get('/updateRole/{id}', [authntication::class, 'updateRole']);
});
