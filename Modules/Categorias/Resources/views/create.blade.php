@extends('layouts.app')
@section('breadcumb')
  <div class="d-flex align-items-center flex-wrap mr-2">
    <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Categorías</h5>
    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
      <li class="breadcrumb-item enlace">
        <a href="" class="text-muted">Todas las categorías</a>
      </li>
      <li class="breadcrumb-item">
        <span class="text-muted">@isset($data) Editar @else Nueva @endisset</span>
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
            @isset($data) Editar @else Nueva @endisset categoría
          </h3>
        </div>
        <form action="/categorias{{ isset($data) ? '/' . $data->id : '' }}" method="POST" enctype="multipart/form-data" id="formCategoria">
          @csrf
          @isset($data)
            <input type="hidden" name="_method" value="PUT">
          @endisset
          <div class="card-body">
            <div class="form-group row">
              <div class="col-lg-6">
                <label>Nombre</label>
                <input @isset($data) value="{{ $data->nombre }}" @endisset type="text" name="nombre" class="form-control" placeholder="Escribe el nombre de la categoría">
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
            <a href="/categorias" class="btn btn-secondary">Cancelar</a>
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
    $(function() {
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
