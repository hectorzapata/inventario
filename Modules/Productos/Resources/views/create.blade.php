@extends('layouts.app')
@section('breadcumb')
  <div class="d-flex align-items-center flex-wrap mr-2">
    <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Productos</h5>
    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
      <li class="breadcrumb-item enlace">
        <a href="" class="text-muted">Todos los productos</a>
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
            @isset($data) Editar @else Nuevo @endisset producto
            </h3>
          </div>
          <form action="/productos{{ isset($data) ? '/' . $data->id : '' }}" method="POST" enctype="multipart/form-data" id="formCategoria">
            @csrf
            @isset($data)
              <input type="hidden" name="_method" value="PUT">
            @endisset
            <div class="card-body">
              <div class="form-group row">
                <div class="col-lg-6">
                  <label>Nombre</label>
                  <input
                  value="{{ old('nombre') ? old('nombre') : ( isset($data) ? $data->nombre : "" ) }}"
                  type="text" name="nombre" class="form-control" placeholder="Escribe el nombre de la categoría">
                </div>
                <div class="col-lg-6">
                  <label>Descripción</label>
                  <input value="{{ old('descripcion') ? old('descripcion') : ( isset($data) ? $data->descripcion : "" ) }}" type="text" name="descripcion" class="form-control" placeholder="Escribe la descripcion del producto">
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-lg-6">
                    <label>Categoría</label>
                    <select class="form-control select2 categoria" name="idCategoria">
                      <option value=""></option>
                      @foreach ($categorias as $key => $value)
                        <option value="{{ $value->id }}">{{ $value->nombre }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="col-lg-6">
                    <label>Precio</label>
                    <input value="{{ old('precio') ? old('precio') : ( isset($data) ? $data->precio : "" ) }}" type="number" name="precio" class="form-control" placeholder="Escribe el precio del producto por Kg">
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-lg-6">
                      <label>Peso promedio por pieza (Kg)</label>
                      <input value="{{ old('pesoPromedio') ? old('pesoPromedio') : ( isset($data) ? $data->pesoPromedio : "" ) }}" type="number" name="pesoPromedio" class="form-control" placeholder="Escribe el peso promedio por cada pieza del producto">
                      </div>
                      <div class="col-lg-6">
                        <label>Imágen</label>
                        <input type="file" name="imagen" class="form-control" accept="image/png, image/jpeg">
                      </div>
                    </div>
                    @isset($data)
                      <div class="form-group row">
                        <div class="col-lg-6"></div>
                        <div class="col-lg-6">
                          <figure class="preview" style="background-image: url('{{ $data->imagen }}')"></figure>
                        </div>
                      </div>
                    @endisset
                  </div>
                  <div class="card-footer text-right">
                    <a href="/productos" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-primary mr-2">Guardar</button>
                  </div>
                </form>
                <!--end::Form-->
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
