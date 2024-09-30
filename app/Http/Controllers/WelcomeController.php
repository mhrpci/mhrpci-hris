<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Carbon;

class WelcomeController extends Controller
{
    public function index()
    {
        $posts = Post::with('user')->latest()->take(6)->get();
        $todayPostsCount = $this->countTodayPosts();
        return view('welcome', compact('posts', 'todayPostsCount'));
    }

    public function showPost($id)
    {
        $post = Post::findOrFail($id);
        $relatedPosts = $this->getRelatedPosts($post);
        return view('posts', compact('post', 'relatedPosts'));
    }

    private function countTodayPosts()
    {
        return Post::whereDate('created_at', Carbon::today())->count();
    }

    private function getRelatedPosts($post)
    {
        return Post::where('id', '!=', $post->id)
                    ->whereDate('created_at', Carbon::today())
                    ->take(3)
                    ->get();
    }
}
