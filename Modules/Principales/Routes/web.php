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

Route::prefix('principales')->group(function() {
  Route::get('/', 'PrincipalesController@index');
  Route::get('/create', 'PrincipalesController@create');
  Route::post('/', 'PrincipalesController@store');
  Route::get('/tabla', 'PrincipalesController@tabla');
  Route::get('/{id}/edit', 'PrincipalesController@edit');
  Route::put('/{id}', 'PrincipalesController@update');
});
