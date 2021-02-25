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

Route::prefix('usuarios')->group(function() {
  Route::get('/', 'UsuariosController@index');
  Route::get('/create', 'UsuariosController@create');
  Route::post('/', 'UsuariosController@store');
  Route::get('/tabla', 'UsuariosController@tabla');
  Route::get('/{id}/edit', 'UsuariosController@edit');
  Route::put('/{id}', 'UsuariosController@update');
});
