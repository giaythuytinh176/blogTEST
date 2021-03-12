<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        return view('backend.post.create');
    }

    public function store(Request $request)
    {
        $post = new Post();
        $post->fill($request->all());
        $post->slug = Str::slug($post->title, "-");
        $post->user_id = Auth::user()->id;
        $post->save();
        Toastr::success('Post published.');
        return redirect()->route('admin.index');
    }

    public function show(Post $post)
    {
        //
    }

    public function edit(Post $post)
    {
        //
    }

    public function update(Request $request, Post $post)
    {
        //
    }

    public function destroy(Post $post)
    {
        //
    }
}
