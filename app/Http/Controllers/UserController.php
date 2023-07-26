<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;
use App\Http\Controllers\PostController;

class UserController extends Controller
{
    public function index()
    {

        $users = User::all();

        return view('admin.users.index', compact('users'));

    }

    public function show(User $user)
    {
        return view('admin.users.profile', compact('user'));
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
        $user->password = $request->password ?? $request->password;

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
}
