<?php

namespace App\Modules\Pedidos\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Extensions\Kendo2QueryBuilder;
use App\Modules\BaseModel;

use DB;

class Pedidos extends BaseModel
{
    use SoftDeletes;
    //use Notifiable;
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $table = 'pedidos'; 
    protected $dates = ['created_at', 'updated_at','deleted_at'];
    protected $casts = [
 
       'created_at' => 'datetime:d/m/Y H:i:s',
     ];
     /**
      * The attributes that are mass assignable.
      *
      * @var array
      */
     /* 
     protected $fillable = [
     ];
     */
     protected $guarded = [];
 

    public static function getAll($filters, $skip, $pageSize, $sort) {
        $query = static::select('pedidos.id as id',
            'pedidos.mesa as mesa',
        'pedidos.client as client',
        DB::raw("SUM(pl.price*det.cantidad) AS monto"),
        'pedidos.date as date',
        'pedidos.updated_at as updated_at')
        ->Join('detalle_pedidos_platos as det','det.pedido_id','=','pedidos.id')
        ->Join('platos as pl','det.plato_id','=','pl.id')
        ->groupBy('pedidos.mesa')
        ->groupBy('pedidos.client')
        ->groupBy('pedidos.date')->orderBy('pedidos.id', 'desc')
        ->wherenull('det.deleted_at')
        ->wherenull('pedidos.deleted_at');
					 
        if (empty($filters)) {
          $filters = [];
        }
        $kQuery = new Kendo2QueryBuilder($query);
        $query = $kQuery->buildQueryFromKendoFilter($filters);
        $count = $query->count();
        if ($sort) {
          $query = $query->orderBy($sort['field'], $sort['dir']);
        }
        $query = $query->get()->toArray();
        $count = count($query);
        
        if ($pageSize) {
            $query = array_slice($query,$skip,$pageSize);
        }else{
            $query = $query;
        }

        $data['data']  = $query;
        $data['total'] = $count;
    
        return $data;
    }
}