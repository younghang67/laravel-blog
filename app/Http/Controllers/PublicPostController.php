<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class PublicPostController extends Controller
{
    public function index(Request $request)
    {
        $query = Post::query()
            ->with('user', 'category')
            ->where('status', 'published');

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $sort = $request->input('sort', 'newest');
        $direction = $sort === 'oldest' ? 'asc' : 'desc';
        $query->orderBy('created_at', $direction);

        $blogs = $query->paginate(6)->withQueryString();

        $categories = Category::all();

        return view('home', compact('blogs', 'categories'));
    }

    public function show(Post $blog)
    {
        $relatedPosts = Post::where('category_id', $blog->category_id)
            ->where('id', '!=', $blog->id)
            ->where('status', 'published')
            ->with('user', 'category')
            ->inRandomOrder()
            ->take(3)
            ->get();

        return view('single-blog', [
            'blog' => $blog->load('user', 'category'),
            'relatedPosts' => $relatedPosts
        ]);
    }
    public function archive(Request $request, ?Category $category = null)
    {
        $query = Post::query()
            ->with('user', 'category')
            ->where('status', 'published');

        if ($category) {
            $query->where('category_id', $category->id);
        } elseif ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        $query->orderBy('created_at', 'desc');

        $blogs = $query->paginate(6)->withQueryString();
        $categories = Category::all();

        return view('archive', compact('blogs', 'categories', 'category'));
    }


}