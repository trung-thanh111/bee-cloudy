<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Backend\AttributeCatalogueController;
use App\Http\Controllers\Backend\AttributeController;
use App\Http\Controllers\Ajax\AttributeController as AjaxAttributeController;
use App\Http\Controllers\Ajax\ProductController as AjaxProductController;
use App\Http\Controllers\Ajax\CartController as AjaxCartController;
use App\Http\Controllers\Fontend\CartController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\PostCatalogueController;
use App\Http\Controllers\Backend\PostController;
use App\Http\Controllers\Backend\ProductCatalogueController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Fontend\ProductController as FontendProductController;
use App\Http\Controllers\Fontend\HomeController;
use App\Http\Controllers\Fontend\ShopController;
use App\Http\Controllers\Backend\PromotionController;
use Illuminate\Support\Facades\Route;

// AJAX 
Route::get('/ajax/attribute/getAttribute', [AjaxAttributeController::class, 'getAttribute'])->name('ajax.attribute.getAttribute');
Route::get('/ajax/attribute/loadAttribute', [AjaxAttributeController::class, 'loadAttribute'])->name('ajax.attribute.loadAttribute');
Route::get('ajax/product/loadVariant', [AjaxProductController::class, 'loadVariant'])->name('ajax.loadVariant');
Route::post('/ajax/cart/addToCart', [AjaxCartController::class, 'addToCart'])->name('ajax.cart.addToCart');
Route::post('/ajax/cart/updateCart', [AjaxCartController::class, 'updateCart'])->name('ajax.cart.updateCart');
Route::delete('/ajax/cart/destroyCart', [AjaxCartController::class, 'destroyCart'])->name('ajax.cart.destroyCart');
Route::delete('/ajax/cart/clearCart', [AjaxCartController::class, 'clearCart'])->name('ajax.cart.clearCart');

//FONTEND
Route::get('home', [HomeController::class, 'index'])->name('home.index');
Route::get('shop', [ShopController::class, 'index'])->name('shop.index');
Route::get('/product', [ShopController::class, 'index'])->name('shop.index');
Route::get('product/detail/{slug}', [FontendProductController::class, 'detail'])->name('product.detail');

Route::middleware(['auth'])->group(function () {
    Route::group(['prefix' => 'cart'], function () {
        Route::get('index', [AjaxCartController::class, 'index'])->name('cart.index');
    });
    Route::get('/promotion', [PromotionController::class, 'showAllPromotions'])->name('promotion.index');

    Route::post('/promotion/receive/{promotion}', [PromotionController::class, 'receivePromotion'])->name('promotion.receive');
    // Route::get('/my-vouchers', [PromotionController::class, 'myVouchers'])->name('promotion.my_vouchers');
});

//BACKEND
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    // attribute catalogue
    Route::group(['prefix' => 'attribute/catalogue'], function () {
        Route::get('index', [AttributeCatalogueController::class, 'index'])->name('attribute.catalogue.index');
        Route::get('create', [AttributeCatalogueController::class, 'create'])->name('attribute.catalogue.create');
        Route::post('store', [AttributeCatalogueController::class, 'store'])->name('attribute.catalogue.store');
        Route::get('update/{slug}', [AttributeCatalogueController::class, 'update'])->name('attribute.catalogue.update');
        Route::post('edit/{slug}', [AttributeCatalogueController::class, 'edit'])->name('attribute.catalogue.edit');
        Route::get('delete/{id}', [AttributeCatalogueController::class, 'delete'])->where(['id' => '[0-9]+'])->name('attribute.catalogue.delete');
        Route::delete('destroy/{id}', [AttributeCatalogueController::class, 'destroy'])->where(['id' => '[0-9]+'])->name('attribute.catalogue.destroy');
        Route::delete('bulk-delete', [AttributeCatalogueController::class, 'destroyMultiple'])->name('attribute.catalogue.bulkdelete');
    });

    // attribute 
    Route::group(['prefix' => 'attribute'], function () {
        Route::get('index', [AttributeController::class, 'index'])->name('attribute.index');
        Route::get('create', [AttributeController::class, 'create'])->name('attribute.create');
        Route::post('store', [AttributeController::class, 'store'])->name('attribute.store');
        Route::get('update/{slug}', [AttributeController::class, 'update'])->name('attribute.update');
        Route::post('edit/{slug}', [AttributeController::class, 'edit'])->name('attribute.edit');
        Route::get('delete/{id}', [AttributeController::class, 'delete'])->where(['id' => '[0-9]+'])->name('attribute.delete');
        Route::delete('destroy/{id}', [AttributeController::class, 'destroy'])->where(['id' => '[0-9]+'])->name('attribute.destroy');
        Route::delete('bulk-delete', [AttributeController::class, 'destroyMultiple'])->name('attribute.bulkdelete');
    });

    // product catalogue
    Route::group(['prefix' => 'product/catalogue'], function () {
        Route::get('index', [ProductCatalogueController::class, 'index'])->name('product.catalogue.index');
        Route::get('create', [ProductCatalogueController::class, 'create'])->name('product.catalogue.create');
        Route::post('store', [ProductCatalogueController::class, 'store'])->name('product.catalogue.store');
        Route::get('update/{slug}', [ProductCatalogueController::class, 'update'])->name('product.catalogue.update');
        Route::post('edit/{slug}', [ProductCatalogueController::class, 'edit'])->name('product.catalogue.edit');
        Route::get('delete/{id}', [ProductCatalogueController::class, 'delete'])->where(['id' => '[0-9]+'])->name('product.catalogue.delete');
        Route::delete('destroy/{id}', [ProductCatalogueController::class, 'destroy'])->where(['id' => '[0-9]+'])->name('product.catalogue.destroy');
        Route::delete('bulk-delete', [ProductCatalogueController::class, 'destroyMultiple'])->name('product.catalogue.bulkdelete');
    });

    //brand
    Route::group(['prefix' => 'brand'], function () {
        Route::get('index', [BrandController::class, 'index'])->name('brand.index');
        Route::get('create', [BrandController::class, 'create'])->name('brand.create');
        Route::post('store', [BrandController::class, 'store'])->name('brand.store');
        Route::get('update/{slug}', [BrandController::class, 'update'])->name('brand.update');
        Route::post('edit/{slug}', [BrandController::class, 'edit'])->name('brand.edit');
        Route::get('delete/{id}', [BrandController::class, 'delete'])->where(['id' => '[0-9]+'])->name('brand.delete');
        Route::delete('destroy/{id}', [BrandController::class, 'destroy'])->where(['id' => '[0-9]+'])->name('brand.destroy');
        Route::delete('bulk-delete', [BrandController::class, 'destroyMultiple'])->name('brand.bulkdelete');
    });

    //product
    Route::group(['prefix' => 'product'], function () {
        Route::get('index', [ProductController::class, 'index'])->name('product.index');
        Route::get('create', [ProductController::class, 'create'])->name('product.create');
        Route::post('store', [ProductController::class, 'store'])->name('product.store');
        Route::get('update/{slug}', [ProductController::class, 'update'])->name('product.update');
        Route::post('edit/{slug}', [ProductController::class, 'edit'])->name('product.edit');
        Route::get('delete/{id}', [ProductController::class, 'delete'])->where(['id' => '[0-9]+'])->name('product.delete');
        Route::delete('destroy/{id}', [ProductController::class, 'destroy'])->where(['id' => '[0-9]+'])->name('product.destroy');
        Route::delete('bulk-delete', [ProductController::class, 'destroyMultiple'])->name('product.bulkdelete');
    });

    Route::group(['prefix' => 'promotion'], function () {

        Route::get('/create', [PromotionController::class, 'create'])->name('promotions.catalogue.create');
        Route::get('/index', [PromotionController::class, 'index'])->name('promotions.index');
        Route::get('/edit/{id}', [PromotionController::class, 'edit'])->name('promotions.catalogue.edit');
        Route::put('/update/{id}', [PromotionController::class, 'update'])->name('promotions.update');
        Route::post('/index', [PromotionController::class, 'store'])->name('promotions.catalogue.store');
    });

    //post catalogues
    Route::group(['prefix' => 'post/catalogue'], function () {
        Route::get('index', [PostCatalogueController::class, 'index'])->name('post.catalogue.index');
        Route::get('create', [PostCatalogueController::class, 'create'])->name('post.catalogue.create');
        Route::post('store', [PostCatalogueController::class, 'store'])->name('post.catalogue.store');
        Route::get('update/{slug}', [PostCatalogueController::class, 'update'])->name('post.catalogue.update');
        Route::post('edit/{slug}', [PostCatalogueController::class, 'edit'])->name('post.catalogue.edit');
        Route::get('delete/{id}', [PostCatalogueController::class, 'delete'])->where(['id' => '[0-9]+'])->name('post.catalogue.delete');
        Route::delete('destroy/{id}', [PostCatalogueController::class, 'destroy'])->where(['id' => '[0-9]+'])->name('post.catalogue.destroy');
        Route::delete('bulk-delete', [PostCatalogueController::class, 'destroyMultiple'])->name('post.catalogue.bulkdelete');
    });

    //posts
    Route::group(['prefix' => 'post'], function () {
        Route::get('index', [PostController::class, 'index'])->name('post.index');
        Route::get('create', [PostController::class, 'create'])->name('post.create');
        Route::post('store', [PostController::class, 'store'])->name('post.store');
        Route::get('update/{slug}', [PostController::class, 'update'])->name('post.update');
        Route::post('edit/{slug}', [PostController::class, 'edit'])->name('post.edit');
        Route::get('delete/{id}', [PostController::class, 'delete'])->where(['id' => '[0-9]+'])->name('post.delete');
        Route::delete('destroy/{id}', [PostController::class, 'destroy'])->where(['id' => '[0-9]+'])->name('post.destroy');
        Route::delete('bulk-delete', [PostController::class, 'destroyMultiple'])->name('post.bulkdelete');
    });
});


Route::get('shop', [ShopController::class, 'index'])->name('shop.index');
Route::get('/product', [ShopController::class, 'index'])->name('shop.index');
Route::get('login', [LoginController::class, 'index'])->name('auth.login');
Route::post('store-login', [LoginController::class, 'login'])->name('store.login');

Route::get('register', [RegisterController::class, 'index'])->name('auth.register');
Route::post('register-store', [RegisterController::class, 'register'])->name('store.register');
Route::get('/confirm-registration/{token}', [RegisterController::class, 'confirmRegistration'])->name('confirm.registration');
// bấm để nhận voucher cho người dùng 
// Route::post('/receive-voucher/{voucher}', [VoucherController::class, 'receiveVoucher'])->name('user.receiveVoucher');

Route::get('logout', [AuthController::class, 'logout'])->name('auth.logout');

// get attribute & load
Route::get('/ajax/attribute/getAttribute', [AjaxAttributeController::class, 'getAttribute'])->name('ajax.attribute.getAttribute');
Route::get('/ajax/attribute/loadAttribute', [AjaxAttributeController::class, 'loadAttribute'])->name('ajax.attribute.loadAttribute');
Route::post('/ajax/cart/addToCart', [AjaxCartController::class, 'addToCart'])->name('ajax.cart.addToCart');
// search attribute product 

Route::get('ajax/product/loadVariant', [AjaxProductController::class, 'loadVariant'])->name('ajax.loadVariant');

// home
Route::get('home', [HomeController::class, 'index'])->name('home.index');

// login gg & fb
// Route để bắt đầu quá trình đăng nhập với Google
Route::get('auth/google', [LoginController::class, 'redirectToGoogle'])->name('auth.google');

// Route để xử lý callback từ Google
Route::get('auth/google/callback', [LoginController::class, 'handleGoogleCallback'])->name('auth.google.callback');
