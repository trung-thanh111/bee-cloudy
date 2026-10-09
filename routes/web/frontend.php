<?php

use App\Http\Controllers\Ajax\SearchController as AjaxSearchController;
use App\Http\Controllers\Fontend\HomeController;
use App\Http\Controllers\Fontend\PostController as FontendPostController;
use App\Http\Controllers\Fontend\ProductController as FontendProductController;
use App\Http\Controllers\Fontend\ShopController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Frontend Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home_index.index');
Route::get('home', [HomeController::class, 'index'])->name('home.index');
Route::get('shop', [ShopController::class, 'index'])->name('shop.index');
Route::get('product/category/{id}', [ShopController::class, 'productIncategory'])->where(['id' => '[0-9]+'])->name('product.category');
Route::get('product/brand/{id}', [ShopController::class, 'productInBrand'])->where(['id' => '[0-9]+'])->name('product.brand');
Route::get('product/filter', [ShopController::class, 'productFilter'])->name('product.filter');
Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');
Route::get('product/detail/{slug}', [FontendProductController::class, 'detail'])->name('product.detail');
Route::get('search', [AjaxSearchController::class, 'search'])->name('search');

// Page other
Route::get('faq', [HomeController::class, 'faq'])->name('home.faq');
Route::get('/contact', [HomeController::class, 'showForm'])->name('home.contact');
Route::post('/contact/send', [HomeController::class, 'send'])->name('contact.send');
Route::get('terms_and_conditions', [HomeController::class, 'terms_and_conditions'])->name('home.terms_and_conditions');
Route::get('return_and_warranty_policy', [HomeController::class, 'return_and_warranty_policy'])->name('home.return_and_warranty_policy');
Route::get('about_us', [HomeController::class, 'about_us'])->name('home.about_us');
Route::get('security_center', [HomeController::class, 'security_center'])->name('home.security_center');

// POST
Route::group(['prefix' => 'post'], function () {
    Route::get('page', [FontendPostController::class, 'index'])->name('post.page');
    Route::get('category/{id}', [FontendPostController::class, 'postInCategory'])->where(['id' => '[0-9]+'])->name('post.category');
    Route::get('detail/{slug}', [FontendPostController::class, 'detail'])->name('post.detail');
});
