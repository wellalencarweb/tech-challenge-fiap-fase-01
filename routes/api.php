<?php

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
    return $request->user();
});

Route::get('/test', function () {
    $teste = "UP";
    $a = $teste;
    return $a;
});

/**
 * @uses CreateUserController
 */
Route::post('user', 'App\Http\Controllers\CreateUserController');
//Route::get('user/{id}', 'GetUserController');
//Route::put('user/{id}', 'UpdateUserController');
//Route::delete('user/{id}', 'DeleteUserController');

//Route::get('client/{id}', 'GetClientController');
//Route::post('client', 'CreateClientController');
//Route::put('client/{id}', 'UpdateClientController');
//Route::delete('client/{id}', 'DeleteClientController');
