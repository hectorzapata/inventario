<?php

namespace Modules\EquipoMedico\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Illuminate\Support\Facades\Storage;
use Yajra\Datatables\Datatables;
use \Carbon\Carbon;
use \Modules\EquipoMedico\Entities\EquipoMedico;
use \Modules\Catalogos\Entities\Marca;
use \Modules\Catalogos\Entities\Pais;
use \Modules\Catalogos\Entities\Planta;
use \Modules\Catalogos\Entities\ServicioHospitalario;
use \Modules\Catalogos\Entities\SituacionActual;

class EquipoMedicoController extends Controller{
  public function index(){
    return view('equipomedico::index');
  }
  public function create(){
    $data = [];
    $data['marca'] = Marca::where('activo', 1)->get();
    $data['pais'] = Pais::where('activo', 1)->get();
    $data['planta'] = Planta::where('activo', 1)->get();
    $data['servicioHospitalario'] = ServicioHospitalario::where('activo', 1)->get();
    $data['situacionActual'] = SituacionActual::where('activo', 1)->get();
    return view('equipomedico::create')->with($data);
  }
  public function store(Request $request){
    try {
      $em = EquipoMedico::create($request->all());
      flash('Equipo médico registrado con éxito')->success();
      return redirect("/equipomedico");
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
    $registros = EquipoMedico::
    with('Marca')->
    where('activo', 1);
    $datatable = DataTables::of($registros)
      ->editColumn('created_at', function ($reg) {
        return $reg->created_at ? ucwords(Carbon::parse($reg->created_at)->formatLocalized('%d %B %Y')) : '';
      })
      ->filterColumn('created_at', function ($query, $keyword) {
        $query->whereRaw("DATE_FORMAT(created_at,'%d %M %Y') like ?", ["%$keyword%"]);
      })
      // ->editColumn('precio', function ($reg) {
      //   setlocale(LC_MONETARY, 'es_MX');
      //   return "$" . money_format('%i', $reg->precio);
      // })
      // ->editColumn('pesoPromedio', function ($reg) {
      //   return $reg->pesoPromedio . " Kg";
      // })
      ->make(true);
    //Cueri
    $data = $datatable->getData();
    foreach ($data->data as $key => $value) {
      $acciones = [
        "QR" => [
          "href" => "/equipomedico/$value->id/qr"
        ],
        "Editar" => [
          "icon" => "edit blue",
          "href" => "/equipomedico/$value->id/edit"
        ]
      ];
      $value->acciones = generarDropdown($acciones);
    }
    $datatable->setData($data);
    return $datatable;
  }
  public function edit($id){
    $data['data'] = EquipoMedico::find($id);
    $data['marca'] = Marca::where('activo', 1)->get();
    $data['pais'] = Pais::where('activo', 1)->get();
    $data['planta'] = Planta::where('activo', 1)->get();
    $data['servicioHospitalario'] = ServicioHospitalario::where('activo', 1)->get();
    $data['situacionActual'] = SituacionActual::where('activo', 1)->get();
    // $data['categorias'] = Categoria::where('activo', 1)->get();
    return view('equipomedico::create')->with($data);
  }
  public function update($id, Request $request){
    try {
      $em = EquipoMedico::findOrFail($id);
      $em->fill($request->all());
      $em->save();
      flash('Equipo médico actualizado con éxito')->success();
      return redirect("/equipomedico");
    } catch (\Exception $e) {
      $mensaje = "Lo sentimos, ha ocurrido un error al intentar actualizar el registro";
      flash($mensaje)->warning();
      return back()->withInput($request->input());
    }
  }
  public function qr($id){
    $data['data'] = EquipoMedico::find($id);
    return view('equipomedico::qr')->with($data);
  }
}
