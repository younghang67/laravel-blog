<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Hamcrest\Core\IsEqual;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use phpDocumentor\Reflection\Types\Nullable;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $userId = Auth::id();

        $query = Post::where('user_id', $userId)->with('category')->with('likes');

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('sort')) {
            $sort = $request->sort === 'oldest' ? 'asc' : 'desc';
            $query->orderBy('created_at', $sort);
        } else {
            $query->latest();
        }
        $posts = $query->paginate(6)->withQueryString();
        $categories = Category::all();

        return view('blogs.auth-blogs', compact('posts', 'categories'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $statuses = ['draft', 'published', 'archived'];
        return view('blogs/create-blog', compact('categories', 'statuses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'category_id' => 'nullable|exists:categories,id',
            'title' => 'required|max:255|unique:posts,title,NULL,id,user_id,' . Auth::id(),
            'content' => 'required',
            'image_url' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required|in:draft,published,archived',
        ]);

        $validateData['user_id'] = Auth::id();

        if (!$request->filled('category_id')) {
            $validateData['category_id'] = Category::firstOrCreate(['name' => 'Uncategorized'])->id;
        }

        if ($request->hasFile('image_url')) {
            $imagePath = $request->file('image_url')->store('posts', 'public');
            $validateData['image_url'] = $imagePath;
        }

        $post = Post::create($validateData);

        return redirect()->route('blogs.index')->with("success", "Post created successfully!");
    }


    /**
     * Display the specified resource.
     */
    public function show(Post $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        $statuses = ['draft', 'published', 'archived'];
        return view('blogs.edit-blog', compact('post', 'categories', 'statuses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        try {
            if ($post->user_id != Auth::id()) {
                abort(403, 'Unauthorized action.');
            }

            // Validate input
            $validateData = $request->validate([
                'title' => 'required|string|max:255',
                'content' => 'required|string',
                'category_id' => 'required|exists:categories,id',
                'status' => 'required|in:draft,published,archived',
                'image_url' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'remove_image' => 'sometimes|boolean',
            ]);

            // Handle image upload or deletion
            if ($request->hasFile('image_url')) {
                // Delete the old image if it exists
                if ($post->image_url) {
                    Storage::disk('public')->delete($post->image_url);
                }

                $imagePath = $request->file('image_url')->store('posts', 'public');
                $validateData['image_url'] = $imagePath;
            } elseif ($request->input('remove_image')) {
                if ($post->image_url) {
                    Storage::disk('public')->delete($post->image_url);
                }
                $validateData['image_url'] = null;
            }

            // Update the post
            $post->update($validateData);

            return redirect()->route('blogs.index')->with("success", "Post updated successfully!");

        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->withErrors($e->validator)->withInput();
        } catch (\Illuminate\Database\QueryException $e) {
            return back()->with("error", "Database error: " . $e->getMessage())->withInput();
        } catch (\Exception $e) {
            return back()->with("error", "Something went wrong: " . $e->getMessage())->withInput();
        }
    }




    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
        return redirect()->route('blogs.index')->with('success', 'Post deleted successfully!');
    }
}
