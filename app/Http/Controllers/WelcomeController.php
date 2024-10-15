<?php

namespace App\Http\Controllers;

use App\Models\Subsidiary;
use App\Models\Post;
use App\Models\Property;
use Illuminate\Support\Carbon;

class WelcomeController extends Controller
{
    public function index()
    {
        $posts = Post::with('user')->latest()->take(6)->get();
        $todayPostsCount = $this->countTodayPosts();
        $properties = Property::all();
        $subsidiaries = Subsidiary::all();
        return view('welcome', compact('posts', 'todayPostsCount', 'properties', 'subsidiaries'));
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

    /**
     * Display the detailed view of the specified resource.
     */
    public function showDetails(Subsidiary $subsidiary)
    {
        $relatedSubsidiaries = $this->getRelatedSubsidiaries($subsidiary);
        return view('subsidiaries_details', compact('subsidiary', 'relatedSubsidiaries'));
    }

    /**
     * Get related subsidiaries for the given subsidiary.
     */
    private function getRelatedSubsidiaries(Subsidiary $subsidiary)
    {
        return Subsidiary::where('id', '!=', $subsidiary->id)
                         ->take(3)
                         ->get();
    }

    /**
     * Display the MHRPCI page.
     */
    public function showMhrpci()
    {
        $subsidiaries = Subsidiary::all();
        return view('mhrpci', compact('subsidiaries'));
    }
}
