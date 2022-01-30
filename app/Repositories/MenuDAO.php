<?php

namespace App\Repositories;

use App\Modules\Security\Entities\Permission;
use DB;

class MenuDAO {
    
    public static function getAll()
    {
        $query = Permission::select()->whereIn('type', ['M', 'A'])->get();
 
        return $query;
    }
    
    public static function getByType($type, $roles, $superuser)
    {
        $query = Permission::select( DB::raw('DISTINCT(permissions.id)'),
                                    'permissions.description',
                                    'permissions.type',
                                    'permissions.name',
                                    'permissions.display_name',
                                    'permissions.parent_id',
                                    'permissions.url',
                                    'permissions.icon',
                                    'permissions.sub_parent',
                                    'permissions.tree_role' )
                            
                            ->where('type', $type)
          ->whereNull('deleted_at')
                            ->when( ! $superuser , function ($query) use ($roles){

                                return $query->join('permission_role as PR', 'id', '=', 'PR.permission_id')
                                             ->whereIn('PR.role_id', $roles);
                            })
                            ->orderBy('permissions.description')
                            ->get();
		//~ dd($query);
        return $query;
    }

     public static function getByIdCpe($parent_id)
    {
        $query = Permission::select('permissions.id',
                                    'permissions.description',
                                    'permissions.type',
                                    'permissions.name',
                                    'permissions.display_name',
                                    'permissions.parent_id',
                                    'permissions.url',
                                    'permissions.icon',
                                    'permissions.sub_parent',
                                    'permissions.tree_role' )
                            ->where('type', 'M')
                            ->where('parent_id', $parent_id)
                            ->where('tree_role', 0)
                            ->whereNull('deleted_at')
                            ->orderBy('permissions.display_name')
                            ->get();
//dd($query);
        return $query;
    }
    
}
