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

Route::prefix('productos')->group(function() {
  Route::get('/', 'ProductosController@index');
  Route::get('/create', 'ProductosController@create');
  Route::post('/', 'ProductosController@store');
  Route::get('/tabla', 'ProductosController@tabla');
  Route::get('/{id}/edit', 'ProductosController@edit');
  Route::put('/{id}', 'ProductosController@update');
});
