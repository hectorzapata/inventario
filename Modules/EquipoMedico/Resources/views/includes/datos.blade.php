<h6>Mantenimiento preventivo</h6>
<div class="form-group row">
  <div class="col-lg-4">
    <label>Prioridad</label>
    <input value="{{ old('mantenimientoPrioridad') ? old('mantenimientoPrioridad') : ( isset($data) ? $data->mantenimientoPrioridad : "" ) }}" type="text" name="mantenimientoPrioridad" class="form-control">
  </div>
  <div class="col-lg-4">
    <label>Periodicidad</label>
    <input value="{{ old('mantenimientoPeriodicidad') ? old('mantenimientoPeriodicidad') : ( isset($data) ? $data->mantenimientoPeriodicidad : "" ) }}" type="text" name="mantenimientoPeriodicidad" class="form-control">
  </div>
  <div class="col-lg-4">
    <label>Interno/Externo</label>
    <select class="form-control select2 internoExterno" name="internoExterno" style="width: 100%;">
      <option value=""></option>
      <option value="1">Interno</option>
      <option value="2">Externo</option>
    </select>
  </div>
</div>
<h6>Calibración</h6>
<div class="form-group row">
  <div class="col-lg-6">
    <label>Requiere</label>
    <input value="{{ old('requiere') ? old('requiere') : ( isset($data) ? $data->requiere : "" ) }}" type="text" name="requiere" class="form-control">
  </div>
  <div class="col-lg-6">
    <label>Periodicidad</label>
    <input value="{{ old('calibracionPeriodicidad') ? old('calibracionPeriodicidad') : ( isset($data) ? $data->calibracionPeriodicidad : "" ) }}" type="text" name="calibracionPeriodicidad" class="form-control">
  </div>
  <div class="col-lg-6">
    <label>Proveedor</label>
    <input value="{{ old('proveedor') ? old('proveedor') : ( isset($data) ? $data->proveedor : "" ) }}" type="text" name="proveedor" class="form-control">
  </div>
  <div class="col-lg-6">
    <label>Contacto</label>
    <input value="{{ old('contacto') ? old('contacto') : ( isset($data) ? $data->contacto : "" ) }}" type="text" name="contacto" class="form-control">
  </div>
</div>
<div class="form-group row">
  <div class="col-lg-6">
    <label>Estado / Situación actual</label>
    <select class="form-control select2 situacionActual" name="idSituacionActual" style="width: 100%;">
      <option value=""></option>
      @foreach ($situacionActual as $key => $value)
        <option value="{{ $value->id }}">{{ $value->situacionActual }}</option>
      @endforeach
    </select>
  </div>
</div>
