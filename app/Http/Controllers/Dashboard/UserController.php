<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Role;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{



    public function __construct()
    {
        $this->middleware('permission:read_users')->only(['index']);
        $this->middleware('permission:create_users')->only(['create','store']);
        $this->middleware('permission:update_users')->only(['edit','update']);
        $this->middleware('permission:delete_users')->only(['destroy']);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles=Role::WhereRoleNot('super_admin')->get();

            $users = User::whereRoleNot(['Super_admin','admin'])
                ->whenSearch(request()->search)
                ->WhenRole(request()->role_id)
                ->with('roles')
              ->paginate(5);

        return view('dashboard.users.index', compact('users','roles'));
    }






    public function create()
    {
        $roles=Role::whereRoleNot(['super_admin','admin'])->get();
        return view('dashboard.users.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed',
            'role_id' => 'required|numeric',
        ]);





        $request->merge(['password'=>bcrypt($request->password)]);

        $User = User::create($request->all());

        $User->attachRoles(['admin', $request->role_id]);

        session()->flash('success', 'Data added successfully');

        return redirect()->route('dashboard.users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\User $User
     * @return \Illuminate\Http\Response
     */
    public function show(User $User)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\User $User
     * @return \Illuminate\Http\Response
     */

    public function edit(User $User)

    {
        $roles=Role::whereRoleNot(['super_admin','admin'])->get();

        return view('dashboard.users.edit', compact('User','roles'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\User $User
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $User)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'. $User->id,
            'role_id' => 'required|numeric',
        ]);

        $User ->update($request->all());

        $User->syncRoles(['admin',$request->role_id]);

        session()->flash('success', 'Data Updated successfully');

        return redirect()->route('dashboard.users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\User $User
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $User)
    {
        $User->delete();
        session()->flash('success', 'Data deleted successfully');
        return redirect()->route('dashboard.users.index');
    }
}

