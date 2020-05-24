<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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
Auth::routes();

Route::get('/', function () {
    return redirect('storage');
});
Route::get('storage', 'StorageController@index');
Route::get('storage/create', 'StorageController@create');
Route::get('storage/storing', 'StorageController@showStoring');
Route::post('storage/storing', 'StorageController@store');
Route::post('storage/leaving/{product_no}', 'StorageController@postLeaving');
Route::post('storage/storing/commit', 'StorageController@postStoring');

