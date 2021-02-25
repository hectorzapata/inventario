<?php

namespace Modules\Principales\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Illuminate\Support\Facades\Storage;
use Yajra\Datatables\Datatables;
use \Carbon\Carbon;
use \Modules\Principales\Entities\Principal;
use \Modules\Productos\Entities\Producto;

class PrincipalesController extends Controller{
  public function __construct(){
    $this->dropbox = Storage::disk('dropbox')->getDriver()->getAdapter()->getClient();
  }
  public function index(){
    return view('principales::index');
  }
  public function create(){
    $data['productos'] = Producto::with('Categoria')->where('activo', 1)->get();
    return view('principales::create')->with($data);
  }
  public function store(Request $request){
    try {
      $data = $request->all();
      $nombre = \Carbon\Carbon::now()->timestamp . "_" . $request->file('imagen')->getClientOriginalName();
      Storage::disk('dropbox')->putFileAs(
        '/',
        $request->file('imagen'),
        $nombre
      );
      $response = $this->dropbox->createSharedLinkWithSettings( $nombre, ["requested_visibility" => "public"] );
      $data['imagen'] = str_replace('dl=0', 'raw=1', $response['url']);
      $producto = Principal::create($data);
      flash('Principal registrado con éxito')->success();
      return redirect("/principales");
    } catch (\Exception $e) {
      $mensaje = "Lo sentimos, ha ocurrido un error al intentar crear el registro";
      if ( strpos($request->server->get('HTTP_HOST'), "localhost") !== false ) {
        $mensaje .= "| " . $e->getMessage();
      }
      flash($mensaje)->warning();
      return back()->withInput($request->input());
    }
  }
  public function tabla(Request $request){
    setlocale(LC_TIME, 'es_ES');
    \DB::statement("SET lc_time_names = 'es_ES'");
    $registros = Principal::with('Producto')->where('activo', 1);
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
          "href" => "/principales/$value->id/edit"
        ]
      ];
      $value->acciones = generarDropdown($acciones);
    }
    $datatable->setData($data);
    return $datatable;
  }
  public function edit($id){
    $data['data'] = Principal::find($id);
    $data['productos'] = Producto::with('Categoria')->where('activo', 1)->get();
    return view('principales::create')->with($data);
  }
  public function update($id, Request $request){
    try {
      $producto = Principal::findOrFail($id);
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
      $producto->fill($data);
      $producto->save();
      flash('Principal actualizado con éxito')->success();
      return redirect("/principales");
    } catch (\Exception $e) {
      $mensaje = "Lo sentimos, ha ocurrido un error al intentar actualizar el registro";
      flash($mensaje)->warning();
      return back()->withInput($request->input());
    }
  }
}
