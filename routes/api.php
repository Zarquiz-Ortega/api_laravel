<?php

use App\Http\Controllers\Api\BlogController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\LogoutController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('register', [UserController::class, 'register']);
Route::post('login', LoginController::class);


Route::middleware('auth:sanctum')->group(function () {
    // rutas aut
    Route::get('user/profile', [UserController::class, 'userProfile']);
    Route::get('logout', LogoutController::class);

    //rutas blog
    Route::get('blogs/', [BlogController::class, 'index']);
    Route::post('blog/create', [BlogController::class, 'store']);
    Route::get('blog/{blog}', [BlogController::class, 'show']);
    Route::put('blog/{blog}', [BlogController::class, 'update']);
    Route::delete('blog/{blog}', [BlogController::class, 'destroy']);
});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
