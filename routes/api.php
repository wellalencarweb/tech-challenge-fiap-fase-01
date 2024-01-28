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

Route::prefix('v1')->namespace('App\Http\Controllers\Client')->group(function () {
    Route::prefix('clients')->group(function () {
        /**
         * @uses CreateClientController
         */
        Route::post('', 'CreateClientController');

        /**
         * @uses GetClientController
         */
        Route::get('{id}', 'GetClientController');

        /**
         * @uses GetClientByCriteriaController
         */
        Route::get('', 'GetClientByCriteriaController');

        /**
         * @uses UpdateClientController
         */
        Route::put('{id}', 'UpdateClientController');

        /**
         * @uses DeleteClientController
         */
        Route::delete('{id}', 'DeleteClientController');
    });
});





