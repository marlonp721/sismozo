<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Repositories\MenuDAO;

class MenuComposer
{   
     /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $superuser = auth()->user()->isSuperUser();
        $roles_id  = auth()->user()->roles()->pluck('roles.id')->toArray();

        $menu = MenuDAO::getByType('M', $roles_id, $superuser)->toArray();

        $id_menu_cpe=[20,21,22,23];
        foreach ($menu as $key => $value) {
            if(in_array($value['id'],$id_menu_cpe))
            {
                $sub_menu=MenuDAO::getByIdCpe($value['id'])->toArray();
                foreach ($sub_menu as $sb)
                {
                    $menu[]=$sb;
                }
            }
        }
       
	$list = array_recursive($menu, 'parent_id');
        $view->with('sidebarMenu', $list);
    }
}

