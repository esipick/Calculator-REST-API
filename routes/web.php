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

Route::get('add/{a}/{b}/{c}', 'CalculateController@add');
Route::get('subtract/{a}/{b}/{c}', 'CalculateController@subtract');
Route::get('multiply/{a}/{b}/{c}', 'CalculateController@multiply');
Route::get('divide/{a}/{b}/{c}', 'CalculateController@divide');

