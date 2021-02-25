<?php

namespace Modules\Usuarios\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Illuminate\Support\Facades\Storage;
use Yajra\Datatables\Datatables;
use \Carbon\Carbon;
use \App\Models\User;

class UsuariosController extends Controller{
  public function __construct(){
    $this->dropbox = Storage::disk('dropbox')->getDriver()->getAdapter()->getClient();
  }
  public function index(){
    return view('usuarios::index');
  }
  public function create(){
    return view('usuarios::create');
  }
  public function store(Request $request){
    try {
      $data = $request->all();
      $data['password'] = bcrypt($data['password']);
      User::create($data);
      flash('Usuario registrado con éxito')->success();
      return redirect("/usuarios");
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
    $registros = User::where('id', '!=', 0);
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
          "href" => "/usuarios/$value->id/edit"
        ]
      ];
      $value->acciones = generarDropdown($acciones);
    }
    $datatable->setData($data);
    return $datatable;
  }
  public function edit($id){
    $data['data'] = User::find($id);
    return view('usuarios::create')->with($data);
  }
  public function update($id, Request $request){
    try {
      $data = $request->all();
      $user = User::findOrFail($id);
      unset($data["passwordconfirm"]);
      if ( is_null($data["password"]) ) {
        unset($data["password"]);
      }else{
        $data["password"] = bcrypt($data["password"]);
      }
      $user->fill($data);
      $user->save();
      flash('Usuario actualizado con éxito')->success();
      return redirect("/usuarios");
    } catch (\Exception $e) {
      $mensaje = "Lo sentimos, ha ocurrido un error al intentar actualizar el registro";
      flash($mensaje)->warning();
      return back()->withInput($request->input());
    }
  }
}
