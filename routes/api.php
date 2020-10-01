<?php

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

Route::post('login',[\App\Http\Controllers\authController::class,'login']);
Route::post('register',[\App\Http\Controllers\authController::class,'register']);

Route::group(['middleware'=>'auth.jwt'],function (){
    Route::get('logout',[\App\Http\Controllers\authController::class,'logout']);
    //stagiaire routes
    Route::get('stagiaires',[]);
    Route::get('stagiaires/{id}',[]);
    Route::post('stagiaires',[]);
    Route::put('stagiares/{id}',[]);
    Route::delete('stagiaires/{id}',[]);
    //groupe routes
    Route::get('groupes',[]);
    Route::get('groupes/{id}',[]);
    Route::post('groupes',[]);
    Route::put('groupes/{id}',[]);
    Route::delete('groupes/{id}',[]);
});
