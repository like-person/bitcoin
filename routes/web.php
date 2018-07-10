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

Route::get('bitcoinStat', 'BitcoinsController@stat');
Route::get('bitcoins', 'BitcoinsController@bitcoins');
Route::get('bitcoinStatOne', 'BitcoinsController@statone');
Route::get('bitcoinStatOne/{symbol}', 'BitcoinsController@statone')->where('symbol', '[A-Za-z ]+');;
