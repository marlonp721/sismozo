<?php

namespace App\Modules\Security\exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
//use App\Repositories\ap_wifisDAO;
use App\Repositories\Ap_WifisDAO;
use Illuminate\Foundation\Auth\User;

class WifisExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection() {
        
        $data     = request()->input('json', []);
        $ext = request()->input('format', 'csv');
        //~ dd($data);
        $filter = [];
        
        $data = is_array($data)?$data:json_decode($data,true);
        $filter = array_merge($filter, $data);
        
        $result = Ap_WifisDAO::getEquipmentForGrid($filter, null, null, null);
        
        return collect($result['data']);
    }
    
    public function headings(): array {
        
        return [
            'ID',
            'AP_NAME',
            'GROUP_NAME',
            'REGION',
            'PROVINCIA',
            'DISTRITO',
            'LOCALIDAD',
            'IP',
            'GATEWAY',
            'SUBNET',
            'DNS',
            'AP_MAC',
            'BLE_MAC',
            'AP_MODEL',
            'AP_VERSION',
            'AP_LOCATION',
            'IP_MODE',
            'STATUS',
            'LED_MODE',
            'CHANNEL',
            'CH_UTILIZACION',
            'CH_WIDTH',
            'NOISE_FLOOR',
            'EIRP',
            'LACP_STATUS',
            'GROUP_DESCRIPTION',
            'RF_PROFILE',
            'CREATED AT',
        ];
        
    }
    public function map($ap_wifis): array {
        
        return [
            $ap_wifis->id,
            $ap_wifis->ap_name,
            $ap_wifis->group_name,
            $ap_wifis->region,
            $ap_wifis->provincia,
            $ap_wifis->distrito,
            $ap_wifis->localidad,
            $ap_wifis->ip_addres,
            $ap_wifis->gw,
            $ap_wifis->subnet,
            $ap_wifis->dns,
            $ap_wifis->mac,
            $ap_wifis->ble_mac,
            $ap_wifis->ap_model,
            $ap_wifis->ap_version,
            $ap_wifis->ap_location,
            $ap_wifis->ip_mode,
            $ap_wifis->status,
            $ap_wifis->led_mode,
            $ap_wifis->channel,
            $ap_wifis->channel_util,
            $ap_wifis->channel_width,
            $ap_wifis->noise_floor,
            $ap_wifis->eirp,
            $ap_wifis->lacp,
            $ap_wifis->group_desc,
            $ap_wifis->rf_profile,
            $ap_wifis->created_at,
        ];
    }



}
