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

Route::prefix('equipomedico')->group(function() {
  Route::get('/', 'EquipoMedicoController@index');
  Route::get('/create', 'EquipoMedicoController@create');
  Route::post('/', 'EquipoMedicoController@store');
  Route::get('/tabla', 'EquipoMedicoController@tabla');
  Route::get('/{id}/edit', 'EquipoMedicoController@edit');
  Route::put('/{id}', 'EquipoMedicoController@update');
  Route::get('/{id}/qr', 'EquipoMedicoController@qr');
});
