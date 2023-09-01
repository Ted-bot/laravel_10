<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Post;

class PostCommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $comments = Comment::all();
        return view('admin.comments.index', compact('comments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'body' => 'required|min:1|max:250'
        ]);

        $user = auth()->user();

        $data = [
            'post_id' => $request->post_id,
            'author' => $user->name,
            'email' => $user->email,
            'body' => $request->body,
            'photo' => $user->avatar
        ];

        Comment::create($data);

        session()->flash('message-post-created', "comment has been been submitted and is awaiting moderation!");

        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = Post::query()->findOrfail($id);

        $comments = $post->comments;

        return view('admin.comments.show', compact('comments'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'is_active' => 'required'
        ]);

        Comment::query()->findOrFail($id)->update($request->all());

        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Comment::query()->findOrFail($id)->delete();

        return back();
    }
}
