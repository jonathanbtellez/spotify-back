<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\image\imageController;
use App\Http\Controllers\Playlist\PlaylistController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return response()->json(['user'=> $request->user()], 201);
});

Route::group(['prefix' => 'playlist', 'controller' => PlaylistController::class, 'middleware' => 'auth:sanctum'], function() {
    Route::get('/', 'index');
    Route::get('/{playlist}', 'show');

});

Route::post('/login', [AuthController::class,'login'])->name('login');
Route::post('/register', [AuthController::class,'register']);