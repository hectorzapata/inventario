<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['middleware' => 'auth:api_key', 'namespace' => '\App\Http\Controllers'], function(){
  Route::get('sliderPrincipal', 'ApiController@sliderPrincipal');
  Route::get('sliderCategorias', 'ApiController@sliderCategorias');
  Route::get('productosPrincipal', 'ApiController@productosPrincipal');
});
