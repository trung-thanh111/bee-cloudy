<?php

use App\Http\Controllers\Ajax\OrderController as AjaxOrderController;
use App\Http\Controllers\Backend\AttributeCatalogueController;
use App\Http\Controllers\Backend\AttributeController;
use App\Http\Controllers\Backend\BannerController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\PostCatalogueController;
use App\Http\Controllers\Backend\PostController;
use App\Http\Controllers\Backend\ProductCatalogueController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\PromotionController;
use App\Http\Controllers\Backend\RevenueController;
use App\Http\Controllers\Backend\UserCatalogueController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\ProductReviewController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Backend / Admin Routes (Requires 'auth' and 'admin' middleware)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    // usercatalogue
    Route::group(['prefix' => 'user/catalogue'], function () {
        Route::get('index', [UserCatalogueController::class, 'index'])->name('user.catalogue.index');
        Route::get('create', [UserCatalogueController::class, 'create'])->name('user.catalogue.create');
        Route::post('store', [UserCatalogueController::class, 'store'])->name('user.catalogue.store');
        Route::get('update/{slug}', [UserCatalogueController::class, 'update'])->name('user.catalogue.update');
        Route::post('edit/{slug}', [UserCatalogueController::class, 'edit'])->name('user.catalogue.edit');
        Route::get('delete/{id}', [UserCatalogueController::class, 'delete'])->where(['id' => '[0-9]+'])->name('user.catalogue.delete');
        Route::delete('destroy/{id}', [UserCatalogueController::class, 'destroy'])->where(['id' => '[0-9]+'])->name('user.catalogue.destroy');
    });

    // users 
    Route::group(['prefix' => 'user/'], function () {
        Route::get('index', [UserController::class, 'index'])->name('user.index');
        Route::get('create', [UserController::class, 'create'])->name('user.create');
        Route::post('store', [UserController::class, 'store'])->name('user.store');
        Route::get('update/{id}', [UserController::class, 'update'])->where(['id' => '[0-9]+'])->name('user.update');
        Route::post('edit/{id}', [UserController::class, 'edit'])->where(['id' => '[0-9]+'])->name('user.edit');
        Route::get('detail/{id}', [UserController::class, 'detail'])->where(['id' => '[0-9]+'])->name('user.detail');
        // Route::get('delete/{id}', [UserController::class, 'delete'])->where(['id' => '[0-9]+'])->name('user.delete');
        // Route::delete('destroy/{id}', [UserController::class, 'destroy'])->where(['id' => '[0-9]+'])->name('user.destroy');
    });

    // attribute catalogue
    Route::group(['prefix' => 'attribute/catalogue'], function () {
        Route::get('index', [AttributeCatalogueController::class, 'index'])->name('attribute.catalogue.index');
        Route::get('create', [AttributeCatalogueController::class, 'create'])->name('attribute.catalogue.create');
        Route::post('store', [AttributeCatalogueController::class, 'store'])->name('attribute.catalogue.store');
        Route::get('update/{slug}', [AttributeCatalogueController::class, 'update'])->name('attribute.catalogue.update');
        Route::post('edit/{slug}', [AttributeCatalogueController::class, 'edit'])->name('attribute.catalogue.edit');
        Route::get('delete/{id}', [AttributeCatalogueController::class, 'delete'])->where(['id' => '[0-9]+'])->name('attribute.catalogue.delete');
        Route::delete('destroy/{id}', [AttributeCatalogueController::class, 'destroy'])->where(['id' => '[0-9]+'])->name('attribute.catalogue.destroy');
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
    });

    // brand
    Route::group(['prefix' => 'brand'], function () {
        Route::get('index', [BrandController::class, 'index'])->name('brand.index');
        Route::get('create', [BrandController::class, 'create'])->name('brand.create');
        Route::post('store', [BrandController::class, 'store'])->name('brand.store');
        Route::get('update/{slug}', [BrandController::class, 'update'])->name('brand.update');
        Route::post('edit/{slug}', [BrandController::class, 'edit'])->name('brand.edit');
        Route::get('delete/{id}', [BrandController::class, 'delete'])->where(['id' => '[0-9]+'])->name('brand.delete');
        Route::delete('destroy/{id}', [BrandController::class, 'destroy'])->where(['id' => '[0-9]+'])->name('brand.destroy');
    });

    // product
    Route::group(['prefix' => 'product'], function () {
        Route::get('index', [ProductController::class, 'index'])->name('product.index');
        Route::get('create', [ProductController::class, 'create'])->name('product.create');
        Route::post('store', [ProductController::class, 'store'])->name('product.store');
        Route::get('update/{slug}', [ProductController::class, 'update'])->name('product.update');
        Route::post('edit/{slug}', [ProductController::class, 'edit'])->name('product.edit');
        Route::get('delete/{id}', [ProductController::class, 'delete'])->where(['id' => '[0-9]+'])->name('product.delete');
        Route::delete('destroy/{id}', [ProductController::class, 'destroy'])->where(['id' => '[0-9]+'])->name('product.destroy');
    });

    // promotion_dashboar
    Route::group(['prefix' => 'dashboard/promotion'], function () {
        Route::get('index', [PromotionController::class, 'index'])->name('promotions.index');
        Route::get('create', [PromotionController::class, 'create'])->name('promotions.create');
        Route::get('edit/{id}', [PromotionController::class, 'edit'])->where(['id' => '[0-9]+'])->name('promotions.edit');
        Route::put('update/{id}', [PromotionController::class, 'update'])->where(['id' => '[0-9]+'])->name('promotion.update');
        Route::get('show/{id}', [PromotionController::class, 'show'])->where(['id' => '[0-9]+'])->name('promotions.show'); // sửa lại thành detail
        Route::post('store', [PromotionController::class, 'store'])->name('promotions.store');
        Route::get('confirm-delete/{id}', [PromotionController::class, 'destroy'])->where(['id' => '[0-9]+'])->name('promotions.confirm_delete');
        Route::delete('delete/{id}', [PromotionController::class, 'destroy'])->where(['id' => '[0-9]+'])->name('promotions.destroy');
        Route::delete('bulkdeleteAll', [PromotionController::class, 'bulkDeleteAll'])->name('promotions.bulkdeleteAll');
    });

    // post catalogues
    Route::group(['prefix' => 'post/catalogue'], function () {
        Route::get('index', [PostCatalogueController::class, 'index'])->name('post.catalogue.index');
        Route::get('create', [PostCatalogueController::class, 'create'])->name('post.catalogue.create');
        Route::post('store', [PostCatalogueController::class, 'store'])->name('post.catalogue.store');
        Route::get('update/{slug}', [PostCatalogueController::class, 'update'])->name('post.catalogue.update');
        Route::post('edit/{slug}', [PostCatalogueController::class, 'edit'])->name('post.catalogue.edit');
        Route::get('delete/{id}', [PostCatalogueController::class, 'delete'])->where(['id' => '[0-9]+'])->name('post.catalogue.delete');
        Route::delete('destroy/{id}', [PostCatalogueController::class, 'destroy'])->where(['id' => '[0-9]+'])->name('post.catalogue.destroy');
    });

    // posts
    Route::group(['prefix' => 'post'], function () {
        Route::get('index', [PostController::class, 'index'])->name('post.index');
        Route::get('create', [PostController::class, 'create'])->name('post.create');
        Route::post('store', [PostController::class, 'store'])->name('post.store');
        Route::get('update/{slug}', [PostController::class, 'update'])->name('post.update');
        Route::post('edit/{slug}', [PostController::class, 'edit'])->name('post.edit');
        Route::get('delete/{id}', [PostController::class, 'delete'])->where(['id' => '[0-9]+'])->name('post.delete');
        Route::delete('destroy/{id}', [PostController::class, 'destroy'])->where(['id' => '[0-9]+'])->name('post.destroy');
    });

    // order //
    Route::group(['prefix' => 'order'], function () {
        Route::get('index', [OrderController::class, 'index'])->name('order.index');
        Route::get('detail/{id}', [OrderController::class, 'detail'])->where(['id' => '[0-9]+'])->name('order.detail');
        Route::post('process_cancele/{id}', [OrderController::class, 'process_cancele'])->where(['id' => '[0-9]+'])->name('order.process_cancele');
    });

    // Banner 
    Route::group(['prefix' => 'banner'], function () {
        Route::get('index', [BannerController::class, 'index'])->name('banner.index');
        Route::get('create', [BannerController::class, 'create'])->name('banner.create');
        Route::post('store', [BannerController::class, 'store'])->name('banner.store');
        Route::get('update/{id}', [BannerController::class, 'update'])->name('banner.update');
        Route::post('edit/{id}', [BannerController::class, 'edit'])->name('banner.edit');
        Route::get('delete/{id}', [BannerController::class, 'delete'])->where(['id' => '[0-9]+'])->name('banner.delete');
        Route::delete('destroy/{id}', [BannerController::class, 'destroy'])->where(['id' => '[0-9]+'])->name('banner.destroy');
    });

    // Doanh thu
    Route::get('/admin/revenue', [RevenueController::class, 'index'])->name('revenue.index');
    Route::post('/admin/thong-ke-data', [RevenueController::class, 'Thongke']);

    // ORDER UPDATE AJAX
    Route::post('/ajax/order/editNote', [AjaxOrderController::class, 'edit'])->name('ajax.order.edit');
    Route::post('/ajax/order/updateStatus', [AjaxOrderController::class, 'updateStatus'])->name('ajax.order.updateStatus');
    Route::post('/ajax/order/updatePaidAt', [AjaxOrderController::class, 'updatePaidAt'])->name('ajax.order.updatePaidAt');

    // view comment bài viết admin
    Route::get('/admin/comment-view', [ContentController::class, 'view'])->name('comment');
    Route::get('/admin/comment-data', [ContentController::class, 'getdata']);
    Route::post('/comment-update-admin', [ContentController::class, 'updateadmin']);
    Route::post('/comment-delete-admin', [ContentController::class, 'deleteadmin']);

    // view đánh giá admin
    Route::get('/admin/producreview-view', [ProductReviewController::class, 'view'])->name('productreview');
    Route::get('/admin/producreview-data', [ProductReviewController::class, 'getdata']);
    Route::post('/producreview-update-admin', [ProductReviewController::class, 'updateadmin']);
    Route::post('/producreview-delete-admin', [ProductReviewController::class, 'deleteadmin']);
});
