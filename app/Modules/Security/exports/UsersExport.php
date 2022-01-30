<?php

namespace App\Modules\Security\exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Repositories\UserDAO;
use Illuminate\Foundation\Auth\User;

class UsersExport implements FromCollection, WithHeadings, WithMapping
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
        $result = UserDAO::getUsersForGrid($filter, null, null, null);
        return collect($result['data']);
    }
    
    public function headings(): array {
        
        return [
            'NOMBRE DE USUARIO',
            'NOMBRES',
            'EMAIL',
            'CELULAR',
            'FECHA DE ALTA',
            'ESTADO',
        ];
        
    }
    public function map($user): array {
        
        return [
            $user->username,
            $user->fullname,
            $user->email,
            $user->cellphone,
            $user->created_at,
            $user->status
        ];
    }



}
