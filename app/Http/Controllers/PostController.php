<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRequest;
use App\Models\Post;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index()
    {
        if ($this->userCan('page-user-admin')) {
            $posts = DB::table('posts')->orderBy('id', 'DESC')->get();//latest()->paginate(10);
        } else {
            $posts = DB::table('posts')->where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->get();//latest()->paginate(10);
        }
        return view('backend.post.main', compact('posts'));
    }

    public function create()
    {
        return view('backend.post.create');
    }

    public function store(CreateRequest $request)
    {
        $post = new Post();
        $post->fill($request->all());
        $post->slug = Str::slug($post->title, "-");
        $post->user_id = Auth::user()->id;
        $post->save();
        Toastr::success('Post published.');
        return redirect()->route('admin.index');
    }

    public function show(Post $post, Request $request, $id)
    {
    }

    public function edit(Post $post, Request $request, $id)
    {
        $post = Post::findOrFail($id);
        if ($this->userCan('access-others-post', $post) == false) {
            return view('backend.user.error-403');
        }
        return view('backend.post.edit', compact('post'));
    }

    public function update(CreateRequest $request, Post $post)
    {
        $post = Post::findOrFail($request->id);
        if ($this->userCan('access-others-post', $post) == false) {
            return view('backend.user.error-403');
        }
        $post->fill($request->all());
        $post->slug = Str::slug($post->title, "-");
        $post->user_id = $request->user_id;
        if ($this->userCan('page-user-admin') && !empty($request->published)) {
            $post->published = ($request->published == 1) ? "1" : "0";
        }
        $post->save();
        Toastr::success('Updated successfully.');
        return redirect()->route('admin.index');
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        if ($this->userCan('access-others-post', $post) == false) {
            return view('backend.user.error-403');
        }
        $post->delete();
        Toastr::success('Deleted successfully.');
        return redirect()->route('admin.index');
    }
}
