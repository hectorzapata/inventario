<?php

namespace Modules\Catalogos\Entities;

use Illuminate\Database\Eloquent\Model;

class SituacionActual extends Model{
  protected $table = "situacionActual";
  protected $fillable = [
    "situacionActual",
    "activo"
  ];
}
