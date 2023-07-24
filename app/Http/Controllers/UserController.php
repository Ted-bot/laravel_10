<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function show(User $user)
    {
        return view('admin.users.profile', compact('user'));
    }

    public function update(User $user)
    {
        $path = 'images';

        dd(request('username'));

        request()->validate([
            'username' => ['sometimes','required', 'string', 'max:255', 'alpha_dash:ascii'],
            'name' => ['sometimes','required', 'string', 'max:255'],
            'email' => ['sometimes','required', 'email', 'max:255', 'confirmed'],
            'password' => ['sometimes','max:255'],
            'avatar' => ['sometimes','file'],
        ]);

        dd('test');

        $user->username = request('username');
        $user->name = request('name');
        $user->email = request('email');
        $user->password = request('password') ?? request('password');
        $user->avatar = request('avatar');

        if(request('avatar')){
            // $inputs['avatar'] = request('avatar')->store('');
            request()->file('post_image')->move($path);
        }

        if($user->avatar){
            dd($user->avatar);
            $user->posts()->deleteImage($user->avatar);
        }

        request()->session()->flash('profile-updated', "Profile has been updated !");

        $user->update();


    }
}
