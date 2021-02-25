<?php

namespace Modules\Principales\Entities;

use Illuminate\Database\Eloquent\Model;

class Principal extends Model{
  protected $table = "principales";
  protected $fillable = [
    "nombre",
    "imagen",
    "idProducto"
  ];
  public function Producto(){
    return $this->hasOne('\Modules\Productos\Entities\Producto', 'id', 'idProducto');
  }
}
