<?php

namespace App\Http\Controllers;


use App\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();

        return view('pages.roles.index')->with([
            'users' => $users,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $user = User::create([
            'name' => $data['user_name'],
            'email' => $data['user_email'],
            'password' => bcrypt($data['user_password'])
        ]);

        $role = Role::findById($data['role_id']);

        $permission = Permission::findById($data['permission_id']);

        $role->givePermissionTo($permission->name);
        $user->assignRole($role);

        return redirect()->route('roles.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $user = User::find($role->id);
        $permissions = Permission::all();


        return view('pages.roles.edit')->with([
            'user' => $user,
            'role' => $role,
            'permissions' => $permissions,
            'roles' => $role->all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $data = $request->all();
        $roleRequest = Role::findById($data['role_id'])->name;

        $user = User::findOrFail($role->id);
        $user->syncRoles($roleRequest);

        return redirect()->route('roles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
    }

    public function permission()
    {
        $roles = Role::all();

        return view('pages.roles.permission', compact('roles'));
    }

    public function permissionUpdate(Request $request)
    {
        $data = $request->all();
        $roles = Role::all();

        foreach ($roles->all() as $key => $role) {
            $role->syncPermissions([
                $data["write-$key"] ?? null,
                $data["edit-$key"] ?? null,
                $data["publish-$key"] ?? null,
            ]);
        }

        return redirect()->route('roles.index');
    }
}
