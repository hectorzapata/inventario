<div class="form-group row">
  <div class="col-lg-6">
    <label>Nombre</label>
    <input
    value="{{ old('nombre') ? old('nombre') : ( isset($data) ? $data->nombre : "" ) }}"
    type="text" name="nombre" class="form-control" placeholder="Escribe el nombre del equipo">
  </div>
  <div class="col-lg-6">
    <label>Descripción</label>
    <input value="{{ old('descripcion') ? old('descripcion') : ( isset($data) ? $data->descripcion : "" ) }}" type="text" name="descripcion" class="form-control" placeholder="Escribe la descripción del equipo">
  </div>
</div>
<div class="form-group row">
  <div class="col-lg-6">
    <label>Fabricante</label>
    <input value="{{ old('fabricante') ? old('fabricante') : ( isset($data) ? $data->fabricante : "" ) }}" type="text" name="fabricante" class="form-control" placeholder="Escribe el fabricante del producto">
  </div>
  <div class="col-lg-6">
    <label>País de orígen</label>
    <select class="form-control select2 paisOrigen" name="idPais" style="width: 100%;">
      <option value=""></option>
      @foreach ($pais as $key => $value)
        <option value="{{ $value->id }}">{{ $value->pais }}</option>
      @endforeach
    </select>
  </div>
</div>
<div class="form-group row">
  <div class="col-lg-6">
    <label>Marca</label>
    <select class="form-control select2 marca" name="idMarca" style="width: 100%;">
      <option value=""></option>
      @foreach ($marca as $key => $value)
      <option value="{{ $value->id }}">{{ $value->marca }}</option>
      @endforeach
    </select>
  </div>
  <div class="col-lg-6">
    <label>Modelo</label>
    <input value="{{ old('modelo') ? old('modelo') : ( isset($data) ? $data->modelo : "" ) }}" type="text" name="modelo" class="form-control" placeholder="Escribe el modelo del equipo">
  </div>
</div>
<div class="form-group row">
  <div class="col-lg-6">
    <label>Serie</label>
    <input value="{{ old('serie') ? old('serie') : ( isset($data) ? $data->serie : "" ) }}"
    type="text" name="serie" class="form-control" placeholder="Escribe el número de serie del equipo">
  </div>
  <div class="col-lg-6">
    <label>Lote</label>
    <input value="{{ old('lote') ? old('lote') : ( isset($data) ? $data->lote : "" ) }}" type="text" name="lote" class="form-control" placeholder="Escribe el lote del equipo">
  </div>
</div>
<div class="form-group row">
  <div class="col-lg-6">
    <label>Año de fabricación</label>
    <input value="{{ old('anoFabricacion') ? old('anoFabricacion') : ( isset($data) ? $data->anoFabricacion : "" ) }}" type="text" name="anoFabricacion" class="form-control" placeholder="Escribe el año de fabricación">
  </div>
  <div class="col-lg-6">
    <label>Número de activo fijo</label>
    <input value="{{ old('numeroActivoFijo') ? old('numeroActivoFijo') : ( isset($data) ? $data->numeroActivoFijo : "" ) }}" type="text" name="numeroActivoFijo" class="form-control" placeholder="Escribe el número de activo fijo">
  </div>
</div>
<div class="form-group row">
  <div class="col-lg-6">
    <label>Prioridad</label>
    <input value="{{ old('infoPrioridad') ? old('infoPrioridad') : ( isset($data) ? $data->infoPrioridad : "" ) }}" type="text" name="infoPrioridad" class="form-control" placeholder="Escribe la prioridad">
  </div>
  <div class="col-lg-6">
    <label>Referencia maestra</label>
    <input value="{{ old('referenciaMaestra') ? old('referenciaMaestra') : ( isset($data) ? $data->referenciaMaestra : "" ) }}" type="text" name="referenciaMaestra" class="form-control" placeholder="Escribe la referencia maestra">
  </div>
</div>
<div class="form-group row">
  <div class="col-lg-6">
    <label>Costo</label>
    <input value="{{ old('costo') ? old('costo') : ( isset($data) ? $data->costo : "" ) }}" type="text" name="costo" class="form-control" placeholder="Escribe el costo del equipo">
  </div>
  <div class="col-lg-6">
    <label>Tipo de equipo</label>
    <input value="{{ old('tipoEquipo') ? old('tipoEquipo') : ( isset($data) ? $data->tipoEquipo : "" ) }}" type="text" name="tipoEquipo" class="form-control" placeholder="Escribe el tipo de equipo">
  </div>
</div>
<div class="form-group row">
  <div class="col-lg-6">
    <label>Tiempo de vida</label>
    <input value="{{ old('tiempoVida') ? old('tiempoVida') : ( isset($data) ? $data->tiempoVida : "" ) }}" type="text" name="tiempoVida" class="form-control" placeholder="Escribe el tiempo de vida del equipo">
  </div>
  <div class="col-lg-6">
    <label>Garantía</label>
    <input value="{{ old('garantia') ? old('garantia') : ( isset($data) ? $data->garantia : "" ) }}" type="text" name="garantia" class="form-control" placeholder="Escribe la garantía del equipo">
  </div>
</div>
