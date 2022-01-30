<?php

namespace App\Modules\Security\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Repositories\RoleDAO;
use App\Http\Requests\RoleRequest;
use App\Modules\Security\Entities\Role;
use App\Modules\Security\Entities\Permission;
use App\Repositories\RoleUserDAO;
use \DB;
class RoleController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('ajax')->except('index');
        $this->middleware('role_superuser')->only('edit', 'update', 'delete', 'destroy');
    }

    /**
     * Display a listing of the roles.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*$rolePerms = Permission::where('name', 'like', 'security%')->orWhere('name', 'like', '%security')->get();
        $rolePerms->each(function ($record) {
            echo "(" . $record->id . ", '" . $record->name . "', '" . $record->display_name . "', '" . $record->type . "', " . $record->parent_id . ", " . $record->sub_parent . ", '" . $record->icon . "', '" . $record->url . "', '" . $record->description . "')\n";
        });*/
      //$query = $query = DB::table('roles')->select(['id', 'display_name', 'description','created_at','deleted_at'])->get();
      //dd($query);
        return view('Security::roles.index');
    }

    /**
     * Show the form for creating a new roles.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Security::roles.partials.modals.create-role');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
//      dd($request->all());
        
        return Role::storeRequest($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        $permissions      = $role->perms()->pluck('id')->toArray();
        $permissions_role = RoleDAO::getMenuTreeDetail($permissions);
        
        return view('Security::roles.partials.modals.show-role',compact('role','permissions_role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $permissions      = implode(',', $role->perms()->pluck('id')->toArray());
        $permissions_role = RoleDAO::getMenuTreeSelected($permissions)->toJson();
        $permissions_role = str_replace('"::FALSE::"',"{selected:false}", $permissions_role);
        $permissions_role = str_replace('"::TRUE::"',"{selected:true}", $permissions_role);

        return view('Security::roles.partials.modals.edit-role', compact('role', 'permissions_role'));
    }

    /**
     * Update the specified resource in storage.
     * @param Role $role
     * @param RoleRequest $request
     * @return mixed
     */
    public function update(Role $role, RoleRequest $request)
    {
        return Role::updateRequest($role, $request);
    }

    /**
     * Show the form for destroying the specified resource.
     *
     * @param  model  $role
     * @return \Illuminate\Http\Response
     */
    public function delete(Role $role)
    {
        return view('Security::roles.partials.modals.delete-role', compact('role'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $users_id=RoleUserDAO::getAllUserAsignedByRol($role->id);
        if($users_id->count())
        {
           $msg="No se puede borrar el perfil \"{$role->name}\" ya que está asignado a los usuarios con id =";
            foreach ($users_id as $value) {
                $msg.=$value->user_id.',';
            }
            $msg = trim($msg, ',') . ". Retirar esta asociación y vuelva a intentarlo.";
           return json_encode(['msg'=>$msg]);
        }
        
        return Role::destroyRequest($role);
    }

    /**
     * Select data from storage
     * @param Request $request
     * @return array
     */
    public function load(Request $request)
    {
        $filter   = $request->input('filter');
        $skip     = $request->input('skip');
        $pageSize = $request->input('pageSize');
        $sort     = getSortValues($request->input('sort'));

        return RoleDAO::selectRoles($filter, $skip, $pageSize, $sort);
    }

    /**
     * Select a menu list
     * @return \Illuminate\Http\JsonResponse
     */
    public function tree()
    {
        $query = RoleDAO::getMenuTree();

        return response()->json($query);
    }
}
