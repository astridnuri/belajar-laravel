<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CatalogueController extends Controller
{
    public function category(string $slug)
    {
        //bkin query dlu utk ngambil id ke brp slug yg dipilih
        $category = Category::with('products')->where('slug', $slug)->first();
        $products = $category->products()->paginate(10);//$products = Product::where('category_id', $category->id)->get();
        return view('category.index', compact('products', 'category'));
    }

    public function product(string $slug)
    {
        $product = Product::where('slug', $slug)->first();
        // return $product;
        return view('product.index', compact('product'));
    }
}
