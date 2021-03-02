<?php

namespace Modules\Catalogos\Entities;

use Illuminate\Database\Eloquent\Model;

class Marca extends Model{
  protected $table = "marca";
  protected $fillable = [
    "marca",
    "activo"
  ];
}
