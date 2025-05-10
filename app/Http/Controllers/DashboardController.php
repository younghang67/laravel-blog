<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->isAdmin()) {
            $blogs = $this->getAdminBlogs();
            $totalPosts = Post::where('status', 'published')->count();
        } else {
            $blogs = $this->getUserBlogs($user->id);
            $totalPosts = Post::where('user_id', $user->id)->count();
        }
        $totalLikes = Like::whereIn('post_id', Post::where('user_id', $user->id)->pluck('id'))->count();
        $totalCategories = Category::count();

        return view('dashboard', compact('blogs', 'totalPosts', 'totalCategories', 'totalLikes'));
    }

    protected function getAdminBlogs()
    {
        return Post::where('status', 'published')
            ->with('user')
            ->latest()
            ->take(5)
            ->get();
    }

    protected function getUserBlogs($userId)
    {
        return Post::where('status', 'published')
            ->where('user_id', $userId)
            ->with('user')
            ->latest()
            ->take(5)
            ->get();
    }
}