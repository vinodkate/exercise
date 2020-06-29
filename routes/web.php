<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Resource route for Router
Route::resource('router', 'RouterController');

// Get router for shape
Route::get('shape', 'ShapeController@shape')->name('shape');

// Get router for shape
Route::get('exercise2', 'ShapeController@exercise2')->name('exercise2');