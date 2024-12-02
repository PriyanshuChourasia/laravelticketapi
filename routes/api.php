<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\UserTypeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\VerifyToken;
use App\Http\Middleware\AuthenticateUser;

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


Route::apiResource('user_types',UserTypeController::class);


// Route::group(['middleware'=>['auth:api',VerifyToken::class]], function(){
//     Route::prefix('auth')->group(function(){
//         Route::post('/refresh',[AuthController::class,'refresh']);
//         Route::get('/profile',[AuthController::class,'profile']);
//     });
// });
Route::group(['middleware'=>[VerifyToken::class]], function(){
    Route::prefix('auth')->group(function(){
        Route::post('/refresh',[AuthController::class,'refresh']);
        Route::get('/profile',[AuthController::class,'profile']);
    });


});
