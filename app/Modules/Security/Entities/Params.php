<?php

namespace App\Modules\Security\Entities;

use Illuminate\Database\Eloquent\Model;
use DB;

class Params extends Model {

  protected $fillable = [
      'updated_at',
      'created_at',
      'master',
      'name',
      'value',
      'valor'
    // 'technologyhiden'
  ];

  public static function getByType($selectType) {
    return static::where('PARAM_MASTER_ID', $selectType)->orderBy('name', 'desc')->get()->pluck('valor', 'name');
  }

  public static function EquipmentType() {
    return static::where('PARAM_MASTER_ID', 3)->orderBy('name', 'desc')->get()->pluck('valor', 'valor');
  }

  public static function getByName($selectName) {

    $valor = static::select('valor')->where('NAME', $selectName)->orderBy('name', 'desc')->get()->toArray();

    return $valor[0]['valor'];
  }

  public static function getBySite($selectSite) {

    $site = config('custom_arrays.site');

    return $site[$selectSite];
  }

  public static function getByStatus($selectStatus) {

    $status = config('custom_arrays.status');

    return $status[$selectStatus];
  }

  public static function getBycompany($selectCompany) {

    $status = DB::table('params')->select('value')->where('name',$selectCompany)->first();
      

    return $status->value;
  }

  public static function getEmail($valor) {

    $query = DB::table('param_master')
      ->select('parametros.name as campo', 'parametros.valor as correo_nombre')
      ->join('params as parametros', 'parametros.param_master_id', '=', 'param_master.id')
      ->orderBy('parametros.id', 'asc');
    // ->leftJoin('locations as loc', 'loc.id', '=', 'e1.location_id');

    $query = $query->where('param_master.name', '=', $valor);

    $query = $query->get();

    return $query;
  }

  public static function getTecnology() {

    $query = DB::table('params')
      ->select('params.name', 'params.valor')
      ->join('param_master', 'params.param_master_id', '=', 'param_master.id');
    // ->leftJoin('locations as loc', 'loc.id', '=', 'e1.location_id');

    $query = $query->where('param_master.name', '=', 'tipo_tecnologia');

    $query = $query->get()->pluck('valor', 'name');

    foreach ($query as $key => $value) {

      $query[$key] = strtoupper($value);
    }



    return $query;
  }

  public static function getLineCmd() {

    $query = DB::table('params')
      ->select('params.name', 'params.valor')
      ->join('param_master', 'params.param_master_id', '=', 'param_master.id');
    // ->leftJoin('locations as loc', 'loc.id', '=', 'e1.location_id');

    $query = $query->where('param_master.name', '=', 'line_cmd');

    $query = $query->get()->pluck('valor', 'name');
//dd($query);
    return $query;
  }

  public static function getParams($name) {
   //dd($name);die();
    $datos = Params_Master::with('params')->where('name', '=', $name)->get()->pluck('params');
//dd($datos);
    return $datos[0]->pluck('value', 'name')->toArray();
  }

  public static function getEquipment($value, $array) {

    if (array_key_exists($value, $array)) {

      return $value;
    }

    return 'Otros';
  }

  public static function getEquipment2($value, $array) {

    if (array_key_exists($value, $array)) {

      return '';
    }

    return $value;
  }

  public static function getDELMODE() {
    $sql = static::select('params.valor')
                   ->join('param_master master','params.param_master_id','=','master.id')
                   ->where('master.name','=','cmd_sps')
                   ->where('params.name','=','DELMODE');
    $result = $sql->get();
    return $result;
  }

  public static function getStatus(){

    $sql = static::select('params.name', 'params.valor')
                   ->join('param_master master','params.param_master_id','=','master.id')
                   ->where('master.name','=','status_ireg');
    $result = $sql->get();
    $value = $result->map(function ($val,$key){
      return ['id' => $val->name,'text' => $val->valor];
    });
    $value = $value->pluck('text','id');
// dd($value);
    return $value;
    // return $result;
  }

  public static function getPriority(){

    $sql = static::select('params.name', 'params.valor')
                   ->join('param_master master','params.param_master_id','=','master.id')
                   ->where('master.name','=','priority_ireg');
    $result = $sql->get();
    $value = $result->map(function ($val,$key){
      return ['id' => $val->name,'text' => $val->valor];
    });
    $value = $value->pluck('text','id');
// dd($value);
    return $value;
    // return $result;
  }

  public static function getAllTecnology()
  {
    $query = DB::table('params')
      ->select('name', 'value')
      ->where('master',6)
      ->pluck('value', 'name')->toArray();

    return ['todos' => 'Todos'] + $query;
  }

  public static function getModo()
  {
       $query = DB::table('params as p')
            ->select('p.name', 'p.value')
            ->join('param_master as pm','pm.id','=', 'p.master')
            ->whereNull('p.deleted_at')
            ->where('pm.name','modo_trc')
            ->pluck('value','name')->toArray();

            return [''=>'']+$query;
  }

  public static function getTipoPuerto()
  {
       $query = DB::table('params as p')
            ->select('p.name', 'p.value')
            ->join('param_master as pm','pm.id','=', 'p.master')
            ->whereNull('p.deleted_at')
            ->where('pm.name','tipo_puerto_trc')
            ->pluck('value','name')->toArray();

            return [''=>'']+$query;
  }

  public static function getTipo()
  {
      $query = DB::table('params as p')
            ->select('p.name', 'p.value')
            ->join('param_master as pm','pm.id','=', 'p.master')
            ->whereNull('p.deleted_at')
            ->where('pm.name','medio_puertos')
            ->pluck('value','name')->toArray();

            return [''=>'']+$query;
  }

  public static function getDistancia()
  {
      $query = DB::table('params as p')
            ->select('p.name', 'p.value')
            ->join('param_master as pm','pm.id','=', 'p.master')
            ->whereNull('p.deleted_at')
            ->where('pm.name','distancia_trc')
            ->pluck('value','name')->toArray();

            return [''=>'']+$query;
  }

}
