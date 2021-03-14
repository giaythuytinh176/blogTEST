<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateRequest;
use App\Http\Requests\EditRequest;
use App\Models\Post;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function schedulePost()
    {
        $posts = DB::table('posts')
            ->where('published_at', '<=', now())
            ->where('is_published', false)
            ->orderByDesc('published_at')
            ->get();
        $posts->each(function ($post) {
            DB::table('posts')->where('id', $post->id)->update(['is_published' => true]);
        });

        $posts2 = DB::table('posts')
            ->where('published_at', '>', now())
            ->where('is_published', true)
            ->orderByDesc('published_at')
            ->get();
        $posts2->each(function ($post2) {
            DB::table('posts')->where('id', $post2->id)->update(['is_published' => false]);
        });
    }

    public function index()
    {
        if ($this->userCan('page-user-admin')) {
            $posts = DB::table('posts')
                ->orderByDesc('id')
                ->paginate(10);
        } else {
            $posts = DB::table('posts')
                ->where('user_id', Auth::user()->id)
                ->orderByDesc('id')
                ->paginate(10);
        }
        return view('backend.post.index', compact('posts'));
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
            $post->published_at = now();
            $post->status = 'hide';
        } else {
            $post->published_at = $request->published_at;
            $post->status = $request->status;
        }
        $post->save();
        Toastr::success('Post published.');
        return redirect()->route('admin.index');
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        if ($this->userCan('access-others-post', $post) === false) {
            return view('backend.user.error-403');
        }
        return view('backend.post.edit', compact('post'));
    }

    public function update(EditRequest $request)
    {
        $post = Post::findOrFail($request->id);
        if ($this->userCan('access-others-post', $post) === false) {
            return view('backend.user.error-403');
        }
        $post->fill($request->all());
        $post->slug = Str::slug($post->title, "-");
        $post->user_id = $request->user_id;
        if ($this->userCan('page-user-admin')) {
            $post->status = $request->status;
            $post->published_at = $request->published_at;
        }
        $post->save();
        Toastr::success('Post Updated.');
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
