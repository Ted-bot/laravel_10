<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all()->sortByDesc('id');
        // $posts = auth()->user()->posts()->paginate(5);
        return view('admin.posts.index', compact('posts'));
    }


    public function show(Post $post)
    {
        Post::findOrFail($post->id);
        return view('blog-post', compact('post'));
    }

    public function create()
    {
        $this->authorize('create', Post::class);

        return view('admin.posts.create',);
    }

    public function edit(Post $post)
    {

        return view('admin.posts.edit', compact('post'));
    }

    public function store(Request $request)
    {
        $this->authorize('create', Post::class);

        $imageName = '';

        $request->validate([
            'title' => 'required|min:3|max:100',
            'post_image' => 'nullable|file',
            'body' => 'required'
        ]);

        $post = new Post();

        $post->user_id = Auth::user()->id;
        $post->title = $request->title;
        $post->body = $request->body;

        if($request->post_image){
            $input_file = $request->post_image;
            $fileName = $request->file('post_image')->hashName();
            $imageName = Str::before($fileName, '.');
            $ext = $input_file->extension();

            $newImageName = $imageName . '.' . $ext;

            $path = public_path('images');
            $request->file('post_image')->move($path,$newImageName);
            $path = 'images';
            $post->post_image = $path . '/' . $newImageName;
        }

        $post->save();

        session()->flash('message-post-created', "Post {$post->id} has been created !");

        return redirect()->route('post.index');
    }


    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post);

        if ($request->user()->cannot('update', $post)) {
            abort(403);
        }

        $request->validate([
            'title' => 'required|min:3|max:100',
            'post_image' => 'nullable|file',
            'body' => 'required'
        ]);

        $post->title = $request->title;
        $post->body = $request->body;

        if($request->file('post_image') !== null){

            $this->deleteImage($post->post_image);

            $input_file = $request->post_image;
            $fileName = $request->file('post_image')->hashName();
            $imageName = Str::before($fileName, '.');
            $ext = $input_file->extension();
            $newImageName = $imageName . '.' . $ext;
            $path = 'images';

            $post->post_image = $newImageName;

            $request->file('post_image')->move($path,$newImageName);

            $post->post_image = $path . '/' . $newImageName;
        }

        $post->save();

        session()->flash('message-post-updated', "Post has been updated !");

        return redirect()->route('post.index');
    }

    public function destroy(Post $post)
    {

        $this->authorize('delete', $post);

        $this->deleteImage($post->post_image);

        session()->flash('message-post-deleted', "Post {$post->id} has been deleted !");

        $post->delete();

        return back();
    }

    public function deleteImage($image)
    {
        //delete old image
        $path = public_path('images');
        $delete_old_file_name = $path .'/' . str_replace('http://localhost/images/', '', $image);

        if(File::exists($delete_old_file_name)){
            File::delete($delete_old_file_name);
            return true;
        }
        return false;
    }
}
