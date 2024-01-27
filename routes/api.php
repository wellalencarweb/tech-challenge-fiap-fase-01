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

/**
 * @uses GetClientController
 */
Route::get('v1/clients/{id}', 'App\Http\Controllers\GetClientController');

/**
 * @uses GetClientByCriteriaController
 */
Route::get('v1/clients', 'App\Http\Controllers\GetClientByCriteriaController');

/**
 * @uses UpdateClientController
 */
Route::put('v1/clients/{id}', 'App\Http\Controllers\UpdateClientController');

/**
 * @uses DeleteClientController
 */
Route::delete('v1/clients/{id}', 'App\Http\Controllers\DeleteClientController');

