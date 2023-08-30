<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;
use App\Http\Controllers\PostController;
use App\Models\Role;

class UserController extends Controller
{
    public function index()
    {

        $users = User::all();

        return view('admin.users.index', compact('users'));

    }

    public function show(User $user)
    {
        $roles = Role::all();

        return view('admin.users.profile', compact(['user','roles']));
    }

    public function update(User $user, Request $request)
    {
        $path = 'images';

        $request->validate([
            'username' => 'required|string|max:255|min:3|alpha_dash:ascii',
            'name' => 'required|string|max:255|min:3',
            'email' => 'required|email|max:255|min:3',
            'password' => 'max:255|confirmed',
            'avatar' => 'file',
        ]);

        $user->username = $request->username;
        $user->name = $request->name;
        $user->email = $request->email;

        if($request->filled('password')){
            $request->merge(['password' => bcrypt($request->password)]);
        }

		if (!$request->password) {
	        unset($request['password']);
		}

        if ($request->hasFile('avatar')) {

            $path = public_path('images/');
            $delete_old_file_name = $path . str_replace('http://localhost/images/', '', $user->avatar);

            if(file_exists($delete_old_file_name)){
                $delete = (new PostController)->deleteImage($user->avatar);
            }

            $image = $request->file('avatar');
            $fileName = $image->hashName();
            $imgName = Str::before($fileName, '.');
            $ext = $image->extension();
            $imgNewName = $imgName . '.' . $ext;

            $image->move($path, $imgNewName);
            $user->avatar = 'images/' . $imgNewName;
        }

        $user->update();

        return redirect()->route('user.profile.show', compact('user'));

    }

    public function destroy($id)
    {
        $user = User::query()->find($id);

        $name_of_deleted_user = $user->name;

        if($user->delete())
        {
            session()->flash('user-delete-succes', "User {$name_of_deleted_user} has been deleted");
        }

        session()->flash('user-delete-fails', "User {$name_of_deleted_user} has not been deleted");

        return back();
    }

    public function attach(User $user)
    {
        $role_id = request('role');

        $role = Role::query()->find($role_id);

        $user->roles()->attach(request('role'));

        $attch_succes = $user->roles()->where('role_id', request('role'));

        if($attch_succes){
            session()->flash('user-attach-succes', "Attached role \"{$role->slug}\" to user {$user->name} successfully!");
        } else {
            session()->flash('user-attach-failure', "Attaching role \"{$role->slug}\" to user {$user->name} has failed!");
        }

        return back();

    }

    public function detach(User $user)
    {

        $role_id = request('role');

        $role = Role::query()->find($role_id);

        $user->roles()->detach(request('role'));

        $detach_succes = $user->roles()->where('role_id', request('role'));

        if($detach_succes){
            session()->flash('user-detach-succes', "Role \"{$role->slug}\" has been detached from user {$user->name}!");
        } else {
            session()->flash('user-detach-failure', "role \"{$role->slug}\" has not been detached from user {$user->name}!");
        }

        return back();

    }

}
