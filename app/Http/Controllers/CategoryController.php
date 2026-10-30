<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title="Product Category Management || PPKD Sticker";
        $categories= Category::orderBy('sort_order')->get();
        return view('admin.category.index', compact('title', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Add Category || PPKD Sticker";
        return view('admin.category.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated=$request->validate([
            'name'=>'required|string',
            'slug'=>'nullable|string|unique:categories,slug,',
            'description'=>'nullable|string',
            'sort_order'=>'nullable|integer',
            'icon'=>'nullable|string'
        ]);
        //slug digital-marketing
        $validated['slug']=$validated['slug']? Str::slug($validated['slug']) : Str::slug($validated['name']);
        $validated['sort_order']= $validated['sort_order']?? 0;
        Category::create($validated);
        return redirect()->route('admin.category.index')->with('success', 'Category added');
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
    public function edit(Category $category)
    {
        $title= "Category Edit || PPKD Sticker";
        return view('admin.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'slug' => 'nullable|string|unique:categories,slug,'.$category->id,
            'description' => 'nullable|string',
            'sort_order' => 'nullable|integer',
            'icon' => 'nullable|string'
        ]);

        $validated['slug'] = $validated['slug'] ? Str::slug($validated['slug']) : Str::slug($validated['name']);
        $validated['sort_order'] = $validated['sort_order'] ?? 0;
        //$category=Category::find($id)
        $category->update($validated);

        return redirect()->route('admin.category.index')->with('success', 'Category updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        // Category::find($id)->delete(); ini klo msh pake params string $id
        //Category::where('id',$id)->delete();
        return redirect()->route('admin.category.index')->with('success','Category deleted');
    }
}
