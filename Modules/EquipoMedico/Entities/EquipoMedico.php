<?php

namespace Modules\EquipoMedico\Entities;

use Illuminate\Database\Eloquent\Model;

class EquipoMedico extends Model{
  protected $table = "equipoMedico";
  protected $fillable = [
    "nombre",
    "descripcion",
    "fabricante",
    "idPais",
    "idMarca",
    "modelo",
    "serie",
    "lote",
    "anoFabricacion",
    "numeroActivoFijo",
    "infoPrioridad",
    "referenciaMaestra",
    "costo",
    "tipoEquipo",
    "tiempoVida",
    "garantia",
    "idPlanta",
    "idServicioHospitalario",
    "ubicacion",
    "medicoResponsable",
    "voltaje",
    "corriente",
    "baterias",
    "gMedicinales",
    "gEspeciales",
    "gasesOtros",
    "hidraulicos",
    "temperatura",
    "humedadRelativa",
    "presion",
    "ambientalesOtros",
    "mantenimientoPrioridad",
    "mantenimientoPeriodicidad",
    "internoExterno",
    "requiere",
    "calibracionPeriodicidad",
    "proveedor",
    "contacto",
    "idSituacionActual",
    "activo"
  ];
  public function Marca(){
    return $this->hasOne('\Modules\Catalogos\Entities\Marca', 'id', 'idMarca');
  }
}
