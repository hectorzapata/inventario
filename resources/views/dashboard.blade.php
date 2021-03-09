@extends('layouts.app')
@section('style')
  <link href="/demo/assets/plugins/custom/fullcalendar/fullcalendar.bundle.css?v=7.0.6" rel="stylesheet" type="text/css"/>
@endsection
@section('breadcumb')
  <div class="d-flex align-items-center flex-wrap mr-2">
    <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Dashboard</h5>
    <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
    <span class="text-muted font-weight-bold mr-4">#{{ getenv('APP_NAME') }}</span>
  </div>
  <div class="d-flex align-items-center flex-wrap">
    <div class="btn btn-bg-white font-weight-bold mr-3 my-2 my-lg-0" style="cursor: inherit !important;">
      <span class="text-muted font-weight-bold mr-2" id="kt_dashboard_daterangepicker_title">Hoy</span>
      <span class="text-primary font-weight-bolder" id="kt_dashboard_daterangepicker_date">{{ $fecha }}</span>
    </div>
  </div>
@endsection
@section('content')
  <div class="row">
    <div class="col-xl-4" style="display: none;">
      <div class="card card-custom gutter-b card-stretch">
        <div class="card-header border-0 pt-5">
          <div class="card-title">
            <div class="card-label">
              <div class="font-weight-bolder">Weekly Sales Stats</div>
              <div class="font-size-sm text-muted mt-2">890,344 Sales</div>
            </div>
          </div>
          <div class="card-toolbar">
            <div class="dropdown dropdown-inline">
              <a href="#" class="btn btn-clean btn-sm btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="ki ki-bold-more-hor"></i>
              </a>
              <div class="dropdown-menu dropdown-menu-md dropdown-menu-right">
                <ul class="navi navi-hover py-5">
                  <li class="navi-item">
                    <a href="#" class="navi-link">
                      <span class="navi-icon"><i class="flaticon2-drop"></i></span>
                      <span class="navi-text">New Group</span>
                    </a>
                  </li>
                  <li class="navi-item">
                    <a href="#" class="navi-link">
                      <span class="navi-icon"><i class="flaticon2-rocket-1"></i></span>
                      <span class="navi-text">Groups</span>
                      <span class="navi-link-badge">
                        <span class="label label-light-primary label-inline font-weight-bold">new</span>
                      </span>
                    </a>
                  </li>
                  <li class="navi-separator my-3"></li>
                  <li class="navi-item">
                    <a href="#" class="navi-link">
                      <span class="navi-icon"><i class="flaticon2-bell-2"></i></span>
                      <span class="navi-text">Privacy</span>
                      <span class="navi-link-badge">
                        <span class="label label-light-danger label-rounded font-weight-bold">5</span>
                      </span>
                    </a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <div class="card-body d-flex flex-column px-0">
          <div id="kt_tiles_widget_1_chart" data-color="info" style="height: 125px"></div>
          <div class="flex-grow-1 card-spacer-x">
            <div class="d-flex align-items-center justify-content-between mb-10">
              <div class="d-flex align-items-center mr-2">
                <div class="symbol symbol-50 symbol-light mr-3 flex-shrink-0">
                  <div class="symbol-label">
                    <img src="/demo/assets/media/svg/misc/006-plurk.svg" alt="" class="h-50"/>
                  </div>
                </div>
                <div>
                  <a href="#" class="font-size-h6 text-dark-75 text-hover-primary font-weight-bolder">Top Authors</a>
                  <div class="font-size-sm text-muted font-weight-bold mt-1">Ricky Hunt, Sandra Trepp</div>
                </div>
              </div>
              <div class="label label-light label-inline font-weight-bold text-dark-50 py-4 px-3 font-size-base">+105$</div>
            </div>
            <div class="d-flex align-items-center justify-content-between mb-10">
              <div class="d-flex align-items-center mr-2">
                <div class="symbol symbol-50 symbol-light mr-3 flex-shrink-0">
                  <div class="symbol-label">
                    <img src="/demo/assets/media/svg/misc/015-telegram.svg" alt="" class="h-50"/>
                  </div>
                </div>
                <div>
                  <a href="#" class="font-size-h6 text-dark-75 text-hover-primary font-weight-bolder">Bestsellers</a>
                  <div class="font-size-sm text-muted font-weight-bold mt-1">Pitstop Email Marketing</div>
                </div>
              </div>
              <div class="label label-light label-inline font-weight-bold text-dark-50 py-4 px-3 font-size-base">+60$</div>
            </div>
            <div class="d-flex align-items-center justify-content-between">
              <div class="d-flex align-items-center mr-2">
                <div class="symbol symbol-50 symbol-light mr-3 flex-shrink-0">
                  <div class="symbol-label">
                    <img src="/demo/assets/media/svg/misc/003-puzzle.svg" alt="" class="h-50"/>
                  </div>
                </div>
                <div>
                  <a href="#" class="font-size-h6 text-dark-75 text-hover-primary font-weight-bolder">Top Engagement</a>
                  <div class="font-size-sm text-muted font-weight-bold mt-1">KT.com solution provider</div>
                </div>
              </div>
              <div class="label label-light label-inline font-weight-bold text-dark-50 py-4 px-3 font-size-base">+75$</div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-5" style="display: none;">
      <div class="row">
        <div class="col-xl-6">
          <div class="card card-custom bg-danger gutter-b" style="height: 130px">
            <div class="card-body d-flex flex-column p-0">
              <div class="flex-grow-1 card-spacer-x pt-6">
                <div class="text-inverse-danger font-weight-bold">Productos</div>
                <div class="text-inverse-danger font-weight-bolder font-size-h3">{{ $productos }}</div>
              </div>
              <div id="kt_tiles_widget_2_chart" class="card-rounded-bottom" style="height: 50px">
              </div>
            </div>
          </div>
          <div class="card card-custom bgi-no-repeat bgi-no-repeat bgi-size-cover gutter-b" style="height: 130px; background-image: url(assets/media/bg/bg-9.jpg)">
            <div class="card-body d-flex flex-column">
              <a href="/categorias" class="text-dark-75 text-hover-primary font-weight-bolder font-size-h3">Categorías</a>
              <div class="font-weight-bolder font-size-h3">{{ $categorias }}</div>
            </div>
          </div>
        </div>
        <div class="col-xl-6">
          <div class="card card-custom gutter-b" style="height: 130px">
            <div class="card-body d-flex flex-column">
              <div class="flex-grow-1">
                <div class="text-dark-50 font-weight-bold">Total de ventas</div>
                <div class="font-weight-bolder font-size-h3">4,9M</div>
              </div>
              <div class="progress progress-xs">
                <div class="progress-bar bg-primary" role="progressbar" style="width: 75%;" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>
          </div>
          <div class="card card-custom bg-info gutter-b" style="height: 130px">
            <div class="card-body d-flex flex-column p-0">
              <div class="flex-grow-1 card-spacer-x pt-6">
                <div class="text-inverse-info font-weight-bold">Comisiones</div>
                <div class="text-inverse-info font-weight-bolder font-size-h3">$2,005</div>
              </div>
              <div id="kt_tiles_widget_5_chart" class="card-rounded-bottom" style="height: 50px"></div>
            </div>
          </div>
        </div>
      </div>
      <div class="card card-custom bgi-no-repeat gutter-b" style="height: 175px; background-color: #4AB58E; background-position: calc(100% + 1rem) bottom; background-size: 25% auto; background-image: url(assets/media/svg/humans/custom-1.svg)">
        <div class="card-body d-flex align-items-center">
          <div class="py-2">
            <h3 class="text-white font-weight-bolder mb-3">30% Off Themes</h3>
            <p class="text-white font-size-lg">
              Get your discounted themes of the month<br/>
              No hassle, no worries, no fuss<br/>
              Instant rewards, everyday
            </p>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3" style="display: none;">
      <div class="card card-custom bgi-no-repeat gutter-b card-stretch" style="background-color: #1B283F; background-position: 0 calc(100% + 0.5rem); background-size: 100% auto; background-image: url(assets/media/svg/patterns/rhone.svg)">
        <div class="card-body">
          <div class="p-4">
            <h3 class="text-white font-weight-bolder my-7">Create CRM Reports</h3>
            <p class="text-muted font-size-lg mb-7">
              Cause marketing is marketing  <br/>
              done by a for-profit business  <br/>
              that seeks to increase profits <br/>
              to better society
            </p>
            <a href='#' class="btn btn-danger font-weight-bold px-6 py-3">Create Report</a>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
@section('script')
  <script src="/demo/assets/plugins/custom/fullcalendar/fullcalendar.bundle.js?v=7.0.6"></script>
  <script src="/demo/assets/js/pages/widgets.js?v=7.0.6"></script>
@endsection
