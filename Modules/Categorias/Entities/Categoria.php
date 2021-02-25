<?php

namespace Modules\Categorias\Entities;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model{
  protected $table = "categoria";
  protected $fillable = [
    'nombre',
    'imagen',
    'activo'
  ];
  public function Productos(){
    return $this->hasMany('\Modules\Productos\Entities\Producto', 'idCategoria', 'id');
  }
}
