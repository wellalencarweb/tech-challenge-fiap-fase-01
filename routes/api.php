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


/**
 * @uses CreateClientController
 */
Route::post('v1/clients', 'App\Http\Controllers\CreateClientController');
//Route::get('user/{id}', 'GetUserController');
//Route::put('user/{id}', 'UpdateUserController');
//Route::delete('user/{id}', 'DeleteUserController');

//Route::get('client/{id}', 'GetClientController');
//Route::post('client', 'CreateClientController');
//Route::put('client/{id}', 'UpdateClientController');
//Route::delete('client/{id}', 'DeleteClientController');
