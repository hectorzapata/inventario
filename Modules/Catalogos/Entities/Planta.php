<?php

namespace Modules\Catalogos\Entities;

use Illuminate\Database\Eloquent\Model;

class Planta extends Model{
  protected $table = "planta";
  protected $fillable = [
    "planta",
    "activo"
  ];
}
