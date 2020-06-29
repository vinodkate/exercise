<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::prefix('router')->namespace('API')->middleware(['throttle:60,1', 'auth:api'])->group(function() {
    Route::post('store', 'RouterApiController@store');
    Route::get('list', 'RouterApiController@index');
    Route::put('update/{loopback}', 'RouterApiController@update');
    Route::get('details/{sapid}', 'RouterApiController@show');
    Route::get('list/type', 'RouterApiController@indexList');
    Route::delete('delete/{loopback}', 'RouterApiController@destroy');
});

Route::prefix('router')->namespace('API')->middleware(['throttle:60,1'])->group(function() {
    Route::post('login', 'AuthApiController@login');
});


