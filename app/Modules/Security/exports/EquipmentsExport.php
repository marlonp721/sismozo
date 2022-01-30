<?php

namespace App\Modules\Security\exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Repositories\ElementsDAO;
use Illuminate\Foundation\Auth\User;

class EquipmentsExport implements FromCollection, WithHeadings, WithMapping
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
        
        $result = ElementsDAO::getEquipmentForGrid($filter, null, null, null);
        
        return collect($result['data']);
    }
    
    public function headings(): array {
        
        return [
            'ID',
            'CPE',
            'IP_SERVICE',
            'IP_ROUTER',
            'MAC',
            'TIPO',
            'MARCA',
            'MODELO',
            'REGION',
            'PROVINCIA',
            'DISTRITO',
            'LOCALIDAD',
            'LATITUD',
            'LONGITUD',
            'ALTITUD',
            'INSTITUCION',
            'DIRECCION',
            'FECHA DE REGISTRO',
        ];
        
    }
    public function map($elements): array {
        
        return [
            $elements->id,
            $elements->cpe,
            $elements->ip_service,
            $elements->ip_router,
            $elements->macaddress,
            $elements->value,
            $elements->platforms,
            $elements->model,
            $elements->region,
            $elements->provincia,
            $elements->distrito,
            $elements->localidad,
            $elements->latitude,
            $elements->longitude,
            $elements->altitude,
            $elements->establishment,
            $elements->address,
            $elements->created_at,
        ];
    }



}
