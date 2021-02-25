@extends('layouts.app')
@section('breadcumb')
  <div class="d-flex align-items-center flex-wrap mr-2">
    <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Principales</h5>
    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
      <li class="breadcrumb-item enlace">
        <a href="" class="text-muted">Todos los principales</a>
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
            @isset($data)
              Editar
            @else
              Nuevo
            @endisset
            principal
          </h3>
        </div>
        <form action="/principales{{ isset($data) ? '/' . $data->id : '' }}" method="POST" enctype="multipart/form-data" id="formCategoria">
          @csrf
          @isset($data)
            <input type="hidden" name="_method" value="PUT">
          @endisset
          <div class="card-body">
            <div class="form-group row">
              <div class="col-lg-6">
                <label>Descripción</label>
                <input
                value="{{ old('nombre') ? old('nombre') : ( isset($data) ? $data->nombre : "" ) }}"
                type="text" name="nombre" class="form-control" placeholder="Escribe la descripción del principal">
              </div>
              <div class="col-lg-6">
                <label>Producto</label>
                <select class="form-control select2 producto" name="idProducto">
                  <option value=""></option>
                  @foreach ($productos as $key => $value)
                    <option value="{{ $value->id }}">{{ $value->Categoria->nombre }}: {{ $value->nombre }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="form-group row">
              <div class="col-lg-6">
                <label>Imágen</label>
                <input type="file" name="imagen" class="form-control" accept="image/png, image/jpeg">
              </div>
              @isset($data)
                <div class="col-lg-6">
                  <figure class="preview" style="background-image: url('{{ $data->imagen }}')"></figure>
                </div>
              @endisset
            </div>
          </div>
          <div class="card-footer text-right">
            <a href="/principales" class="btn btn-secondary">Cancelar</a>
            <button type="submit" class="btn btn-primary mr-2">Guardar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection
@section('script')
  <script>
  var producto = $('.select2.producto');
  $(function() {
    producto = producto.select2({ placeholder: "Selecciona un producto" });
    @if ( old('idProducto') )
    producto.val('{{ old("idProducto") }}');
    producto.trigger('change');
    @elseif ( isset($data) )
    producto.val('{{ $data->idProducto }}');
    producto.trigger('change');
    @endif
    FormValidation.formValidation(
      document.getElementById('formCategoria'),
      {
        fields: {
          nombre: {
            validators: {
              notEmpty: {
                message: 'Por favor, escribe la descripción del principal'
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
          producto: {
            validators: {
              notEmpty: {
                message: 'Por favor, selecciona un producto'
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
