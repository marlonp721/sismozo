<?php

namespace App\Repositories;

use App\Modules\Security\Entities\Role;
use App\Modules\Security\Entities\Permission;
use DB;
use App\Extensions\Kendo2QueryBuilder;

class RoleDAO
{
    
    protected $dateFormat = 'd/m/Y H:m:s';
    
    
    public static function selectRoles($filters, $skip, $pageSize, $sort)
    {
      //dd($filters);

      $query = Role::select(['id', 'display_name', 'description','created_at']);
//      $query->addSelect(DB::raw('TO_CHAR(created_at,\'DD/MM/YYYY HH24:mm:SS\') created_at'));
     // $query = $query = DB::table('roles')->select(['id', 'display_name', 'description','created_at','deleted_at']);
      if(empty($filters)){

        $filters = [];
      }
        $kQuery = new Kendo2QueryBuilder($query);
        $query = $kQuery->buildQueryFromKendoFilter($filters);
      
        $count = $query->count();

        if($sort)
        {
            $query = $query->orderBy($sort['field'],$sort['dir']);
        }

         if($pageSize)
        {
            $query = $query->skip($skip)->take($pageSize)->get();
        }else
        {
            $query=$query->get();
        }

        $data['data'] = $query;
        $data['total']  = $count;

        return $data;
    }

    public static function getAll()
    {
        return Role::select('id', 'display_name')
                    ->where('name', '<>', 'superuser')
                    ->orderBy('id', 'asc')->get();
    }

    public static function getMenuTree()
    {
        $query = Permission::
                    select('id',
                        //DB::raw("IF(parent_id IS NULL, '#', parent_id) AS parent"),
                        DB::raw("CASE WHEN parent_id IS NULL then '#' ELSE parent_id END AS parent"),
                        'display_name AS text',
                        'icon'
                    )
                    ->whereIn('type', ["M", "A"])
                    ->where('tree_role',1)
                    ->whereNull('deleted_at')
                    //->orderBy('text')
					->orderBy('description')
                    ->get();

                    //dd($query->toSql(),$query->getBindings());
                

        return $query;
    }

    public static function getMenuTreeSelected($permissions)
    {
        
        $query = Permission::
                    select(
                        'id',
                        //DB::raw("IF(parent_id IS NULL, '#', parent_id) AS parent"),
                        DB::raw("CASE WHEN parent_id IS NULL then '#' ELSE parent_id END AS parent"),
                        'display_name AS text',
                        'icon',
                        DB::raw("CASE WHEN id IN($permissions)
                                 THEN 
                                  CASE 
                                      WHEN parent_id IS NULL or sub_parent=0 THEN '::FALSE::'
                                      ELSE '::TRUE::'
                                  END
                                 ELSE '::FALSE::' END AS state"
                                )
                    )
                    ->whereIn('type', ['M', 'A'])
                    ->where('tree_role',1)
                    ->where('deleted_at','=',null)
					//->orderBy('id')
                    ->orderBy('description')
                    ->get();
        return $query;
    }

    public static function getMenuTreeDetail(array $permissions)
    {
        $query = Permission::
                    select(
                        'id',
                        //DB::raw("IF(parent_id IS NULL, '#', parent_id) AS parent"),
                        DB::raw("CASE WHEN parent_id IS NULL then '#' ELSE parent_id END AS parent"),
                        'display_name AS text',
                        'icon'
                    )
                    ->whereIn('TYPE', ["M", "A"])
                    ->whereIn('ID', $permissions)
					->orderBy('description')
                    ->get();

        return $query;
    }
}