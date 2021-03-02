<div class="form-group row">
  <div class="col-lg-6">
    <label>Planta</label>
    <select class="form-control select2 planta" name="idPlanta" style="width: 100%;">
      <option value=""></option>
      @foreach ($planta as $key => $value)
        <option value="{{ $value->id }}">{{ $value->planta }}</option>
      @endforeach
    </select>
  </div>
  <div class="col-lg-6">
    <label>Servicio hospitalario</label>
    <select class="form-control select2 servicioHospitalario" name="idServicioHospitalario" style="width: 100%;">
      <option value=""></option>
      @foreach ($servicioHospitalario as $key => $value)
        <option value="{{ $value->id }}">{{ $value->servicioHospitalario }}</option>
      @endforeach
    </select>
  </div>
</div>
<div class="form-group row">
  <div class="col-lg-6">
    <label>Ubicación</label>
    <input
    value="{{ old('ubicacion') ? old('ubicacion') : ( isset($data) ? $data->ubicacion : "" ) }}"
    type="text" name="ubicacion" class="form-control" placeholder="Escribe la ubicación del equipo">
  </div>
  <div class="col-lg-6">
    <label>Médico responsable</label>
    <input value="{{ old('medicoResponsable') ? old('medicoResponsable') : ( isset($data) ? $data->medicoResponsable : "" ) }}" type="text" name="medicoResponsable" class="form-control" placeholder="Escribe la descripción del equipo">
  </div>
</div>
