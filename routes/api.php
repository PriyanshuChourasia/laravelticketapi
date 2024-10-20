<?php

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/**
 * The example api
 */

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


Route::prefix('auth')->group(function(){
    Route::get('/login',[AuthController::class,'login']);
});



Route::group(['middleware'=>'api','prefix'=>'auth'], function(){
    Route::post('/register',[AuthController::class,'register']);
    // Route::post('/login',[AuthController::class,'login']);
    Route::post('/refresh',[AuthController::class,'refresh']);
    Route::post('/me',[AuthController::class,'me']);
});
