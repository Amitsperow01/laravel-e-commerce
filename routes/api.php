<?php

use App\Http\Controllers\Api\UsersController;
use App\Models\User;
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

Route::group(['prefix' => 'v1', 'middleware' => 'auth:sanctum'], function(){
    Route::resource('users', UsersController::class);
});


Route::get('get-token', function() {
    $user = User::find(6);
    $token = $user->createToken('auth:sanctum');
    return $token->plainTextToken;
});



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
