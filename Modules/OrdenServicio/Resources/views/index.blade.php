@extends('layouts.app')
@section('style')
  <link href="/demo/assets/plugins/custom/datatables/datatables.bundle.css?v=7.0.6" rel="stylesheet" type="text/css"/>
@endsection
@section('breadcumb')
  <div class="d-flex align-items-center flex-wrap mr-2">
    <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Órden de Servicio</h5>
    <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
    <span class="text-muted font-weight-bold mr-4">Todas las órdenes de servicio</span>
  </div>
@endsection
@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="card card-custom">
          <div class="card-header">
            <div class="card-title">
              <span class="card-icon"><i class="flaticon2-delivery-truck text-primary"></i></span>
              <h3 class="card-label">Todas las órdenes de servicio</h3>
            </div>
            <div class="card-toolbar">
              <a href="/ordenservicio/create" class="btn btn-primary font-weight-bolder">
                <span class="svg-icon svg-icon-md">
                  <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                      <rect x="0" y="0" width="24" height="24"/>
                      <circle fill="#000000" opacity="0.3" cx="12" cy="12" r="10"/>
                      <path d="M11,11 L11,7 C11,6.44771525 11.4477153,6 12,6 C12.5522847,6 13,6.44771525 13,7 L13,11 L17,11 C17.5522847,11 18,11.4477153 18,12 C18,12.5522847 17.5522847,13 17,13 L13,13 L13,17 C13,17.5522847 12.5522847,18 12,18 C11.4477153,18 11,17.5522847 11,17 L11,13 L7,13 C6.44771525,13 6,12.5522847 6,12 C6,11.4477153 6.44771525,11 7,11 L11,11 Z" fill="#000000"/>
                    </g>
                  </svg>
                </span>
                Nueva
              </a>
            </div>
          </div>
          <div class="card-body">
            @include('flash::message')
            <table class="table table-bordered table-hover table-checkable dataTable no-footer dtr-inline" id="kt_datatable" style="margin-top: 13px !important">
              <thead>
                <tr>
                  <th>Id</th>
                  <th>Equipo</th>
                  <th>Serie</th>
                  <th>Área</th>
                  <th>Estado</th>
                  <th>Asignado a</th>
                  <th>Fecha registro</th>
                  <th>Acciones</th>
                </tr>
              </thead>
            </table>
          </div>
        </div>
    </div>
  </div>
@endsection
@section('script')
  <script src="/demo/assets/plugins/custom/datatables/datatables.bundle.js?v=7.0.6"></script>
  <script>
  var tabla;
  $(function() {
    tabla = $('#kt_datatable').DataTable({
      processing: true,
      serverSide: true,
      order: [[0, 'desc']],
      ajax: {
        url: "/ordenservicio/tabla",
      },
      columns: [
        { data: 'id', name: 'id' },
        { data: 'equipo_medico.nombre', name: 'EquipoMedico.nombre' },
        { data: 'equipo_medico.serie', name: 'EquipoMedico.serie' },
        { data: 'equipo_medico.ubicacion', name: 'EquipoMedico.ubicacion' },
        { data: 'estado', name: 'estado' },
        { data: 'usuario.name', name: 'Usuario.name' },
        { data: 'created_at', name: 'created_at' },
        { data: 'acciones', name: 'acciones', searchable: false, orderable:false, width: '60px', class: 'acciones' }
      ],
      createdRow: function ( row, data, index ) {
        $(row).find('.ui.dropdown.acciones').dropdown();
      },
      language: { url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json" }
    });
  });
  </script>
@endsection
