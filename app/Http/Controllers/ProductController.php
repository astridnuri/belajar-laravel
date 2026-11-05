<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

use Pest\Profanity\ProfanityAnalyser;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('category')->orderBy('id', 'DESC')->get(); //atau ::all //bisa ambil withnya bnyak trgntung bkin brp function. with relasinya category nama functionny
        // $category= Category::with('products')->count(); //brp bnyak produk yg dibungkus category
        $title = "Product Management || PPKD Sticker";
        return view('admin.product.index', compact('products', 'title')); //tiap variabel mw di view, kasi compact
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::get(); //atau all()
        $title = "Add Product || PPKD Sticker";
        return view('admin.product.create', compact('categories')); //compact itu bwt ngeparsing
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated= $request->validate([
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:png,jpg,jpeg,gif,webp|max:2048',
            'name' => 'required|string|max:60',
            'slug' => 'nullable|string|unique:products, slug,',
            'price' => 'required|integer',
            'art_carton_price' => 'nullable|integer',
            'art_paper_price' => 'nullable|integer',
            'hvs_price' => 'nullable|integer',
            'doff_price' => 'nullable|integer',
            'glossy_price' => 'nullable|integer',
            'brief_description' => 'nullable|string',
            'description' => 'nullable|string',

            //validasi product images
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:png,jpg,jpeg,gif,webp|max:2048',
            'alt' =>'nullable|array',
            'alt.*'=>'nullable|string|max:255',
            'sort_order'=>'nullable|integer'
        ]);

        //2 tabel product & product images
        //transaction
        DB::transaction(function() use($request, $validated){
            $product = Product::create([
                'category_id'=>$validated['category_id'],
                'name'=>$validated['name']
            ]);
            if($request->hasFile('images')){
                $imageData=[];
                foreach ($request->file('images') as $key=> $file) {
                    $path= $file->store('products', 'public');
                    $imageData[]=[
                        'path'=>$path,
                        'alt'=>$request->input('alt.{$key}') ?? $product->name,
                        'sort_order'=> $key +1
                    ];
                }
                $product->images()->createMany($imageData);
            }
        });
        return redirect()->route('admin.product.index');

        $imagePath = null;
        if ($request->image) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        Product::create([
            'category_id' => $request->category_id,
            'image' => $imagePath,
            'name' => $request->name,
            'slug' => $request->slug,
            'price' => $request->price,
            'art_carton_price' => $request->art_carton_price,
            'art_paper_price' => $request->art_paper_price,
            'hvs_price' => $request->hvs_price,
            'doff_price' => $request->doff_price,
            'glossy_price' => $request->glossy_price,
            'brief_description' => $request->brief_description,
            'description'=> $request->description
        ]);
        return redirect()->route('admin.product.index')->with('success', 'Product added!');
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
    public function edit(Product $product)
    {

        $categories = Category::get();
        return view('admin.product.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
        // return $request;
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:png,jpg,jpeg,gif,webp|max:2048',
            'name' => 'required|string|max:60',
            'slug' => 'nullable|string',
            'price' => 'required|integer',
            'art_carton_price' => 'nullable|integer',
            'art_paper_price' => 'nullable|integer',
            'hvs_price' => 'nullable|integer',
            'doff_price' => 'nullable|integer',
            'glossy_price' => 'nullable|integer',
            'brief_description' => 'nullable|string',
            'description'=>'nullable|string'
        ]);

        if ($request->hasFile('img')) {
            if ($product->img) {
                Storage::disk('public')->delete($product->img);
            }
            $validated['img'] = $request->file('img')->store('products', 'public');
        }

        $validated['slug'] = $validated['slug'] ? Str::slug($validated['slug']) : Str::slug($validated['name']);
        $validated['sort_order'] = $validated['sort_order'] ?? 0;
        // return $validated;
        //$category=Category::find($id)
        $product->update($validated);

        return redirect()->route('admin.product.index')->with('success', 'Product updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $product = Product::find($id);

        if ($product->img) {
            Storage::disk('public')->delete($product->img);
        }
        $product->delete();
    }
}
