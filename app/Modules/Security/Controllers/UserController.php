<?php

namespace App\Modules\Security\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Repositories\UserDAO;
use App\Repositories\RoleDAO;
use App\Repositories\ParamsDAO;
//use App\Modules\Configuration\Entities\Company;
//use App\Modules\Configuration\Entities\Management;
use App\Http\Requests\UserRequest;
use App\Modules\Security\Entities\User;

class UserController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('ajax')->except('index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Security::users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = RoleDAO::getAll();

        $current_roles = [];

        $level_building = config('custom_arrays.level_building');// que es esto?

        $users_area=[''=>'']+ParamsDAO::getParams('users_area');
        

        return view('Security::users.partials.modals.create-user', compact('roles', 'current_roles','level_building','users_area'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        return User::storeRequest($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('Security::users.partials.modals.show-user', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  model  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $current_roles = $user->roles->pluck('id')->toArray();

        $roles = RoleDAO::getAll();
        $level_building = config('custom_arrays.level_building');

        $users_area=[''=>'']+ParamsDAO::getParams('users_area');

        return view('Security::users.partials.modals.edit-user', compact('user', 'roles', 'current_roles','level_building','users_area'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(User $user, UserRequest $request)
    {
        return User::updateRequest($user, $request);
    }

    /**
     * Show the form for destroying the specified resource.
     *
     * @param  model  $user
     * @return \Illuminate\Http\Response
     */
    public function delete(User $user)
    {
        return view('Security::users.partials.modals.delete-user', compact('user'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        return User::destroyRequest($user);
    }

    /**
     * Select data from storage.
     *
     * @param  model  $request
     * @return \Illuminate\Http\Response
     */
    public function load(Request $request)
    {
        $filter   = $request->input('filter');
        $skip     = $request->input('skip');
        $pageSize = $request->input('pageSize');
        $sort     = getSortValues( $request->input('sort') );

        return UserDAO::getUsersForGrid($filter, $skip, $pageSize, $sort);
    }

}
