<?php

namespace Modules\Catalogos\Entities;

use Illuminate\Database\Eloquent\Model;

class Pais extends Model{
  protected $table = "pais";
  protected $fillable = [
    "pais",
    "activo"
  ];
}
