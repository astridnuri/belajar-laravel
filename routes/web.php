<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BelajarController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\HomeController;


Route::get('/', [HomeController::class, 'index']);
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
Route::prefix('admin')->name('admin.')->group(function(){
    Route::get('/login',[App\Http\Controllers\LoginController::class,'login']);
    Route::post('/actionLogin',[App\Http\Controllers\LoginController::class,'actionLogin'])->name('actionLogin');
    Route::resource('/dashboard',App\Http\Controllers\DashboardController::class);
    Route::resource('/user',App\Http\Controllers\UserController::class);
    Route::resource('/category',App\Http\Controllers\CategoryController::class);

    Route::get('/settings', [SettingController::class, 'index'])->name('settings');
    Route::post('/settings', [SettingController::class, 'update'])->name('settings.update');

});
