<?php

namespace App\Modules\Security\Entities;

use App\Modules\BaseModel;


use Carbon\Carbon;
use DB;

class Ap_Wifis extends BaseModel
{
    protected $casts = [

      'created_at' => 'datetime:d/m/Y H:i:s',
      
    ];

    protected $fillable = [

        'user_id','ap_name', 'group_name', 'ip_address', 'gw','subnet','dns','mac','ble_mac','ap_location','noise_floor','eirp','lacp','status','ap_model','ap_version','ip_mode','led_mode','rf_profile','channel','channel_util','channel_width','group_desc','country','link_status','work_mode','saved','region_id','province_id','district_id','localitie_id' ];

    public $table = 'ap_wifi';

    public function getCreatedAtAttribute($value)
      {

        $newDateFormatCreatedAt = date('d/m/Y H:i:s', strtotime($value));

        return $newDateFormatCreatedAt;
      }
 

    protected function destroyRequest($ap_wifi)
    {

        DB::beginTransaction();

        try {
            
            $ap_wifi->delete();            

            DB::commit();

        } catch (\Exception $e) {

            DB::rollBack();

            abort(500);
        }

        return json_encode(true);
    }

    protected function updateRequest($ap_wifi, $request)
    {   
        DB::beginTransaction();
        try {
            
            $ap_wifi->update($request);

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