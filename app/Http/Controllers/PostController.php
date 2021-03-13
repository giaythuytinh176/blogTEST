<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRequest;
use App\Http\Requests\EditRequest;
use App\Models\Post;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function schedulePost()
    {
        $posts = DB::table('posts')
            ->where('published_at', '<=', now())
//            ->where('is_published', '=', '0')
            ->orderByDesc('published_at')
            ->get();
        $posts->each(function ($post) {
            DB::table('posts')->where('id', $post->id)->update(['is_published' => '1']);
        });
    }

    public function index()
    {
        if ($this->userCan('page-user-admin')) {
            $posts = DB::table('posts')->orderByDesc('id')->get();
        } else {
            $posts = DB::table('posts')->where('user_id', Auth::user()->id)->orderByDesc('id')->get();
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
        if (!$this->userCan('page-user-admin')) {
            $post->published_at = Carbon::now()->toDateTimeString();
        } else {
            $post->published_at = $request->published_at;
            $post->is_published = $request->is_published;
        }
        $post->save();
        Toastr::success('Post published.');
        return redirect()->route('admin.index');
    }

    public function edit(Post $post, Request $request, $id)
    {
        $post = Post::findOrFail($id);
        if ($this->userCan('access-others-post', $post) === false) {
            return view('backend.user.error-403');
        }
        return view('backend.post.edit', compact('post'));
    }

    public function update(EditRequest $request, Post $post)
    {
        $post = Post::findOrFail($request->id);
        if ($this->userCan('access-others-post', $post) === false) {
            return view('backend.user.error-403');
        }
        $post->fill($request->all());
        $post->slug = Str::slug($post->title, "-");
        $post->user_id = $request->user_id;
        if ($this->userCan('page-user-admin')) {
            $post->is_published = ($request->is_published == 1) ? '1' : '0';
            $post->published_at = $request->published_at;
        }
        $post->save();
        Toastr::success('Updated successfully.');
        return redirect()->route('admin.index');
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        if ($this->userCan('access-others-post', $post) === false) {
            return view('backend.user.error-403');
        }
        $post->delete();
        Toastr::success('Deleted successfully.');
        return redirect()->route('admin.index');
    }

}
