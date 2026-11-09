<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CategoryBlog;
use Illuminate\Support\Str;

class CategoryBlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title="Blog Category Management || PPKD Sticker";
        $categories= CategoryBlog::orderBy('id')->get();
        return view('admin.category_blog.index', compact('title', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Add Blog Category || PPKD Sticker";
        return view('admin.category_blog.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated=$request->validate([
            'name'=>'required|string',
            'slug'=>'nullable|string|unique:categories,slug,',
        ]);
        //slug digital-marketing
        $validated['slug']=$validated['slug']? Str::slug($validated['slug']) : Str::slug($validated['name']);

        CategoryBlog::create($validated);
        return redirect()->route('admin.category_blog.index')->with('success', 'Blog Category added');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CategoryBlog $category)
    {
        $title= "Category Edit || PPKD Sticker";
        return view('admin.category_blog.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CategoryBlog $category)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'slug' => 'nullable|string|unique:categories,slug,'.$category->id,

        ]);

        $validated['slug'] = $validated['slug'] ? Str::slug($validated['slug']) : Str::slug($validated['name']);
        //$category=Category::find($id)
        $category->update($validated);

        return redirect()->route('admin.category_blog.index')->with('success', 'Blog Category updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CategoryBlog $category)
    {
        $category->delete();
        // Category::find($id)->delete(); ini klo msh pake params string $id
        //Category::where('id',$id)->delete();
        return redirect()->route('admin.category_blog.index')->with('success','Blog Category deleted');
    }
}
