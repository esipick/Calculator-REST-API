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

Route::get('add/{slugNum?}', 'CalculateController@add')->where('slugNum', '(.*)');
Route::get('subtract/{slugNum?}', 'CalculateController@subtract')->where('slugNum', '(.*)');
Route::get('multiply/{slugNum?}', 'CalculateController@multiply')->where('slugNum', '(.*)');
Route::get('divide/{slugNum?}', 'CalculateController@divide')->where('slugNum', '(.*)');

