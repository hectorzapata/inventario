<?php

use Illuminate\Support\Facades\Route;

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

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
  setlocale(LC_TIME, 'es_ES');
  $fecha = \Carbon\Carbon::now();
  $data['fecha'] = ucwords($fecha->formatLocalized('%d %B %Y'));
  $data['usuarios'] = \App\User::count();
  $data['equipo'] = \Modules\EquipoMedico\Entities\EquipoMedico::where('activo', 1)->count();
  return view('dashboard')->with($data);
})->name('dashboard');
