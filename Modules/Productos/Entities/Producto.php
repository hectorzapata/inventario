<?php

namespace Modules\Productos\Entities;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model{
  protected $table = "productos";
  protected $fillable = [
    "nombre",
    "descripcion",
    "imagen",
    "idCategoria",
    "precio",
    "pesoPromedio",
    "activo"
  ];
  public function Categoria(){
    return $this->hasOne('\Modules\Categorias\Entities\Categoria', 'id', 'idCategoria');
  }
}
