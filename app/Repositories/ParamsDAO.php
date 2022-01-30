<?php

namespace App\Repositories;

use App\Modules\Package\Entities\Package;
use App\Modules\Security\Entities\Params;
use \DB;
use App\Extensions\Kendo2QueryBuilder;

class ParamsDAO
{

  public static function getPlanCategory()
  {

    $query = DB::table('params as p')
      ->select('p.name', 'p.value')
      ->join('param_master as pm', 'pm.id', '=', 'p.master')
      ->whereNull('p.deleted_at')
      ->where('pm.name', '=', 'plan_category')
      ->get()->pluck('value', 'name');
    /*dd($query);*/
    return $query;
  }

  public static function getEstusQuote()
  {

    $query = DB::table('params as p')
      ->select('p.name', 'p.value')
      ->join('param_master as pm', 'pm.id', '=', 'p.master')
      ->whereNull('p.deleted_at')
      ->where('pm.name', '=', 'status')
      ->get()->pluck('value', 'name');
    /*dd($query);*/
    return $query;
  }

  public static function getBC()
  {
    $query = DB::table('params as p')
      ->select('p.id as id', DB::raw('substring(p.name,3) as bc'), 'p.value as day_month')
      ->join('param_master as pm', 'pm.id', '=', 'p.master')
      ->whereNull('p.deleted_at')
      ->where('pm.name', '=', 'billing')
      ->get()->toArray();
    return $query;
  }

  public static function deleteBC($id)
  {
    $date = date('Y-m-d H:i:s');
    $query = DB::table('params')
      ->where('id', $id)
      ->update(['deleted_at' => $date]);
    return $query;
  }

  public static function updateBC($id, $bc, $day)
  {
    $date = date('Y-m-d H:i:s');
    $query = DB::table('params')
      ->where('id', $id)
      ->update(['updated_at' => $date, 'name' => $bc, 'value' => $day]);
    return $query;
  }
  public static function insertBC($data)
  {
    $bc = Params::create($data);
    return $bc->id;
  }

  public static function getParams($name)
  {
    $params = DB::table('params')
      ->select('params.name', 'params.value')
      ->join('param_master as master', 'params.master', '=', 'master.id')
      ->whereNull('params.deleted_at')
      ->where('master.name', '=', $name)
      ->pluck('params.value', 'params.name')->toArray();

    return $params;
  }
  
  public static function getModo() {
      return self::getParams('modo_trc');
  }
  
  public static function getDistancia() {
      return self::getParams('distancia_trc');
  }

  public static function getAllStatus()
  {
      $query = DB::table('params')
        ->select(
      'params.name AS ID',
      'params.value as VALUE'
        )
        ->join('param_master as master', 'params.master','=', 'master.id')
        ->whereNull('params.deleted_at')
        ->where('master.name', 'estados_puertos')
        ->get()->pluck('ID', 'VALUE');


      return $query;


    }

  public static function getMedios()
  {

    $query = DB::table('params')
      ->select(
      'params.name as ID',
      'params.value as VALUE'
      )->join('param_master as master', 'params.master', '=', 'master.id')
      ->whereNull('params.deleted_at')
      ->where('master.name', 'medio_puertos')
      ->get()->pluck('VALUE', 'ID');


    return $query;
  }

  public static function elemento_precio()
  {
     $query = DB::table('params as p')
      ->select(
      'p.name',
      'p.value'
      )->join('param_master as pm', 'pm.id', '=', 'p.master')
      ->whereNull('p.deleted_at')
      ->where('pm.name', 'mod_precios')
      ->pluck('value', 'name')->toArray();


    return ['' => ''] +$query;

  }

  public static function getParamsDesconocido($modelo)
  {
      $query = DB::table('params as p')
              ->select(
              'p.name',
              'p.value'
              )->join('param_master as pm', 'pm.id', '=', 'p.master')
              ->whereNull('p.deleted_at')
              ->where('pm.name', $modelo)
              ->get()->pluck('value','name')->toArray();

      return $query;
  }

  public static function technology()
  {
        $query = DB::table('params as p')
              ->select(
              'p.name',
              'p.value'
              )->join('param_master as pm', 'pm.id', '=', 'p.master')
              ->whereNull('p.deleted_at')
              ->where('pm.name', 'sync_tecnologia')
              ->get()->pluck('value','name')->toArray();

       return $query;
  }

  public static function file_read_confirm($technology)
  {
      $query = DB::table('file_read')
              ->select(
              'file'
              )->whereNull('deleted_at')
              ->where('estado', '1')
              ->where('sync',$technology)
              ->get()->pluck('file')->toArray();

       return $query;

  }

  public static function getCredentials($technology)
  {
       $query = DB::table('params as p')
              ->select(
              'p.name',
              'p.value'
              )->join('param_master as pm', 'pm.id', '=', 'p.master')
              ->whereNull('p.deleted_at')
              ->where('pm.name', $technology)
              ->get()->pluck('value','name')->toArray();

       return $query;
  }

  public static function getEmails($technology)
  {
      $emails=[];
       $query = DB::table('params as p')
              ->select(
              'p.name',
              'p.value'
              )->join('param_master as pm', 'pm.id', '=', 'p.master')
              ->whereNull('p.deleted_at')
              ->where('pm.name', 'emails')
              ->where('p.name','like','%'.$technology.'%')
              ->where('p.master',28)
              ->get()->toArray();

        foreach ($query as $key => $v) {
          $emails[]=$v->value;
        }


       return $emails;
  }

  public static function getElements()
  {
    $elements=[];
    $query = DB::table('elements as e')
    ->select('e.cpe','e.id')
    ->get()->pluck('cpe','id')->toArray();
    return $query;
  }

  public static function getRegions()
  {
    $elements=[];
    $query = DB::table('regions as r')
    ->select('r.name','r.id')
    ->get()->pluck('name','id')->toArray();
    return $query;
  }

  public static function getProvinces($id)
  {
    $elements=[];
    $query = DB::table('provinces as p')
    ->select('p.name','p.id')
    ->join('regions as r', 'r.id', '=', 'p.region_id')
    ->where('p.region_id',$id)
    ->get()->pluck('name','id')->toArray();
    return $query;
  }

  public static function getDistricts($id)
  {
    $elements=[];
    $query = DB::table('districts as d')
    ->select('d.name','d.id')
    ->join('provinces as p', 'p.id', '=', 'd.province_id')
    ->where('d.province_id',$id)
    ->get()->pluck('name','id')->toArray();
    return $query;
  }

  public static function getLocalities($id)
  {
    $elements=[];
    $query = DB::table('localities as l')
    ->select('l.name','l.id')
    ->join('districts as d', 'd.id', '=', 'l.district_id')
    ->where('l.district_id',$id)
    ->get()->pluck('name','id')->toArray();
    return $query;
  }

  public static function getTipoEnlace()
  {
        $query = DB::table('params as p')
              ->select(
              'p.name',
              'p.value'
              )->join('param_master as pm', 'pm.id', '=', 'p.master')
              ->whereNull('p.deleted_at')
              ->where('pm.name', 'enlace')
              ->get()->pluck('value','name')->toArray();

       return $query;
  }

  public static function getCredentialsFTPCpax()
  {
        $query = DB::table('params as p')
              ->select(
              'p.name',
              'p.value'
              )->join('param_master as pm', 'pm.id', '=', 'p.master')
              ->whereNull('p.deleted_at')
              ->where('pm.name', 'ftp_capex')
              ->get()->pluck('value','name')->toArray();

       return $query;
  }

  public static function getCredentialsMysql()
  {

    $query = DB::table('params as p')
      ->select('p.name', 'p.value')
      ->join('param_master as pm', 'pm.id', '=', 'p.master')
      ->whereNull('p.deleted_at')
      ->where('pm.name', '=', 'bd_mrtg')
      ->get()->pluck('value', 'name');
    /*dd($query);*/
    return $query;
  }

}
