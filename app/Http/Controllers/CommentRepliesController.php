<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CommentReply;
use App\Models\Comment;

class CommentRepliesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

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


    }

    public function createReply(Request $request)
    {
        $request->validate([
            'body' => 'required|min:1|max:250'
        ]);

        $user = auth()->user();

        $data = [
            'comment_id' => $request->comment_id,
            'author' => $user->name,
            'email' => $user->email,
            'body' => $request->body,
            'photo' => $user->avatar
        ];

        CommentReply::create($data);

        session()->flash('message-post-created', "comment has been been submitted and is awaiting moderation!");

        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $comment = Comment::query()->findOrfail($id);

        $replies = $comment->replies;

        return view('admin.comments.replies.show', compact('replies'));
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
    public function update(Request $request, $id)
    {
        CommentReply::query()->findOrFail($id)->update($request->all());

        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        CommentReply::query()->findOrFail($id)->delete();

        session()->flash('message-post-deleted', "Reply has been been deleted!");

        return back();
    }
}
