<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CategoryTypeController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ItemUnitController;
use App\Http\Controllers\StatusTypeController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserTypeController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\VerifyToken;
use App\Models\CategoryType;

/**
 * The example api
 */

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


Route::prefix('auth')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
});


// Route::apiResource('user_types', UserTypeController::class);


// Route::group(['middleware'=>['auth:api',VerifyToken::class]], function(){
//     Route::prefix('auth')->group(function(){
//         Route::post('/refresh',[AuthController::class,'refresh']);
//         Route::get('/profile',[AuthController::class,'profile']);
//     });
// });

Route::group(['middleware' => [VerifyToken::class]], function () {
    Route::prefix('auth')->group(function () {
        Route::get('/refresh', [AuthController::class, 'respondWithNewTokens']);
        Route::get('/profile', [AuthController::class, 'profile']);
    });
    Route::apiResource('user_types', UserTypeController::class);
    Route::apiResource('status_types', StatusTypeController::class);

    // This is the parent model which will have the issues category types like Technical Issues
    Route::apiResource('categories', CategoryController::class);
    // This is the sub parent model which will have the issues which will be the child Model
    Route::apiResource('category_types', CategoryTypeController::class);

    // Tasks Controller is used to control tasks
    Route::apiResource('tasks', TaskController::class);


    // Store Items
    Route::apiResource('items', ItemController::class);

    // Store Item units
    Route::apiResource('item_units', ItemUnitController::class);
});
