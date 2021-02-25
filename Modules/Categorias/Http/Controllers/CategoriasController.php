<?php

namespace Modules\Categorias\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Yajra\Datatables\Datatables;
use \Carbon\Carbon;

use \Modules\Categorias\Entities\Categoria;

class CategoriasController extends Controller{
  public function __construct(){
    $this->dropbox = Storage::disk('dropbox')->getDriver()->getAdapter()->getClient();
  }
  public function index(){
    return view('categorias::index');
  }
  public function create(){
    return view('categorias::create');
  }
  public function store(Request $request){
    try {
      $nombre = \Carbon\Carbon::now()->timestamp . "_" . $request->file('imagen')->getClientOriginalName();
      Storage::disk('dropbox')->putFileAs(
        '/',
        $request->file('imagen'),
        $nombre
      );
      $response = $this->dropbox->createSharedLinkWithSettings( $nombre, ["requested_visibility" => "public"] );
      $url = str_replace('dl=0', 'raw=1', $response['url']);
      $cat = Categoria::create([
        'nombre' => $request->nombre,
        'imagen' => $url
      ]);
      flash('Categoría registrada con éxito')->success();
      return redirect("/categorias");
    } catch (\Exception $e) {
      $mensaje = "Lo sentimos, ha ocurrido un error al intentar crear el registro";
      flash($mensaje)->warning();
      return back()->withInput($request->input());
    }
  }
  public function tabla(Request $request){
    setlocale(LC_TIME, 'es_ES');
    \DB::statement("SET lc_time_names = 'es_ES'");
    $registros = Categoria::where('activo', 1);
    // dd($registros->toSql());
    $datatable = DataTables::of($registros)
      ->editColumn('created_at', function ($reg) {
        return $reg->created_at ? ucwords(Carbon::parse($reg->created_at)->formatLocalized('%d %B %Y')) : '';
      })
      ->filterColumn('created_at', function ($query, $keyword) {
        $query->whereRaw("DATE_FORMAT(created_at,'%d %M %Y') like ?", ["%$keyword%"]);
      })
      ->make(true);
    //Cueri
    $data = $datatable->getData();
    foreach ($data->data as $key => $value) {
      $acciones = [
        "Editar" => [
          "icon" => "edit blue",
          "href" => "/categorias/$value->id/edit"
        ]
      ];
      // if ( !permiso('ms001', 'Asignar permisos') ) {
      //   unset($acciones['Permisos']);
      // }
      // if ( !permiso('ms001', 'Ver detalles de usuario') ) {
      //   unset($acciones['Ver detalles']);
      // }
      // if ( !permiso('ms001', 'Eliminar usuario') ) {
      //   unset($acciones['Eliminar']);
      // }
      $value->acciones = generarDropdown($acciones);
    }
    $datatable->setData($data);
    return $datatable;
  }
  public function edit($id){
    $data['data'] = Categoria::find($id);
    return view('categorias::create')->with($data);
  }
  public function update($id, Request $request){
    try {
      $categoria = Categoria::findOrFail($id);
      $data = $request->all();
      if ( isset($data['imagen']) ) {
        $nombre = \Carbon\Carbon::now()->timestamp . "_" . $request->file('imagen')->getClientOriginalName();
        Storage::disk('dropbox')->putFileAs(
          '/',
          $request->file('imagen'),
          $nombre
        );
        $response = $this->dropbox->createSharedLinkWithSettings( $nombre, ["requested_visibility" => "public"] );
        $data['imagen'] = str_replace('dl=0', 'raw=1', $response['url']);
      }
      $categoria->fill($data);
      $categoria->save();
      flash('Categoría actualizada con éxito')->success();
      return redirect("/categorias");
    } catch (\Exception $e) {
      $mensaje = "Lo sentimos, ha ocurrido un error al intentar actualizar el registro";
      flash($mensaje)->warning();
      return back()->withInput($request->input());
    }
  }
}
