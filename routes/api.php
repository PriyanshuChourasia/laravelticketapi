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
    Route::post('/login',[AuthController::class,'login']);
    Route::post('/register',[AuthController::class,'register']);
});



Route::group(['middleware'=>'auth:api'], function(){
    // Route::post('/register',[AuthController::class,'register']);
    // Route::post('/login',[AuthController::class,'login']);
    Route::prefix('auth')->group(function(){
        Route::post('/refresh',[AuthController::class,'refresh']);
        Route::get('/profile',[AuthController::class,'profile']);
    });

});
