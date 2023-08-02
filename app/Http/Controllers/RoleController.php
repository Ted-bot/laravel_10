<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RoleController extends Controller
{
    public function index(){

        $user = auth()->user();
        $roles = Role::all();


        return view('admin.roles.index',compact(['user', 'roles']));
    }

    public function edit(Role $role)
    {
        $permissions = Permission::all();
        return view('admin.roles.edit', compact(['role', 'permissions']));
    }

    public function store()
    {

        request()->validate([
            'name' => 'required|max:25'
        ]);

        Role::query()->create([
            'name' => Str::ucfirst(request('name')),
            'slug' => Str::of(Str::lower(request('name')))->slug('-')
        ]);

        return back();

    }

    public function attach_permission(Role $role)
    {
        $role->permissions()->attach(request('permission'));

        return back();
    }

    public function detach_permission(Role $role)
    {
        $role->permissions()->detach(request('permission'));

        return back();
    }

    public function destroy(Role $role)
    {

        $name_role = $role->name;

        if($role->delete()){
            session()->flash('role-delete-succes', "Role \"{$name_role}\" has been deleted");
        } else {
           session()->flash('role-delete-fails', "Role \"{$name_role}\" has not been deleted");
        }

        return back();
    }

    public function update(Role $role)
    {

        request()->validate([
            'name' => 'required|min:2|max:25'
        ]);

        $role->name = Str::ucfirst(request('name'));
        $role->slug = Str::of(request('name'))->slug('-');

        if($role->isDirty('name')){

            session()->flash('role-updated', 'Role updated: ' . request('name'));
            $role->save();

        } else {
            session()->flash('role-updated', 'Nothing has been updated!');
        }

        return back();

    }

}
