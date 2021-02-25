@extends('layouts.app')
@section('breadcumb')
  <div class="d-flex align-items-center flex-wrap mr-2">
    <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Usuarios</h5>
    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
      <li class="breadcrumb-item enlace">
        <a href="" class="text-muted">Todos los usuarios</a>
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
            {{ isset($data) ? 'Editar' : 'Nuevo' }} usuario
          </h3>
        </div>
        <form action="/usuarios{{ isset($data) ? '/' . $data->id : '' }}" method="POST" enctype="multipart/form-data" id="formCategoria">
          @csrf
          @isset($data)
            <input type="hidden" name="_method" value="PUT">
          @endisset
          <div class="card-body">
            <div class="form-group row">
              <div class="col-lg-6">
                <label>Nombre</label>
                <input
                value="{{ old('name') ? old('name') : ( isset($data) ? $data->name : "" ) }}"
                type="text" name="name" class="form-control" placeholder="Escribe el nombre del usuario">
              </div>
              <div class="col-lg-6">
                <label>Email</label>
                <input value="{{ old('email') ? old('email') : ( isset($data) ? $data->email : "" ) }}" type="email" name="email" class="form-control" placeholder="Escribe el email del usuario">
              </div>
            </div>
            <div class="form-group row">
              <div class="col-lg-6">
                <label>Contraseña</label>
                <input value="{{ old('password') }}" type="text" name="password" class="form-control" placeholder="Escribe la contraseña del usuario">
              </div>
              <div class="col-lg-6">
                <label>Confirmar contraseña</label>
                <input value="{{ old('passwordconfirm') }}" type="text" name="passwordconfirm" class="form-control" placeholder="Confirma la contraseña del usuario">
              </div>
            </div>
          </div>
          <div class="card-footer text-right">
            <a href="/usuarios" class="btn btn-secondary">Cancelar</a>
            <button type="submit" class="btn btn-primary mr-2">Guardar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection
@section('script')
  <script>
  var categoria = $('.select2.categoria');
  $(function() {
    categoria = categoria.select2({ placeholder: "Selecciona una categoría" });
    @if ( old('idCategoria') )
    categoria.val('{{ old("idCategoria") }}');
    categoria.trigger('change');
    @elseif ( isset($data) )
    categoria.val('{{ $data->idCategoria }}');
    categoria.trigger('change');
    @endif
    FormValidation.formValidation(
      document.getElementById('formCategoria'),
      {
        fields: {
          name: {
            validators: {
              notEmpty: {
                message: 'Por favor, escribe el nombre'
              }
            }
          },
          email: {
						validators: {
							notEmpty: {
								message: 'Por favor, escribe el email'
							},
							emailAddress: {
								message: 'Por favor, escribe un email válido'
							}
						}
					},
          password: {
						validators: {
							notEmpty: {
								message: 'Por favor, escribe una contraseña'
							}
						}
					},
          passwordconfirm: {
            validators: {
              identical: {
                compare: function() {
                  return $('input[name="password"]').val() == "" ? false : $('input[name="password"]').val();
                },
                message: 'La contraseña no coincide, por favor, confirma tu contraseña'
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
                  case 'password':
                    return true;
                    break;
                  case 'passwordconfirm':
                    let valor = $('input[name=password]').val();
                    if ( valor == "" ) { //si no quiere actualizar contraseña, lo excluyo
                      return true;
                    }else{
                      return false;
                    }
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
