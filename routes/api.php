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
    Route::post('logout',[\App\Http\Controllers\authController::class,'logout']);
    //stagiaire routes
    Route::get('stagiaires',[\App\Http\Controllers\StagiaireController::class,'index']);
    Route::get('stagiaires/{id}',[\App\Http\Controllers\StagiaireController::class,'show']);
    Route::post('stagiaires',[\App\Http\Controllers\StagiaireController::class,'store']);
    Route::put('stagiares/{id}',[\App\Http\Controllers\StagiaireController::class,'update']);
    Route::delete('stagiaires/{id}',[\App\Http\Controllers\StagiaireController::class,'destroy']);
    //groupe routes
    Route::get('groupes',[\App\Http\Controllers\GroupeController::class,'index']);
    Route::get('groupes/{id}',[\App\Http\Controllers\GroupeController::class,'show']);
    Route::post('groupes',[\App\Http\Controllers\GroupeController::class,'store']);
    Route::put('groupes/{id}',[\App\Http\Controllers\GroupeController::class,'update']);
    Route::delete('groupes/{id}',[\App\Http\Controllers\GroupeController::class,'destroy']);
});
