@extends('layouts.app')
@section('breadcumb')
<div class="d-flex align-items-center flex-wrap mr-2">
  <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Órden de Servicio</h5>
  <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
    <li class="breadcrumb-item enlace">
      <a href="" class="text-muted">Todas las órdenes de servicio</a>
    </li>
    <li class="breadcrumb-item">
      <span class="text-muted">{{ isset($data) ? 'Editar' : 'Nuevo' }}</span>
    </li>
  </ul>
</div>
@endsection
@section('style')
@endsection
@section('content')
<div class="row">
  <div class="col-md-12">
    @include('flash::message')
    <div class="card card-custom">
      <div class="card-header">
        <h3 class="card-title">
          @isset($data) Editar @else Nueva @endisset órden de servicio
        </h3>
      </div>
      <div class="card-body">
        <form action="/ordenservicio{{ isset($data) ? '/' . $data->id : '' }}" method="POST" id="formCategoria">
          @csrf
          @isset($data)
            <input type="hidden" name="_method" value="PUT">
          @endisset
          <div class="form-group row">
            <div class="col-lg-6">
              <label>Equipo médico</label>
              <select class="form-control itemSearch" name="idEquipoMedico" style="display: none; width: 100%;"></select>
            </div>
            <div class="col-lg-6">
              <label>Número de control</label>
              <input value="{{ old('numeroControl') ? old('numeroControl') : ( isset($data) ? $data->numeroControl : "" ) }}" type="text" name="numeroControl" class="form-control" placeholder="Escribe el número de control">
            </div>
          </div>
          <div class="form-group row">
            <div class="col-lg-12">
              <label>Fallas reportadas</label>
              <textarea placeholder="Describe las fallas reportadas" class="form-control" name="fallasReportadas" rows="8" cols="80">{{ old('fallasReportadas') ? old('fallasReportadas') : ( isset($data) ? $data->fallasReportadas : "" ) }}</textarea>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-lg-6">
              <label>Reportado por</label>
              <input value="{{ old('reportadoPor') ? old('reportadoPor') : ( isset($data) ? $data->reportadoPor : "" ) }}" type="text" name="reportadoPor" class="form-control" placeholder="Escribe quien lo reportó">
            </div>
            <div class="col-lg-6">
              <label>Asignar a</label>
              <select class="form-control select2 asignarA" name="idAsignado">
                <option value=""></option>
                @foreach ($usuarios as $key => $value)
                  <option value="{{ $value->id }}">{{ $value->name }}</option>
                @endforeach
              </select>
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
$(function() {
  $('.select2').select2({ placeholder: "Selecciona una opción" });

  $(".itemSearch").select2({
    placeholder: "Busca y elige el equipo médico",
    minimumInputLength: 3,
    minimumResultsForSearch: 10,
    ajax: {
      url: '/equipomedico/search',
      dataType: "json",
      type: "GET",
      data: function (params) { return { term: params.term } },
      processResults: function (data) {
        return {
          results: $.map(data, function (item) {
            return {
              text: item.nombre + " Serie: " + item.serie + " Marca: " + item.marca.marca,
              id: item.id,
              datos: item,
              tipo: "interno"
            }
          })
        };
      }
    }
  });

  FormValidation.formValidation(
    document.getElementById('formCategoria'),
    {
      fields: {
        idEquipoMedico: {
          validators: {
            notEmpty: {
              message: 'Por favor, selecciona un equipo médico'
            }
          }
        },
        numeroControl: {
          validators: {
            notEmpty: {
              message: 'Por favor, escribe el número de control'
            }
          }
        },
        fallasReportadas: {
          validators: {
            notEmpty: {
              message: 'Por favor, escribe las fallas reportadas'
            }
          }
        },
        reportadoPor: {
          validators: {
            notEmpty: {
              message: 'Por favor, escribe quien lo reportó'
            }
          }
        },
        idAsignado: {
          validators: {
            notEmpty: {
              message: 'Por favor, selecciona a quien se asigna'
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
          },
        }),
      }
    }
  );
});
</script>
@endsection
