<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function index()
    {
        if ($this->userCan('page-user-admin')) {
            $posts = DB::table('posts')
                ->orderByDesc('id')
                ->paginate(10);
        } else {
            $posts = DB::table('posts')
                ->where('status', 'show')
                ->where('is_published', true)
                ->orderByDesc('id')
                ->paginate(10);
        }
        return view('frontend.index', compact('posts'));
    }

    public function about()
    {
        return view('frontend.about');
    }

    public function post($id)
    {
        if ($this->userCan('page-user-admin')) {
            $post = Post::findOrFail($id);
        } else {
            $post = Post::where('id', $id)
                ->where('status', 'show')
                ->where('is_published', true)
                ->where('published_at', '<=', now())
                ->firstOrFail();
        }
        return view('frontend.post', compact('post'));
    }
}
