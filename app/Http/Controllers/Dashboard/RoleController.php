<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use App\Role;
use Validator;

use Illuminate\Http\Request;

class RoleController extends Controller
{



    public function __construct()
    {
        $this->middleware('permission:read_roles')->only(['index']);
        $this->middleware('permission:create_roles')->only(['create','store']);
        $this->middleware('permission:update_roles')->only(['edit','update']);
        $this->middleware('permission:delete_roles')->only(['destroy']);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()


    {

        $roles =Role::whereRoleNot(['Super_admin'])
            ->whenSearch(request()->search)
            ->with('permissions')
            ->withCount('users')
            ->paginate(5);

        return view('dashboard.roles.index',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('dashboard.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $request->validate([
            'name' => 'required',
            'permissions' => 'required | array | min:1',
        ]);

        $role =Role::create($request->all());
        $role->attachPermissions($request->permissions);
        session()->flash('success','Data added successfully');
        return redirect()->route('dashboard.roles.index');
    }

    /**
     * Display the specified resource.
     *

     *
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Role  $Role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $Role)
    {
        return  view('dashboard.roles.edit',compact('Role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Role  $Role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $Role)
    {
        $request->validate([
            'name' => 'required',
            'permissions' => 'required | array | min:1',

        ]);

        $Role->update($request->all());
        $Role->syncPermissions($request->permissions);
        session()->flash('success','Data updated successfully');
        return redirect()->route('dashboard.roles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Role  $Role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $Role)
    {
        $Role->delete();
        session()->flash('success','Data deleted successfully');
        return redirect()->route('dashboard.roles.index');
    }
}
