<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount(['userPosts'])->paginate(10);
        return view('category.category', compact('categories'));
    }

    public function create()
    {
        return view('category.create-category');
    }

    public function edit(Category $category)
    {
        return view('category.edit-category', compact('category'));
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required|unique:categories|max:100',
            'slug' => 'nullable|unique:categories|max:100',
            'description' => 'nullable'
        ]);

        Category::create($validateData);
        return redirect()->route('category.index')->with("success", "Category is successfully created");
    }

    public function update(Request $request, Category $category)
    {
        $validateData = $request->validate([
            'name' => 'required|unique:categories,name,' . $category->id . '|max:100',
            'slug' => 'nullable|unique:categories,slug,' . $category->id . '|max:100',
            'description' => 'nullable'
        ]);

        $category->update($validateData);
        return redirect()->route('category.index')->with("success", "Category updated successfully");
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->route('category.index')->with('success', 'Category deleted successfully');
    }
}
