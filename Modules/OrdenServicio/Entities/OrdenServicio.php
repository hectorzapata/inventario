<?php

namespace Modules\OrdenServicio\Entities;

use Illuminate\Database\Eloquent\Model;

class OrdenServicio extends Model{
  protected $table = "ordenServicio";
  protected $fillable = [
    "idEquipoMedico",
    "numeroControl",
    "fallasReportadas",
    "reportadoPor",
    "idAsignado",
    "idCalificacionServicio",
    "fallasEncontradas",
    "descripcionTrabajoRealizado",
    "estado",
    "activo"
  ];
  public function EquipoMedico(){
    return $this->hasOne('\Modules\EquipoMedico\Entities\EquipoMedico', 'id', 'idEquipoMedico');
  }
  public function Usuario(){
    return $this->hasOne('\App\User', 'id', 'idAsignado');
  }
  public function CalificacionServicio(){
    return $this->hasOne('\Modules\OrdenServicio\Entities\CalificacionServicio', 'id', 'idCalificacionServicio');
  }
}
