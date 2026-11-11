<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\Blog;
use App\Models\CategoryBlog;

class PageController extends Controller
{
    //
    public function faq() {
        return view('faq.index');
    }

    public function contact() {
        $setting = Setting::get();
        return view('contact.index', compact('setting'));
    }

    public function blog(Request $request) {
        $categories=CategoryBlog::withCount('blogs')->get(); //ngitung bnyakny blog per kategori
        $totalBlogsCount = Blog::count();
        // $blogs = Blog::with('category')->orderBy('id','desc')->get();
        $blogs = Blog::with('category')->latest();
        // return $blogs;
        //whereHas
        if($request->filled('category')) {
            $blogs->whereHas('category', function($q) use ($request) {
                $q->where('name', $request->category);
            });
        }
        if($request->filled('search')) {
            $searchTerm = $request;
            $blogs->where(function($q) use ($searchTerm) {
                $q->where('name', 'like', "%{$searchTerm}%")
                ->orWhere('brief_description','like', "%{$searchTerm}%")->orWhere('content', 'like', "%{$searchTerm}%");
            });
        }
        $featuredPost = null;
        if(!$request->filled('category') && !$request->filled('search')) {
            //clone query laravel tnpa ngetik2 lg
            $featuredPost = (clone $blogs)->first(); //yg dmunculkn cm 1 data
        }

        if ($featuredPost) {
            $blogs->where('id', '!=', $featuredPost->id);
        }

        $blogs=$blogs->paginate(9)->withQueryString();
        // return $blogs;

        return view('blog.index', compact('blogs', 'categories', 'totalBlogsCount', 'featuredPost'));
    }

    public function showBlog(string $id) {
        $blog= Blog::where('id', $id)->with('category')->first();
        return view('blog.show', compact('blog'));
    }
}
