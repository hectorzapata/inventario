<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use \Modules\Principales\Entities\Principal;
use \Modules\Categorias\Entities\Categoria;
use \Modules\Productos\Entities\Producto;

class ApiController extends Controller{
  public function sliderPrincipal(){
    $principales = Principal::with(['Producto.Categoria'])->where('activo', 1)->get();
    return response()->json($principales);
  }
  public function sliderCategorias(){
    $categorias = Categoria::with('Productos')->where('activo', 1)->get();
    return response()->json($categorias);
  }
  public function productosPrincipal(){
    $productos = Producto::inRandomOrder()->take(5)->get();
    return response()->json($productos);
  }
}
