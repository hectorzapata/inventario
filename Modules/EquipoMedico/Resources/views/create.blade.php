@extends('layouts.app')
@section('breadcumb')
<div class="d-flex align-items-center flex-wrap mr-2">
  <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Equipo Médico</h5>
  <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
    <li class="breadcrumb-item enlace">
      <a href="" class="text-muted">Todo el equipo médico</a>
    </li>
    <li class="breadcrumb-item">
      <span class="text-muted">{{ isset($data) ? 'Editar' : 'Nuevo' }}</span>
    </li>
  </ul>
</div>
@endsection
@section('style')
<style media="screen">
figure.preview {
  height: 200px;
  width: 300px;
  background-color: #f3f6f9;
  background-size: contain;
  background-repeat: no-repeat;
  background-position: center;
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
          @isset($data) Editar @else Nuevo @endisset equipo médico
        </h3>
      </div>
      <div class="card-body">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="informacion-tab" data-toggle="tab" href="#informacion">
              <span class="nav-icon"> <i class="flaticon2-chat-1"></i> </span>
              <span class="nav-text">Información</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="ubicacion-tab" data-toggle="tab" href="#ubicacion" aria-controls="ubicacion">
              <span class="nav-icon"> <i class="flaticon2-layers-1"></i> </span>
              <span class="nav-text">Ubicación del equipo</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="requisitos-tab" data-toggle="tab" href="#requisitos" aria-controls="requisitos">
              <span class="nav-icon"> <i class="flaticon2-rocket-1"></i> </span>
              <span class="nav-text">Requisitos de funcionamiento</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="datos-tab" data-toggle="tab" href="#datos" aria-controls="datos">
              <span class="nav-icon"> <i class="flaticon2-rocket-1"></i> </span>
              <span class="nav-text">Datos de mantenimiento</span>
            </a>
          </li>
        </ul>
        <form action="/equipomedico{{ isset($data) ? '/' . $data->id : '' }}" method="POST" id="formCategoria">
          @csrf
          @isset($data)
            <input type="hidden" name="_method" value="PUT">
          @endisset
          <div class="card-body" style="padding-top: 0;">
            <div class="tab-content mt-5" id="myTabContent">
              <div class="tab-pane fade active show" id="informacion" role="tabpanel" aria-labelledby="informacion-tab">
                @include('equipomedico::includes.informacion')
              </div>
              <div class="tab-pane fade" id="ubicacion" role="tabpanel" aria-labelledby="ubicacion-tab">
                @include('equipomedico::includes.ubicacion')
              </div>
              <div class="tab-pane fade" id="requisitos" role="tabpanel" aria-labelledby="requisitos-tab">
                @include('equipomedico::includes.requisitos')
              </div>
              <div class="tab-pane fade" id="datos" role="tabpanel" aria-labelledby="datos-tab">
                @include('equipomedico::includes.datos')
              </div>
            </div>
          </div>
          <div class="card-footer text-right">
            <a href="/equipomedico" class="btn btn-secondary">Cancelar</a>
            <button type="submit" class="btn btn-primary mr-2">Guardar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
@section('script')
<script>
// var marca = $('.select2.marca');
$(function() {
  $('.select2').select2({ placeholder: "Selecciona una opción", width: 'resolve' });
  $.each($('input[type=text]'), function(i, item) {
    $(item).val( $(item).attr('name') );
  });
  $('.select2').val(1);
  $('.select2').trigger('change');

  // marca.trigger('change');

  // marca = marca.select2({ placeholder: "Selecciona una marca" });
  @if ( old('idMarca') )
    // marca.val('{{ old("idMarca") }}');
    // marca.trigger('change');
  @elseif ( isset($data) )
    // marca.val('{{ $data->idMarca }}');
    // marca.trigger('change');
  @endif
  FormValidation.formValidation(
    document.getElementById('formCategoria'),
    {
      fields: {
        nombre: {
          validators: {
            notEmpty: {
              message: 'Por favor, escribe el nombre'
            }
          }
        },
        imagen: {
          validators: {
            notEmpty: {
              message: 'Por favor, selecciona una imagen'
            }
          }
        },
      },
      plugins: {
        trigger: new FormValidation.plugins.Trigger(),
        bootstrap: new FormValidation.plugins.Bootstrap(),
        submitButton: new FormValidation.plugins.SubmitButton(),
        defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
        excluded: new FormValidation.plugins.Excluded({
          excluded: function(field, ele, eles) {
            @if ( isset($data) )
            switch (field) {
              case 'imagen':
              return true;
              break;
              default:
              return false;
            }
            @else
            return false;
            @endif
          },
        }),
      }
    }
  );
});
</script>
@endsection
