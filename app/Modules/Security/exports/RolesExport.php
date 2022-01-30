<?php

namespace App\Modules\Security\exports;

use App\Repositories\RoleDAO;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RolesExport implements FromCollection, WithMapping, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection() {
        
        $data     = request()->input('json', []);        
        $filter = [];        
        $data = is_array($data)?$data:json_decode($data,true);
        $filter = array_merge($filter, $data);
        $result = RoleDAO::selectRoles($filter, null, null, null);
        return collect($result['data']);
    }
    public function headings(): array {
        return [
            'PERFIL',
            'DESCRIPCIÓN',
            'FECHA DE CREACIÓN'
        ];
    }

    public function map($role): array {
        
        return [
            $role->display_name,
            $role->description,
            $role->created_at
        ];
        
    }

}
