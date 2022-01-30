<?php

namespace App\Modules\Security\Entities;

use Zizaco\Entrust\EntrustPermission;

class Permission extends EntrustPermission
{
    protected $fillable = [
        'id', 'name', 'display_name', 'parent_id', 'icon', 'url'
    ];
}