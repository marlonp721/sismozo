<?php

namespace App\Modules\Pedidos\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Extensions\Kendo2QueryBuilder;
use App\Modules\BaseModel;
use DB;

class Detalle_pedidos extends BaseModel
{
    use SoftDeletes;
    //use Notifiable;
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $table = 'detalle_pedidos_platos'; 
    // protected $dates = ['created_at', 'updated_at','deleted_at'];
    // protected $casts = [
 
    //    'created_at' => 'datetime:d/m/Y H:i:s',
    //  ];
     /**
      * The attributes that are mass assignable.
      *
      * @var array
      */
      
     protected $fillable = [
         'pedido_id', 'plato_id',
         'cant'
     ];
     
     protected $guarded = [];
 

    // public static function getAll($filters, $skip, $pageSize, $sort) {
    //     $query = static::select('pedidos.id as id',
    //         'pedidos.mesa as mesa',
    //     'pedidos.client as client',
    //     DB::raw("SUM(pl.price*det.cant) AS monto"),
    //     'pedidos.date as date')
    //     ->Join('detalle_pedidos_platos as det','det.pedido_id','=','pedidos.id')
    //     ->Join('platos as pl','det.plato_id','=','pl.id')
    //     ->groupBy('pedidos.mesa')
    //     ->groupBy('pedidos.client')
    //     ->groupBy('pedidos.date');
					 
    //     if (empty($filters)) {
    //       $filters = [];
    //     }
    //     $kQuery = new Kendo2QueryBuilder($query);
    //     // $kQuery->setNamespace('pedidos', ['created_at']);
    //     $query = $kQuery->buildQueryFromKendoFilter($filters);
    //     $count = $query->count();
    //     if ($sort) {
    //       $query = $query->orderBy($sort['field'], $sort['dir']);
    //     }
    //     //dd($query->toSql(),$query->getBindings());
    //     // $query = $query->skip($skip)->take($pageSize)->get();
    //     $query = $query->get();
		
    //     $data['data']  = $query;
    //     $data['total'] = $count;
    
    //     return $data;
    // }

    protected function storeRequest($request)
    { 
            // return $request->fecha;
      DB::beginTransaction();

      try {

		$data = $request->all();
		$data['date'] = strtoupper($request->date);
		$data['mesa'] = strtoupper($request->mesa);
		$data['client'] = strtoupper($request->client);
        $data['updated_at'] = null;
        $pedidos = $this->create($data);
        DB::commit();

      } catch (\Exception $e) {

        DB::rollBack();
        abort(500);

      }
        return json_encode(true);
    }
	
	protected function updateRequest($stations, $request)
    {
        DB::beginTransaction();

        try {
			$departamento = DB::table('regions')->select('name')->where('id',$request->departamento)->get()->first();
			$provincia = DB::table('provinces')->select('name')->where('id',$request->provincia)->get()->first();
			$districts = DB::table('districts')->select('name')->where('id',$request->distrito)->get()->first();
			$data = $request->all();
			$data['departamento'] = strtoupper($departamento->name);
			$data['provincia'] = strtoupper($provincia->name);
			$data['distrito'] = strtoupper($districts->name);
			$data['centro_polado'] = strtoupper($request->centro_polado);
            $stations->update($data);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            abort(500);
        }

        return json_encode(true);
    }
	
	protected function destroyRequest($stations)
    {
        DB::beginTransaction();

        try {
            $stations->delete();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            abort(500);
        }

        return json_encode(true);
    }
}