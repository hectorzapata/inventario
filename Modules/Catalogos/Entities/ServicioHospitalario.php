<?php

namespace Modules\Catalogos\Entities;

use Illuminate\Database\Eloquent\Model;

class ServicioHospitalario extends Model{
  protected $table = "servicioHospitalario";
  protected $fillable = [
    "servicioHospitalario",
    "activo"
  ];
}
