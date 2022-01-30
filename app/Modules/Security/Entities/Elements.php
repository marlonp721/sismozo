<?php

namespace App\Modules\Security\Entities;

use App\Modules\BaseModel;



use Carbon\Carbon;
use DB;

class Elements extends BaseModel
{
   /* protected $dates = ['created_at', 'updated_at','deleted_at'];*/

    protected $casts = [

      'created_at' => 'datetime:d/m/Y H:i:s',
    ];

    protected $fillable = [
        'user_id','cpe', 'ip_service', 'ip_router', 'macaddress','type','platforms','model','localitie_id','location_id','ubigeo','latitude','longitude','altitude','establishment','address'];

    public $table = 'elements';

    public function getCreatedAtAttribute($value)
      {

        $newDateFormatCreatedAt = date('d/m/Y H:i:s', strtotime($value));

        return $newDateFormatCreatedAt;
      }
 

    protected function destroyRequest($element)
    {

        DB::beginTransaction();

        try {
            
            $element->delete();            

            DB::commit();

        } catch (\Exception $e) {

            DB::rollBack();

            abort(500);
        }

        return json_encode(true);
    }

    protected function updateRequest($element, $request)
    {   
        DB::beginTransaction();
        try {
            
            $element->update($request);

            DB::commit();
            return json_encode(true);

        } catch (\Exception $e) {


            DB::rollBack();

            abort(500);
            return json_encode(false);
        }

        
    }

    protected function storeRequest($data)
    {
        

        DB::beginTransaction();
        try {
            $ticket = $this->create($data);
             
            DB::commit();
            
        } catch (\Exception $e) {

            DB::rollBack();

            abort(500);
        }

        return json_encode(true);
    }
}