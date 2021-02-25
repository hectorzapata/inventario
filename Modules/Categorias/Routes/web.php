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

Route::prefix('categorias')->group(function() {
  Route::get('/', 'CategoriasController@index');
  Route::get('/create', 'CategoriasController@create');
  Route::post('/', 'CategoriasController@store');
  Route::get('/tabla', 'CategoriasController@tabla');
  Route::get('/{id}/edit', 'CategoriasController@edit');
  Route::put('/{id}', 'CategoriasController@update');
});
