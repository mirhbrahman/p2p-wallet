<?php

use App\Http\Controllers\V1\Auth\AuthController;
use App\Http\Controllers\V1\User\UsersController;
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

// Routes for API-v1
Route::prefix('v1')->group(function (){
    // PUBLIC ROUTES
    // Routes for authenticate
    Route::prefix('auth')->group(function(){
        Route::post('login', [AuthController::class, 'login']);
    });

    // PRIVATE ROUTES
    Route::middleware('auth:sanctum')->group(function () {
        // User module
        Route::prefix('users')->group(function(){
            Route::post('/list', [UsersController::class, 'list']);
        });
    });

});


