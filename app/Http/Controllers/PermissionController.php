<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permission;
use Illuminate\Support\Str;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::all();
        return view('admin.permissions.index', compact('permissions'));
    }

    public function store()
    {
        request()->validate([
            'name' => 'required|max:50'
        ]);

        Permission::create([
            'name' => Str::ucfirst(request('name')),
            'slug' => Str::of(Str::lower(request('name')))->slug('-')
        ]);

        return back();
    }

    public function edit(Permission $permission)
    {
        return view('admin.permissions.edit', compact('permission'));
    }

    public function destroy(Permission $permission)
    {
        $permission->delete();

        return back();
    }

    public function update(Permission $permission)
    {
        request()->validate([
            'name' => 'required|min:2|max:25'
        ]);

        $permission->name = Str::ucfirst(request('name'));
        $permission->slug = Str::of(request('name'))->slug('-');

        if($permission->isDirty('name')){

            session()->flash('permission-updated', 'permission updated: ' . request('name'));
            $permission->save();

        } else {
            session()->flash('permission-updated', 'Nothing has been updated!');
        }

        return back();

    }

}
