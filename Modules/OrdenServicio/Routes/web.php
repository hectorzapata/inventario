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

Route::prefix('ordenservicio')->middleware('auth')->group(function() {
  Route::get('/', 'OrdenServicioController@index');
  Route::get('/create', 'OrdenServicioController@create');
  Route::post('/', 'OrdenServicioController@store');
  Route::get('/tabla', 'OrdenServicioController@tabla');
  Route::get('/{id}/edit', 'OrdenServicioController@edit');
  Route::put('/{id}', 'OrdenServicioController@update');
  Route::get('/{id}/qr', 'OrdenServicioController@qr');
});
