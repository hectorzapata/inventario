<?php
if (! function_exists('obtenerModuloActual')) {
  function obtenerModuloActual() {
    $namespace = Route::current()->action['namespace'];
    $namespace = explode("\\", $namespace);
    if ( $namespace[0] == "Modules" ) {
      return Module::find( $namespace[1] )->json();
    }
    return false;
  }
}
if (! function_exists('obtenerModulosActivos')) {
  function obtenerModulosActivos() {
    $modulos = Module::all();
    $tmp = [];
    foreach ($modulos as $key => $value) {
      if ($value->get('active') === 0) {
        unset($modulos[$key]);
      }else {
        $tmp[( $titulo = $value->get('titulo') ) ? $titulo : $value->get('name')] = $value;
      }
    }
    ksort($tmp);
    return $tmp;
  }
}
if (!function_exists('generarDropdown')) {
  function generarDropdown( $acciones = [] ){
    if (count($acciones) > 0) {
      /*
      <div class='dropdown dropdown-inline mr-4'>
        <button type='button' class='btn btn-light-primary btn-icon btn-sm' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
            <i class='ki ki-bold-more-hor'></i>
        </button>
        <div class='dropdown-menu'>
          <a class='dropdown-item' href='#'>Action</a>
          <a class='dropdown-item' href='#'>Another action</a>
          <a class='dropdown-item' href='#'>Something else here</a>
          <div class='dropdown-divider'></div>
          <a class='dropdown-item' href='#'>Separated link</a>
        </div>
      </div>
      */
      $dropdown =
        "<div class='dropdown dropdown-inline mr-4'>
          <button type='button' class='btn btn-light-primary btn-icon btn-sm' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
              <i class='ki ki-bold-more-hor'></i>
          </button>
          <div class='dropdown-menu'>";
      foreach ($acciones as $key => $value) {
        $attrData = "";
        if (array_key_exists('data', $value)) {
          foreach ($value['data'] as $keyData => $data) {
            $attrData .= " data-" . $keyData . "='" . $data . "'" ;
          }
        }
        if ( array_key_exists('onclick', $value) ) {
          $dropdown .=
            "<div class='dropdown-item' onclick=".$value["onclick"]." ".$attrData.">
              $key
            </div>";
        }else if(array_key_exists('href', $value)) {
          $dropdown .=
            "<a class='dropdown-item' href='".$value["href"]."' ".$attrData.
            (array_key_exists('target', $value) ? " target='".$value["target"]."'" : "").">
              $key
            </a>";
        }else if(array_key_exists('class', $value)) {
          $dropdown .=
            "<a class='dropdown-item " . $value["class"] . "' href='javascript:void(0);' ".$attrData.">
              $key
            </a>";
        }
      }
      $dropdown .= "</div></div>";
      return $dropdown;
    }
    return "";
  }
}
if (!function_exists('permiso')) {
  function permiso( $claveModulo, $accion = false ){
    $permisos = ( is_null(session()->get('permisos')) ) ? [] : session()->get('permisos');
    //dd($permisos);
    if (Auth::user()->activo == 2) {
      return true;
    }
    if ( array_key_exists($claveModulo, $permisos) ){
      if ($accion === false) {
        return true;
      }else{

        $accion = str_replace(' ', '_', $accion);
        //dd($accion, $claveModulo, in_array(strtolower($accion), $permisos[$claveModulo]));
        if ( in_array(strtolower($accion), $permisos[$claveModulo]) ) {
          return true;
        }
        return false;
      }
    }
    return false;
  }
}

if (!function_exists('usuariosConRol')) {
  function usuariosConRol( $rol ){
    $usuarios = \App\User::where('status', '!=', '0')
      ->where('roles', 'like', '%"'.$rol.'"%')
      ->get();
    return $usuarios;
  }
}
if (!function_exists('obtUsuariosConPermisos')) {
  function obtUsuariosConPermisos( $claveModulo, $permiso, $admin = false ){
    $tmp = [];
    $rolesConPermiso = \Modules\Usuarios\Entities\Rol::where('status', 1)
      ->get();
    foreach ($rolesConPermiso as $key => $value) {
      $permisos = json_decode($value->permisos);
      if ( array_key_exists($claveModulo, $permisos) && in_array(str_replace(' ', '_', $permiso), $permisos->$claveModulo)) {
        $xx = usuariosConRol($value->id)->map(function($x){
            return $x->id;
        })->toArray();
        $tmp = array_merge($tmp, $xx);
      }else{
        unset($rolesConPermiso[$key]);
      }
    }
    if ($admin === true) {
      $usuarios = \App\User::where('status', 2)->get()->pluck('id')->toArray();
      $tmp = array_merge($tmp, $usuarios);
    }
    return $tmp;
  }
}
if (!function_exists('plonGangster')) {
  function plonGangster( $e ){
    $plus = [
      'url' => $_SERVER['REQUEST_URI'],
      'agente' => $_SERVER['HTTP_USER_AGENT']
    ];
    if (Auth::user()) {
      $plus['user'] = Auth::user()->getAttributes();
    }
    \App\Log::create([
      'message' => $e->getMessage(),
      'plus' => json_encode($plus)
    ]);
  }
}
