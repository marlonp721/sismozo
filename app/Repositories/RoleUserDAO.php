<?php

namespace App\Repositories;


use DB;


class RoleUserDAO
{
   
    public static function getAllUserAsignedByRol($role_id)
    {
        return DB::table('role_user')->select(['user_id'])
                    ->where('role_id',$role_id)
                    ->get();
    }


  
}