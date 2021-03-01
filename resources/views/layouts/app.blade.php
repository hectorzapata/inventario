@php
  $actual = explode("/", $_SERVER['REQUEST_URI'])[1];
  $user = Auth::user();
@endphp
<!DOCTYPE html>
<html lang="en" >
<!--begin::Head-->
<head><base href="">
  <meta charset="utf-8"/>
  <title>{{ getenv('APP_NAME') }}</title>
  <meta name="description" content="Updates and statistics"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
  <!--begin::Fonts-->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700"/>
  <!--end::Fonts-->
  @yield('style')
  <style media="screen">
    .breadcrumb-item.enlace > a{
      color: #3445E5 !important;
    }
  </style>
  <!--begin::Global Theme Styles(used by all pages)-->
  <link href="/demo/assets/plugins/global/plugins.bundle.css?v=7.0.6" rel="stylesheet" type="text/css"/>
  <link href="/demo/assets/plugins/custom/prismjs/prismjs.bundle.css?v=7.0.6" rel="stylesheet" type="text/css"/>
  <link href="/demo/assets/css/style.bundle.css?v=7.0.6" rel="stylesheet" type="text/css"/>
  <!--end::Global Theme Styles-->
  <!--begin::Layout Themes(used by all pages)-->
  <!--end::Layout Themes-->
  <link rel="shortcut icon" href="/demo/assets/media/logos/favicon.ico"/>
</head>
<!--end::Head-->
<!--begin::Body-->
<body  id="kt_body"  class="header-fixed header-mobile-fixed subheader-enabled page-loading"  >
  <!--begin::Main-->
  <!--begin::Header Mobile-->
  <div id="kt_header_mobile" class="header-mobile  header-mobile-fixed " >
    <div class="d-flex align-items-center">
      <!--begin::Logo-->
      <a href="index.html" class="mr-7">
        <img alt="Logo" src="/demo/assets/media/logos/logo-letter-5.png" class="max-h-30px"/>
      </a>
      <!--end::Logo-->
    </div>
    <!--begin::Toolbar-->
    <div class="d-flex align-items-center">
      <button class="btn p-0 burger-icon ml-4" id="kt_header_mobile_toggle">
        <span></span>
      </button>
      <button class="btn p-0 ml-2" id="kt_header_mobile_topbar_toggle">
        <span class="svg-icon svg-icon-xl">
          <!--begin::Svg Icon | path:assets/media/svg/icons/General/User.svg-->
          <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
              <polygon points="0 0 24 0 24 24 0 24"/>
              <path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
              <path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" fill="#000000" fill-rule="nonzero"/>
            </g>
          </svg>
          <!--end::Svg Icon-->
        </span>
      </button>
    </div>
    <!--end::Toolbar-->
  </div>
  <!--end::Header Mobile-->
  <div class="d-flex flex-column flex-root">
    <!--begin::Page-->
    <div class="d-flex flex-row flex-column-fluid page">
      <!--begin::Wrapper-->
      <div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
        <!--begin::Header-->
        <div id="kt_header" class="header flex-column  header-fixed " >
          <!--begin::Top-->
          <div class="header-top">
            <!--begin::Container-->
            <div class=" container ">
              <!--begin::Left-->
              <div class="d-none d-lg-flex align-items-center mr-3">
                <!--begin::Logo-->
                <a href="index.html" class="mr-10">
                  <img alt="Logo" src="/demo/assets/media/logos/logo-letter-5.png" class="max-h-35px"/>
                </a>
                <!--end::Logo-->
              </div>
              <!--end::Left-->
              <!--begin::Topbar-->
              <div class="topbar">
                <!--begin::User-->
                <div class="topbar-item">
                  <div class="btn btn-icon w-auto d-flex align-items-center btn-lg px-2" id="kt_quick_user_toggle">
                    <div class="d-flex text-right pr-3">
                      <span class="text-white opacity-50 font-weight-bold font-size-sm d-none d-md-inline mr-1">Hola,</span>
                      <span class="text-white font-weight-bolder font-size-sm d-none d-md-inline">{{ $user->name }}</span>
                    </div>
                    <span class="symbol symbol-35">
                      <span class="symbol-label font-size-h5 font-weight-bold text-white bg-white-o-15">{{ mb_strtoupper($user->name[0], 'UTF-8') }}</span>
                    </span>
                  </div>
                </div>
                <!--end::User-->
              </div>
              <!--end::Topbar-->
            </div>
            <!--end::Container-->
          </div>
          <!--end::Top-->
          <!--begin::Bottom-->
          <div class="header-bottom">
            <!--begin::Container-->
            <div class=" container ">
              <!--begin::Header Menu Wrapper-->
              <div class="header-menu-wrapper header-menu-wrapper-left" id="kt_header_menu_wrapper">
                <!--begin::Header Menu-->
                <div id="kt_header_menu" class="header-menu header-menu-left header-menu-mobile  header-menu-layout-default " >
                  <!--begin::Header Nav-->
                  <ul class="menu-nav ">
                    <li class="menu-item menu-item{{ $actual == "dashboard" ? '-active' : '' }}" aria-haspopup="true">
                      <a href="/dashboard" class="menu-link">
                        <span class="menu-text">Dashboard</span>
                      </a>
                    </li>
                    @foreach (obtenerModulosActivos() as $key => $value)
                      @php
                        $alias = $value->get('alias');
                      @endphp
                      <li class="menu-item menu-item{{ $actual == $alias ? '-active' : '' }}" aria-haspopup="true">
                        <a href="/{{ $alias }}" class="menu-link">
                          <span class="menu-text">{{ $value->get('name') }}</span>
                        </a>
                      </li>
                    @endforeach
                    <li class="menu-item menu-item-submenu menu-item-rel"  data-menu-toggle="click" aria-haspopup="true" style="display: none;">
                      <a  href="javascript:;" class="menu-link menu-toggle">
                        <span class="menu-text">Features</span>
                        <span class="menu-desc"></span>
                        <i class="menu-arrow"></i>
                      </a>
                      <div class="menu-submenu menu-submenu-classic menu-submenu-left" >
                        <ul class="menu-subnav">
                          <li class="menu-item  menu-item-submenu"  data-menu-toggle="hover" aria-haspopup="true">
                            <a  href="javascript:;" class="menu-link menu-toggle">
                              <span class="svg-icon menu-icon">
                                <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Add-user.svg-->
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                  <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <polygon points="0 0 24 0 24 24 0 24"/>
                                    <path d="M18,8 L16,8 C15.4477153,8 15,7.55228475 15,7 C15,6.44771525 15.4477153,6 16,6 L18,6 L18,4 C18,3.44771525 18.4477153,3 19,3 C19.5522847,3 20,3.44771525 20,4 L20,6 L22,6 C22.5522847,6 23,6.44771525 23,7 C23,7.55228475 22.5522847,8 22,8 L20,8 L20,10 C20,10.5522847 19.5522847,11 19,11 C18.4477153,11 18,10.5522847 18,10 L18,8 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                    <path d="M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z" fill="#000000" fill-rule="nonzero"/>
                                  </g>
                                </svg>
                                <!--end::Svg Icon-->
                              </span>
                              <span class="menu-text">Bootstrap</span>
                              <i class="menu-arrow"></i>
                            </a>
                            <div class="menu-submenu menu-submenu-classic menu-submenu-right" >
                              <ul class="menu-subnav">
                                <li class="menu-item "  aria-haspopup="true">
                                  <a  href="features/bootstrap/typography.html" class="menu-link ">
                                    <i class="menu-bullet menu-bullet-dot">
                                      <span></span>
                                    </i>
                                    <span class="menu-text">Typography</span>
                                  </a>
                                </li>
                                <li class="menu-item "  aria-haspopup="true">
                                  <a  href="features/bootstrap/buttons.html" class="menu-link ">
                                    <i class="menu-bullet menu-bullet-dot">
                                      <span></span>
                                    </i>
                                    <span class="menu-text">Buttons</span>
                                  </a>
                                </li>
                              </ul>
                            </div>
                          </li>
                          <li class="menu-item "  aria-haspopup="true">
                            <a target="_blank" href="https://preview.keenthemes.com/metronic/preview/demo12/builder.html" class="menu-link "><span class="svg-icon menu-icon">
                              <!--begin::Svg Icon | path:assets/media/svg/icons/Home/Library.svg-->
                              <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                  <rect x="0" y="0" width="24" height="24"/>
                                  <path d="M5,3 L6,3 C6.55228475,3 7,3.44771525 7,4 L7,20 C7,20.5522847 6.55228475,21 6,21 L5,21 C4.44771525,21 4,20.5522847 4,20 L4,4 C4,3.44771525 4.44771525,3 5,3 Z M10,3 L11,3 C11.5522847,3 12,3.44771525 12,4 L12,20 C12,20.5522847 11.5522847,21 11,21 L10,21 C9.44771525,21 9,20.5522847 9,20 L9,4 C9,3.44771525 9.44771525,3 10,3 Z" fill="#000000"/>
                                  <rect fill="#000000" opacity="0.3" transform="translate(17.825568, 11.945519) rotate(-19.000000) translate(-17.825568, -11.945519) " x="16.3255682" y="2.94551858" width="3" height="18" rx="1"/>
                                </g>
                              </svg>
                              <!--end::Svg Icon-->
                            </span><span class="menu-text">Layout Builder</span></a>
                          </li>
                        </ul>
                      </div>
                    </li>
                  </ul>
                  <!--end::Header Nav-->
                </div>
                <!--end::Header Menu-->
              </div>
              <!--end::Header Menu Wrapper-->
            </div>
            <!--end::Container-->
          </div>
          <!--end::Bottom-->
        </div>
        <!--end::Header-->
        <!--begin::Content-->
        <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
          <!--begin::Subheader-->
          <div class="subheader py-2 py-lg-6 subheader-transparent" id="kt_subheader">
            <div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
              @yield('breadcumb')
            </div>
          </div>
          <!--end::Subheader-->
          <!--begin::Entry-->
          <div class="d-flex flex-column-fluid">
            <!--begin::Container-->
            <div class="container">
              @yield('content')
            </div>
            <!--end::Container-->
          </div>
          <!--end::Entry-->
        </div>
        <!--end::Content-->
        <!--begin::Footer-->
        <div class="footer bg-white py-4 d-flex flex-lg-column " id="kt_footer">
          <!--begin::Container-->
          <div class=" container  d-flex flex-column flex-md-row align-items-center justify-content-between">
            <!--begin::Copyright-->
            <div class="text-dark order-2 order-md-1">
              <span class="text-muted font-weight-bold mr-2">2021&copy;</span>
              <a href="http://keenthemes.com/metronic" target="_blank" class="text-dark-75 text-hover-primary">{{ getenv('APP_NAME') }}</a>
            </div>
            <!--end::Copyright-->
          </div>
          <!--end::Container-->
        </div>
        <!--end::Footer-->
      </div>
      <!--end::Wrapper-->
    </div>
    <!--end::Page-->
  </div>
  <!--end::Main-->
  <!-- begin::User Panel-->
  <div id="kt_quick_user" class="offcanvas offcanvas-right p-10">
    <!--begin::Header-->
    <div class="offcanvas-header d-flex align-items-center justify-content-between pb-5">
      <h3 class="font-weight-bold m-0">
        Perfil de usuario
      </h3>
      <a href="#" class="btn btn-xs btn-icon btn-light btn-hover-primary" id="kt_quick_user_close">
        <i class="ki ki-close icon-xs text-muted"></i>
      </a>
    </div>
    <!--end::Header-->
    <!--begin::Content-->
    <div class="offcanvas-content pr-5 mr-n5">
      <!--begin::Header-->
      <div class="d-flex align-items-center mt-5">
        <div class="d-flex flex-column">
          <a href="#" class="font-weight-bold font-size-h5 text-dark-75 text-hover-primary">
            {{ $user->name }}
          </a>
          <div class="navi mt-2">
            <a href="#" class="navi-item">
              <span class="navi-link p-0 pb-2">
                <span class="navi-icon mr-1">
                  <span class="svg-icon svg-icon-lg svg-icon-primary">
                    <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Mail-notification.svg-->
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                      <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <rect x="0" y="0" width="24" height="24"/>
                        <path d="M21,12.0829584 C20.6747915,12.0283988 20.3407122,12 20,12 C16.6862915,12 14,14.6862915 14,18 C14,18.3407122 14.0283988,18.6747915 14.0829584,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,8 C3,6.8954305 3.8954305,6 5,6 L19,6 C20.1045695,6 21,6.8954305 21,8 L21,12.0829584 Z M18.1444251,7.83964668 L12,11.1481833 L5.85557487,7.83964668 C5.4908718,7.6432681 5.03602525,7.77972206 4.83964668,8.14442513 C4.6432681,8.5091282 4.77972206,8.96397475 5.14442513,9.16035332 L11.6444251,12.6603533 C11.8664074,12.7798822 12.1335926,12.7798822 12.3555749,12.6603533 L18.8555749,9.16035332 C19.2202779,8.96397475 19.3567319,8.5091282 19.1603533,8.14442513 C18.9639747,7.77972206 18.5091282,7.6432681 18.1444251,7.83964668 Z" fill="#000000"/>
                        <circle fill="#000000" opacity="0.3" cx="19.5" cy="17.5" r="2.5"/>
                      </g>
                    </svg>
                    <!--end::Svg Icon-->
                  </span>
                </span>
                <span class="navi-text text-muted text-hover-primary">{{ $user->email }}</span>
              </span>
            </a>
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="btn btn-sm btn-light-primary font-weight-bolder py-2 px-5">Cerrar sesión</a>
          </div>
        </div>
      </div>
      <!--end::Header-->
    </div>
    <!--end::Content-->
  </div>
  <!-- end::User Panel-->
  <!--begin::Scrolltop-->
  <div id="kt_scrolltop" class="scrolltop">
    <span class="svg-icon">
      <!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Up-2.svg-->
      <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
          <polygon points="0 0 24 0 24 24 0 24"/>
          <rect fill="#000000" opacity="0.3" x="11" y="10" width="2" height="10" rx="1"/>
          <path d="M6.70710678,12.7071068 C6.31658249,13.0976311 5.68341751,13.0976311 5.29289322,12.7071068 C4.90236893,12.3165825 4.90236893,11.6834175 5.29289322,11.2928932 L11.2928932,5.29289322 C11.6714722,4.91431428 12.2810586,4.90106866 12.6757246,5.26284586 L18.6757246,10.7628459 C19.0828436,11.1360383 19.1103465,11.7686056 18.7371541,12.1757246 C18.3639617,12.5828436 17.7313944,12.6103465 17.3242754,12.2371541 L12.0300757,7.38413782 L6.70710678,12.7071068 Z" fill="#000000" fill-rule="nonzero"/>
        </g>
      </svg>
      <!--end::Svg Icon-->
    </span>
  </div>
  <!--end::Scrolltop-->
  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    {{ csrf_field() }}
  </form>
  {{-- <script>var HOST_URL = "https://preview.keenthemes.com/metronic/theme/html/tools/preview";</script> --}}
  <!--begin::Global Config(global config for global JS scripts)-->
  <script>
  var KTAppSettings = {
    "breakpoints": {
      "sm": 576,
      "md": 768,
      "lg": 992,
      "xl": 1200,
      "xxl": 1200
    },
    "colors": {
      "theme": {
        "base": {
          "white": "#ffffff",
          "primary": "#0BB783",
          "secondary": "#E5EAEE",
          "success": "#1BC5BD",
          "info": "#8950FC",
          "warning": "#FFA800",
          "danger": "#F64E60",
          "light": "#F3F6F9",
          "dark": "#212121"
        },
        "light": {
          "white": "#ffffff",
          "primary": "#D7F9EF",
          "secondary": "#ECF0F3",
          "success": "#C9F7F5",
          "info": "#EEE5FF",
          "warning": "#FFF4DE",
          "danger": "#FFE2E5",
          "light": "#F3F6F9",
          "dark": "#D6D6E0"
        },
        "inverse": {
          "white": "#ffffff",
          "primary": "#ffffff",
          "secondary": "#212121",
          "success": "#ffffff",
          "info": "#ffffff",
          "warning": "#ffffff",
          "danger": "#ffffff",
          "light": "#464E5F",
          "dark": "#ffffff"
        }
      },
      "gray": {
        "gray-100": "#F3F6F9",
        "gray-200": "#ECF0F3",
        "gray-300": "#E5EAEE",
        "gray-400": "#D6D6E0",
        "gray-500": "#B5B5C3",
        "gray-600": "#80808F",
        "gray-700": "#464E5F",
        "gray-800": "#1B283F",
        "gray-900": "#212121"
      }
    },
    "font-family": "Poppins"
  };
  </script>
  <!--end::Global Config-->
  <!--begin::Global Theme Bundle(used by all pages)-->
  <script src="/demo/assets/plugins/global/plugins.bundle.js?v=7.0.6"></script>
  <script src="/demo/assets/plugins/custom/prismjs/prismjs.bundle.js?v=7.0.6"></script>
  <script src="/demo/assets/js/scripts.bundle.js?v=7.0.6"></script>
  <!--end::Global Theme Bundle-->
  @yield('script')
</body>
<!--end::Body-->
</html>
