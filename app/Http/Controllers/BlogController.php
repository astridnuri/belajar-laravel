<?php

namespace App\Http\Controllers;

use App\Models\CategoryBlog;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;



class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = Blog::with('category')->orderBy('id', 'DESC')->get(); //atau ::all //bisa ambil withnya bnyak trgntung bkin brp function. with relasinya category nama functionny
        // $category= Category::with('products')->count(); //brp bnyak produk yg dibungkus category
        $title = "Blog Management || PPKD Sticker";
        return view('admin.blog.index', compact('blogs', 'title')); //tiap variabel mw di view, kasi compact
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = CategoryBlog::get(); //atau all()
        $title = "Add Blog || PPKD Sticker";
        return view('admin.blog.create', compact('categories', 'title')); //compact itu bwt ngeparsing
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated= $request->validate([
            'name' => 'required|string|max:60',
            'blog_category_id' => 'required|exists:category_blogs,id',
            'brief_description' => 'nullable|string',
            'slug' => 'nullable|string|unique:products, slug,',
            'content' => 'nullable|string',
            'author' => 'nullable|string',
            //validasi product images
            'cover_path' => 'image|mimes:png,jpg,jpeg,gif,webp|max:2048'
        ]);

        //2 tabel product & product images
        //transaction

        if($request->hasFile('cover_path')) {
            $validated['cover_path']=$request->file('cover_path')->store('blogs', 'public');
        }
        $validated['slug']=$validated['slug'] ? Str::slug($validated['slug']): Str::slug($validated['name']);
        Blog::create($validated);

        return redirect()->route('admin.blog.index')->with('success', 'Blog successfully added');

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
    public function edit(string $id)
    {

        $title = "Edit Blog || PPKD Sticker";
        return view('admin.blog.edit', compact('blog', 'title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Blog $blog)
    {
        //
        $validated = $request->validate([
            'name' => 'required|string|max:60',
            'blog_category_id' => 'required|exists:category_blogs,id',
            'brief_description' => 'nullable|string',
            'slug' => 'nullable|string|unique:products, slug,',
            'content' => 'nullable|string',
            'author' => 'nullable|string',
            //validasi product images
            'cover_path' => 'image|mimes:png,jpg,jpeg,gif,webp|max:2048'
        ]);

        //2 tabel product & product images
        //transaction

        if ($request->hasFile('cover_path')) {
            //ada gk gambar di tabel blogs
            if($blog->cover_path) {
                Storage::disk('public')->delete($blog->cover_path);
            }
            $validated['cover_path'] = $request->file('cover_path')->store('blogs', 'public');
        }
        $validated['slug'] = $validated['slug'] ? Str::slug($validated['slug']) : Str::slug($validated['name']);
        $blog->update($validated);

        return redirect()->route('admin.blog.index')->with('success', 'Blog successfully edited');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) //sblmnya string $id
    {
        //
        $blog = Blog::find($id);

        if ($blog->img) {
            Storage::disk('public')->delete($blog->img);
        }

        $blog ->delete(); //sblmnya Product::find($id);
        return redirect()->route('admin.blog.index')->with('success', 'Blog successfully deleted');

    }
}
