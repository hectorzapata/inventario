@extends('layouts.app')
@section('breadcumb')
<div class="d-flex align-items-center flex-wrap mr-2">
  <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Equipo Médico</h5>
  <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
    <li class="breadcrumb-item enlace">
      <a href="" class="text-muted">Todo el equipo médico</a>
    </li>
    <li class="breadcrumb-item">
      <span class="text-muted">QR</span>
    </li>
  </ul>
</div>
@endsection
@section('style')
<style media="screen">
.form-control:disabled, .form-control[readonly] {
  border: none;
}
</style>
@endsection
@section('content')
<div class="row">
  <div class="col-md-12">
    @include('flash::message')
    <div class="card card-custom">
      <div class="card-header">
        <h3 class="card-title">
          Código QR
        </h3>
      </div>
      <form action="/usuarios{{ isset($data) ? '/' . $data->id : '' }}" method="POST" enctype="multipart/form-data" id="formCategoria">
        @csrf
        @isset($data)
          <input type="hidden" name="_method" value="PUT">
        @endisset
        <div class="card-body">
          <div class="form-group row">
            <div class="col-lg-3">
              {!!QrCode::size(200)->generate("www.nigmacode.com") !!}
            </div>
            <div class="col-lg-9">
              <div class="form-group row">
                <div class="col-lg-12">
                  <label>Id</label>
                  <input value="{{ $data->id }}" type="text" class="form-control" readonly disabled>
                </div>
                <div class="col-lg-12">
                  <label>Nombre</label>
                  <input value="{{ $data->nombre }}" type="text" class="form-control" readonly disabled>
                </div>
                <div class="col-lg-12">
                  <label>Marca</label>
                  <input value="{{ $data->Marca->marca }}" type="text" class="form-control" readonly disabled>
                </div>
                <div class="col-lg-12">
                  <label>Número de serie</label>
                  <input value="{{ $data->serie }}" type="text" class="form-control" readonly disabled>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="card-footer text-right">
          <a href="/equipomedico" class="btn btn-secondary">Regresar</a>
          <button type="button" onclick="window.print();" class="btn btn-primary mr-2">Imprimir</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
