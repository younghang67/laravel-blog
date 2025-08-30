<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class PublicPostController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::withCount([
            'posts' => function ($query) {
                $query->where('status', 'published');
            }
        ])->get();

        $latestBlogs = Post::query()
            ->with('user', 'category')
            ->where('status', 'published')
            ->latest()
            ->take(5)
            ->get();

        return view('home', compact('categories', 'latestBlogs'));
    }

    public function allLatestPost()
    {
        $blogs = Post::query()
            ->with('user', 'category')
            ->where('status', 'published')
            ->latest()
            ->paginate(6)
            ->withQueryString();

        return view('latest-posts', compact('blogs'));
    }

    public function postFilter(Request $request)
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
        $categories = Category::withCount([
            'posts' => function ($query) {
                $query->where('status', 'published');
            }
        ])->get();

        $sort = $request->input('sort', 'newest');
        $direction = $sort === 'oldest' ? 'asc' : 'desc';
        $query->orderBy('created_at', $direction);

        $blogs = $query->paginate(perPage: 6)->withQueryString();

        return view('blog-list', compact('blogs', 'categories'));
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

        $blog->load('user', 'category', 'comments.user', 'comments.children.user');


        $totalComments = $blog->comments()->count();

        return view('single-blog', [
            'blog' => $blog,
            'relatedPosts' => $relatedPosts,
            'totalComments' => $totalComments,
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

    public function postPerCat(Request $request)
    {
        $request->validate([
            'category_id' => 'required|integer|exists:categories,id',
        ]);

        $categoryId = $request->category_id;

        $posts = Post::where('category_id', $categoryId)
            ->with('user', 'category')
            ->orderBy('created_at', 'desc')
            ->get();

        // Return JSON response for AJAX
        return response()->json([
            'posts' => $posts
        ]);
    }
}