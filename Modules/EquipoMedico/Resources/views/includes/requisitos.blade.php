<h6>Eléctricos</h6>
<div class="form-group row">
  <div class="col-lg-4">
    <label>Voltaje (V)</label>
    <input value="{{ old('voltaje') ? old('voltaje') : ( isset($data) ? $data->voltaje : "" ) }}" type="text" name="voltaje" class="form-control">
  </div>
  <div class="col-lg-4">
    <label>Corriente (A)</label>
    <input value="{{ old('corriente') ? old('corriente') : ( isset($data) ? $data->corriente : "" ) }}" type="text" name="corriente" class="form-control">
  </div>
  <div class="col-lg-4">
    <label>Baterias</label>
    <input value="{{ old('baterias') ? old('baterias') : ( isset($data) ? $data->baterias : "" ) }}" type="text" name="baterias" class="form-control">
  </div>
</div>
<h6>Gases y fluidos</h6>
<div class="form-group row">
  <div class="col-lg-6">
    <label>G. Medicinales</label>
    <input value="{{ old('gMedicinales') ? old('gMedicinales') : ( isset($data) ? $data->gMedicinales : "" ) }}" type="text" name="gMedicinales" class="form-control">
  </div>
  <div class="col-lg-6">
    <label>G. Especiales</label>
    <input value="{{ old('gEspeciales') ? old('gEspeciales') : ( isset($data) ? $data->gEspeciales : "" ) }}" type="text" name="gEspeciales" class="form-control">
  </div>
  <div class="col-lg-6">
    <label>Otros</label>
    <input value="{{ old('gasesOtros') ? old('gasesOtros') : ( isset($data) ? $data->gasesOtros : "" ) }}" type="text" name="gasesOtros" class="form-control">
  </div>
  <div class="col-lg-6">
    <label>Hidráulicos</label>
    <input value="{{ old('hidraulicos') ? old('hidraulicos') : ( isset($data) ? $data->hidraulicos : "" ) }}" type="text" name="hidraulicos" class="form-control">
  </div>
</div>
<h6>Ambientales</h6>
<div class="form-group row">
  <div class="col-lg-6">
    <label>Temperatura</label>
    <input value="{{ old('temperatura') ? old('temperatura') : ( isset($data) ? $data->temperatura : "" ) }}" type="text" name="temperatura" class="form-control">
  </div>
  <div class="col-lg-6">
    <label>HumedadRelativa</label>
    <input value="{{ old('humedadRelativa') ? old('humedadRelativa') : ( isset($data) ? $data->humedadRelativa : "" ) }}" type="text" name="humedadRelativa" class="form-control">
  </div>
  <div class="col-lg-6">
    <label>Presión</label>
    <input value="{{ old('presion') ? old('presion') : ( isset($data) ? $data->presion : "" ) }}" type="text" name="presion" class="form-control">
  </div>
  <div class="col-lg-6">
    <label>Otros</label>
    <input value="{{ old('ambientalesOtros') ? old('ambientalesOtros') : ( isset($data) ? $data->ambientalesOtros : "" ) }}" type="text" name="ambientalesOtros" class="form-control">
  </div>
</div>
