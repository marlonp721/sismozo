<?php

namespace App\Repositories;

use App\Modules\Security\Entities\User;
use \DB;
use App\Extensions\Kendo2QueryBuilder;

class UserDAO
{
    
    
    
    
    public static function getUsersForGrid($filters, $skip, $pageSize, $sort)
    {

        $query = User::select(['users.id',
          'email', 'username',
          'fullname',
          'cellphone', 'status','users.created_at']
            //DB::raw("CASE WHEN deleted_at IS NULL then 'Activo' ELSE 'Inactivo' END AS status")]
        );
//        $query->addSelect(DB::raw('TO_CHAR(users.created_at,"DD/MM/YYYY HH24:mm:SS") created_at'));
//        $query->addSelect(DB::raw('DATE_FORMAT(users.created_at,"%d/%m/%Y") AS created_at'));
        if(empty($filters)){

          $filters = [];
        }
        $kQuery = new Kendo2QueryBuilder($query);
        $kQuery->setNamespace('users', ['created_at']);
        $kQuery->enum('status', ['Inactivo' => 0, 'Activo' => 1]);
        //$kQuery->setAliases(['p.valor' => 'area']);
        $query = $kQuery->buildQueryFromKendoFilter($filters);

        $count = $query->count();

        if($sort)
        {
            $query = $query->orderBy($sort['field'], $sort['dir']);
        }
        
        if($pageSize)
        {
            $query = $query->skip($skip)->take($pageSize)->get();
        }else
        {
            $query=$query->get();
        }
       /* dd($query->toSql());*/

        $query = collect($query)->map(function ($model) {
           /* dd($model);*/
            $model->status = (1=== (int) $model->status)?'Activo':'Inactivo';
            return $model;
        });

        $data['data']  = $query;
        $data['total'] = $count;
		//~ dd($data);
        return $data;

    }
}
