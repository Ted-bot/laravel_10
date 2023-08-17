<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Notifications\RegisteredUserNotification;
use App\Exceptions\ClassNotFoundByObserverTraitException;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $observer = '\\App\\APP\\BBObserver';
        $currentFileName = __FILE__;

        $posts = Post::all();

        return view('home', compact('posts'));
    }
}
