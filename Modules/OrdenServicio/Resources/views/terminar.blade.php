@php
$detalles = isset($detalles) ? true : false;
@endphp
@extends('layouts.app')
@section('breadcumb')
  <div class="d-flex align-items-center flex-wrap mr-2">
    <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Órden de Servicio</h5>
    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
      <li class="breadcrumb-item enlace">
        <a href="/ordenservicio" class="text-muted">Todas las órdenes de servicio</a>
      </li>
      <li class="breadcrumb-item">
        <span class="text-muted">@if ($detalles) Detalles @else Terminar @endif órden #{{ $data->id }}</span>
        </li>
      </ul>
    </div>
  @endsection
  @section('style')
    <style media="screen">
    .d-flex .marg {
      margin-right: 15px;
    }
    .d-flex.flex-wrap .marg {
      flex-basis: 15%;
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
              @if ($detalles)
                Detalles
              @else
                Terminar
              @endif
              órden #{{ $data->id }}
            </h3>
          </div>
          <div class="card-body">
            <form action="/ordenservicio/{{ $data->id }}/terminar" method="POST" id="formCategoria">
              @csrf
              <div class="d-flex flex-nowrap">
                <div class="marg">
                  <b>ID</b>
                  <p>{{ $data->EquipoMedico->id }}</p>
                </div>
                <div class="marg">
                  <b>Equipo médico</b>
                  <p>{{ $data->EquipoMedico->nombre }}</p>
                </div>
              </div>
              <div class="d-flex flex-wrap">
                <div class="marg">
                  <b>Marca</b>
                  <p>{{ $data->EquipoMedico->Marca->marca }}</p>
                </div>
                <div class="marg">
                  <b>Modelo</b>
                  <p>{{ $data->EquipoMedico->modelo }}</p>
                </div>
                <div class="marg">
                  <b>Número de control</b>
                  <p>{{ $data->EquipoMedico->numeroControl }}</p>
                </div>
                <div class="marg">
                  <b>Número de serie</b>
                  <p>{{ $data->EquipoMedico->serie }}</p>
                </div>
                <div class="marg">
                  <b>Área</b>
                  <p>{{ $data->EquipoMedico->ubicacion }}</p>
                </div>
                <div class="marg">
                  <b>Número de inventario</b>
                  <p>{{ $data->EquipoMedico->numeroInventario }}</p>
                </div>
                <div class="marg">
                  <b>Asignado a</b>
                  <p>{{ $data->Usuario->name }}</p>
                </div>
                <div class="marg">
                  <b>Reportado por</b>
                  <p>{{ $data->reportadoPor }}</p>
                </div>
              </div>
              <div class="d-flex flex-nowrap">
                <div class="marg">
                  <b>Fallas reportadas</b>
                  <p>{{ $data->fallasReportadas }}</p>
                </div>
              </div>
              @if ($detalles)
                @php
                  switch ($data->estado) {
                    case '2':
                      $tmp = '<p class="text-primary">En proceso</p>';
                      break;
                    case '3':
                      $tmp = '<p class="text-success">Terminada</p>';
                      break;
                    default:
                      $tmp = '<p class="text-warning">Pendiente</p>';
                      break;
                  }
                @endphp
                <div class="d-flex flex-nowrap">
                  <div class="marg">
                    <b>Estado</b>
                    {!! $tmp !!}
                  </div>
                  @if ($detalles && $data->estado == 3)
                    <div class="marg">
                      <b>Calificación del servicio</b>
                      <p>{{ $data->CalificacionServicio->calificacionServicio }}</p>
                    </div>
                    <div class="marg">
                      <b>Fallas encontradas</b>
                      <p>{{ $data->fallasEncontradas }}</p>
                    </div>
                    <div class="marg">
                      <b>Descripción del trabajo realizado</b>
                      <p>{{ $data->descripcionTrabajoRealizado }}</p>
                    </div>
                  @endif
                </div>
              @endif
              @if (!$detalles)
                <div class="form-group">
                  <label> <b>Calificación del servicio</b> </label>
                  <div class="radio-inline">
                    <label class="radio">
                      <input type="radio" name="idCalificacionServicio" value="1" @if ( old('idCalificacionServicio') == 1 )
                        checked="checked"
                      @endif/><span></span>
                      Mantenimiento preventivo
                    </label>
                    <label class="radio">
                      <input type="radio" name="idCalificacionServicio" value="2" @if ( old('idCalificacionServicio') == 2 )
                        checked="checked"
                      @endif/><span></span>
                      Mantenimiento correctivo
                    </label>
                    <label class="radio">
                      <input type="radio" name="idCalificacionServicio" value="3" @if ( old('idCalificacionServicio') == 3 )
                        checked="checked"
                      @endif/><span></span>
                      Mantenimiento predictivo
                    </label>
                    <label class="radio">
                      <input type="radio" name="idCalificacionServicio" value="4" @if ( old('idCalificacionServicio') == 4 )
                        checked="checked"
                      @endif/><span></span>
                      Calibración
                    </label>
                    <label class="radio">
                      <input type="radio" name="idCalificacionServicio" value="5" @if ( old('idCalificacionServicio') == 5 )
                        checked="checked"
                      @endif/><span></span>
                      Visita de inspección
                    </label>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-lg-6">
                    <label> <b>Fallas encontradas</b> </label>
                    <textarea placeholder="Describe las fallas encontradas" class="form-control" name="fallasEncontradas" rows="8" cols="80">{{ old('fallasEncontradas') ? old('fallasEncontradas') : ( isset($data) ? $data->fallasEncontradas : "" ) }}</textarea>
                  </div>
                  <div class="col-lg-6">
                    <label> <b>Descripción del trabajo realizado</b> </label>
                    <textarea placeholder="Describe el trabajo realizado" class="form-control" name="descripcionTrabajoRealizado" rows="8" cols="80">{{ old('descripcionTrabajoRealizado') ? old('descripcionTrabajoRealizado') : ( isset($data) ? $data->descripcionTrabajoRealizado : "" ) }}</textarea>
                  </div>
                </div>
              @endif
              <div class="card-footer text-right">
                <a href="/ordenservicio" class="btn btn-secondary">Regresar</a>
                @if ($detalles == false)
                  <button type="submit" class="btn btn-primary mr-2">Terminar</button>
                @endif
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
      FormValidation.formValidation(
        document.getElementById('formCategoria'),
        {
          fields: {
            idCalificacionServicio: {
              validators: {
                notEmpty: {
                  message: 'Por favor, selecciona una opción'
                }
              }
            },
            fallasEncontradas: {
              validators: {
                notEmpty: {
                  message: 'Por favor, escribe las fallas encontradas'
                }
              }
            },
            descripcionTrabajoRealizado: {
              validators: {
                notEmpty: {
                  message: 'Por favor, escribe una descripción del trabajo realizado'
                }
              }
            }
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
