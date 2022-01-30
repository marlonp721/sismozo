<?php
namespace App\Modules\Security\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;
use DB;
class Params_Master extends Model
{

  public $table = 'param_master';


  public function params() {

  /*  return $this->hasMany('App\Modules\Security\Entities\Params', 'param_master_id', 'id');*/
    return $this->hasMany('App\Modules\Security\Entities\Params', 'master', 'id');

  }
  public static function getName($dato){

    $query = static::select('name')->where('name','like',$dato.'_%')->get()->pluck('name')->toArray();
    return $query;
  }

}

