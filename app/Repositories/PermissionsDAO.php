<?php

namespace App\Repositories;

use \DB;
use Carbon\Carbon;
class PermissionsDAO
{


  public static function insertPermissions($data)
  {
   	$query=DB::table('permissions')->insert($data);
  }


  public static function deletedPermissions($id,$name)
  {
   	$query=DB::table('permissions')
              ->where('id', $id)
              ->update(['name'=>Carbon::now()->format('Ymdhis').'_'.$name,'deleted_at' => Carbon::now()]);
  }

  public static function updatePermissions($data,$id)
  {
   	$query=DB::table('permissions')
              ->where('id', $id)
              ->update($data);
  }


  public static function getIDpermissions($id)
  {
      $query=DB::table('permissions')
              ->select('id','name')
              ->where('description','like', '%'.$id)
               ->get();

      return $query[0];
    
  }



}
