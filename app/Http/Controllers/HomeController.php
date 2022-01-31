<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Complex\Exception;
use Illuminate\Support\Facades\View;
use App\Modules\Pedidos\Entities\Pedidos;
use App\Modules\Pedidos\Entities\Detalle_pedidos;
use \Carbon\Carbon;
use DB;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth',['except'=>['index']]);
        $this->middleware('guest')->only('index');
    }


        /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    // INDEX REDIRECCION A LOGIN
    public function index()
    {
        try {
            return view('auth.login');
        } catch (\Exception $e) {
            return view('errors.mysqlerror');
        }
    }

    // DESPUES DE LOGUEARSE REDIRECCIONA A LA PAGINA PRINCIPAL DASHBOARD

    public function dashboard()
    {
        return view('layouts.dashboard');
    }

    // MEDOTO PARA LA VISUALIZACIÓN DEL PERFIL DEL USUARIO, ESQUINA SUPERIOR DERECHA DEL DASHBOARD
    public function profile()
    {
        $user = auth()->user();
        return view('layouts.profile', compact('user'));
    }

    // METODO DEL GRID DE LA LISTA DE PEDIDOS

    public function pedidosload(Request $request) 
    {
        $filtros = json_encode($request->input());
      
        $filter   = $request->input('filter', []);
        $skip     = $request->input('skip');
        $pageSize = $request->input('pageSize');
        $sort     = [];
        return Pedidos::getAll($filter, $skip, $pageSize, $sort);
    }

    // METODOS DE CREACIÓN DE PEDIDOS

    public function create ()
    {
        $fecha_actual=Carbon::now()->toDateTimeString();
        return view('Pedidos::partials.create-pedidos',compact('fecha_actual'));
    }

    public function store(Request $request)
    {
      $filtros = json_encode($request->input());
        if($request->client){
            $datapedidos = new Pedidos();
            $datapedidos->date = strtoupper($request->date);
            $datapedidos->mesa = strtoupper($request->mesa);
            $datapedidos->client = strtoupper($request->client);
            $datapedidos->updated_at = null;
            $datapedidos->save();
        }else{
            $datapedidos = new Pedidos();
            $datapedidos->date = strtoupper($request->date);
            $datapedidos->mesa = strtoupper($request->mesa);
            $datapedidos->client = "CLIENTE VARIOS";
            $datapedidos->updated_at = null;
            $datapedidos->save();
        }
        $orden = HomeController::getidentificador();
        $detalle = HomeController::insertDetalles($request,$orden[0]);
        return json_encode(true);
    }

    // METODOS DE EDICIÓN DE PEDIDOS

    public function edit(Pedidos $pedidos)
    {
        $detalle = HomeController::getplatos($pedidos->id);
        return view('Pedidos::partials.edit-pedidos',compact('pedidos','detalle'));
    }

    public function update(Request $request) 
    {
        $pedido = Pedidos::find($request->id);
        $pedido->date = strtoupper($request->date);
        $pedido->mesa = strtoupper($request->mesa);
        $pedido->client = strtoupper($request->client);
        $pedido->updated_at = Carbon::now()->toDateTimeString();
        $pedido->save();

        $deleteDetail = HomeController::deleteDetalles($request->id);
        $insertDetail = HomeController::insertDetalles($request,$request->id);
        return json_encode(true);
    }

    // METODOS DE ELIMINACIÓN DE PEDIDOS

    public function delete(Pedidos $pedidos) 
    {
        return view('Pedidos::partials.delete-pedidos', compact('pedidos'));
    }

    public function destroy(Pedidos $pedidos) 
    {
        $pedido = Pedidos::find($pedidos->id);
        $pedido->delete();

        $detalle = HomeController::deleteDetalles($pedidos->id);
        return json_encode(true);
    }

    // ----------------------------------------------------------------------------------------------------

    public function deleteDetalles($id){
        $detalle = HomeController::getplatos($id);
        foreach ($detalle as $clave => $valor){
            $plato = Detalle_pedidos::find($valor->id);
            $plato->delete();
        }
        return json_encode(true);
    }

    public function getplatos($id_pedido) {
		$query = DB::table('detalle_pedidos_platos as d')
				->select('d.id','d.pedido_id','d.plato_id','d.cantidad')
                ->where('d.pedido_id','=',$id_pedido)
                ->wherenull('d.deleted_at')
				->get()->toArray();
		return $query;
	}

    public function getidentificador() {
		$query = DB::table('pedidos as p')
				->select(DB::raw("MAX(p.id) AS max_id"))
				->get()->pluck('max_id')->toArray();
		return $query;
	}

    public function insertDetalles($request,$orden) {
        if($request->r_ajidegallina){
            $detalle =new Detalle_pedidos();
            $detalle->pedido_id  = $orden;
            $detalle->plato_id = 1;
            $detalle->cantidad= $request->r_ajidegallina;
            $detalle->updated_at= null;
            $detalle->save();
        }
        if($request->r_tallarinconpollo){
            $detalle =new Detalle_pedidos();
            $detalle->pedido_id  = $orden;
            $detalle->plato_id = 2;
            $detalle->cantidad= $request->r_tallarinconpollo;
            $detalle->updated_at= null;
            $detalle->save();
        }
        if($request->r_lomosaltado){
            $detalle =new Detalle_pedidos();
            $detalle->pedido_id  = $orden;
            $detalle->plato_id = 3;
            $detalle->cantidad= $request->r_lomosaltado;
            $detalle->updated_at= null;
            $detalle->save();
        }
        if($request->r_estofadodepollo){
            $detalle =new Detalle_pedidos();
            $detalle->pedido_id  = $orden;
            $detalle->plato_id = 4;
            $detalle->cantidad= $request->r_estofadodepollo;
            $detalle->updated_at= null;
            $detalle->save();
        }
        if($request->r_tacutacu){
            $detalle =new Detalle_pedidos();
            $detalle->pedido_id  = $orden;
            $detalle->plato_id = 5;
            $detalle->cantidad= $request->r_tacutacu;
            $detalle->updated_at= null;
            $detalle->save();
        }
        if($request->r_chicharron){
            $detalle =new Detalle_pedidos();
            $detalle->pedido_id  = $orden;
            $detalle->plato_id = 6;
            $detalle->cantidad= $request->r_chicharron;
            $detalle->updated_at= null;
            $detalle->save();
        }
	}

    // ----------------------------------------------------------------------------------------------------

    public function defaultGrid()
    {
        return ['data' => [], 'total' => 0];
    }

}
