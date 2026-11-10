<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BelajarController;
use App\Http\Controllers\CategoryBlogController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CatalogueController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\LoginController;



// return view('welcome');
// return view('layout.app');

Route::get('belajar', [BelajarController::class, 'index']);
Route::get('tambah', [BelajarController::class, 'tambah'])->name('tambah'); //yg kiri nama route yg kanan nama function
Route::post('actionTambah', [BelajarController::class, 'actionTambah'])->name('actionTambah'); //yg kiri nama route yg kanan nama function
Route::get('pengurangan', [BelajarController::class, 'kurang'])->name('pengurangan'); //yg kiri nama route yg kanan nama function
Route::post('actionKurang', [BelajarController::class, 'actionKurang'])->name('actionKurang'); //yg kiri nama route yg kanan nama function
Route::get('perkalian', [BelajarController::class, 'kali'])->name('perkalian'); //yg kiri nama route yg kanan nama function
Route::post('actionKali', [BelajarController::class, 'actionKali'])->name('actionKali'); //yg kiri nama route yg kanan nama function
Route::get('bagi', [BelajarController::class, 'bagi'])->name('bagi'); //yg kiri nama route yg kanan nama function
Route::post('actionBagi', [BelajarController::class, 'actionBagi'])->name('actionBagi'); //yg kiri nama route yg kanan nama function

//prefix
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [App\Http\Controllers\LoginController::class, 'login']);
    Route::get('/login', [App\Http\Controllers\LoginController::class, 'login']);
    Route::post('/actionLogin', [App\Http\Controllers\LoginController::class, 'actionLogin'])->name('actionLogin');

    Route::middleware(['auth'])->group(function () {
        Route::resource('/dashboard', App\Http\Controllers\DashboardController::class);
        Route::resource('/user', App\Http\Controllers\UserController::class);
        Route::resource('/category', App\Http\Controllers\CategoryController::class);
        Route::resource('/product', App\Http\Controllers\ProductController::class);
        Route::resource('/category_blog', CategoryBlogController::class);
        Route::resource('/blog', BlogController::class);

        Route::get('/settings', [SettingController::class, 'index'])->name('settings');
        Route::post('/settings', [SettingController::class, 'update'])->name('settings.update');

        // Route::get('logout', LoginController::class, 'logout')->name('logout'); method get ini bwt ngetes aj

        Route::post('logout', [LoginController::class, 'logout'])->name('logout');
    });

});

Route::get('/', [HomeController::class, 'index']);
Route::get('/category/{slug}', [CatalogueController::class, 'category'])->name('category.show');
Route::get('product', [CatalogueController::class, 'listing'])->name('product.index');
Route::get('/product/{slug}', [CatalogueController::class, 'product'])->name('product.show');

Route::get('faq', [PageController::class, 'faq'])->name('faq.index');
Route::get('contact', [PageController::class, 'contact'])->name('contact.index');
Route::get('blog', [PageController::class, 'blog'])->name('blog.index');
Route::get('blog/{slug}', [PageController::class, 'showBlog'])->name('blog.show');
