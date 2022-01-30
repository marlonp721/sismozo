<?php

namespace App\Modules\Security\exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Repositories\ElementsDAO;
//~ use Illuminate\Foundation\Auth\User;

class ConfigurationsExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection() {
        
        $data     = request()->input('json', []);
        $ext = request()->input('format', 'csv');
        
        $filter = [];
        
        $data = is_array($data)?$data:json_decode($data,true);
        $filter = array_merge($filter, $data);
        $result = ElementsDAO::getEquipmentForGrid($filter, null, null, null);
        return collect($result['data']);
    }
    
    public function headings(): array {
        
        return [
            'CPE',
            'IP',
            'LATITUD',
            'LONGITUD',
            'ALTITUD',
            'REGION',
        ];
        
    }
    public function map($configu): array {
        
        return [
            $configu->cpe,
            $configu->ipserver,
            $configu->latitude,
            $configu->longitude,
            $configu->altitude,
            $configu->region
        ];
    }



}
