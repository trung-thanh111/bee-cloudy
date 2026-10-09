<?php

use App\Http\Controllers\Ajax\CartController as AjaxCartController;
use App\Http\Controllers\Ajax\WishlistController as AjaxWishlistController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\Fontend\FPromotionController;
use App\Http\Controllers\Fontend\MomoController;
use App\Http\Controllers\Fontend\OrderController as FontendOrderController;
use App\Http\Controllers\Fontend\UserController as FontendUserController;
use App\Http\Controllers\Fontend\VnpayController;
use App\Http\Controllers\ProductReviewController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Frontend Authenticated Routes (Requires 'auth' middleware)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    // PROFILE USER
    Route::get('/profile', [FontendUserController::class, 'profile'])->name('profile.user');
    Route::get('/profile/change-pass', [FontendUserController::class, 'changeViewProfile'])->name('profile.change-view');
    Route::post('/profile/change-pass', [FontendUserController::class, 'changeSubmitProfile'])->name('profile.change-submit');
    Route::get('/confirm-password-change/{token}', [FontendUserController::class, 'confirmPasswordChange'])->name('confirm.password.change');
    Route::get('/profile/edit', [FontendUserController::class, 'editProfile'])->name('profile.edit');
    Route::post('/profile/edit', [FontendUserController::class, 'updateProfile'])->name('profile.update');

    // Account
    Route::group(['prefix' => 'account'], function () {
        Route::get('info', [FontendUserController::class, 'info'])->name('account.info');
        Route::get('view_order', [FontendOrderController::class, 'view_order'])->name('account.order');
        Route::get('view_promotion', [FPromotionController::class, 'view_promotion'])->name('account.promotions');
        Route::get('/view_promotion/{id}', [FPromotionController::class, 'show'])->name('account.promotion.show');
        Route::get('order/detail/{id}', [FontendOrderController::class, 'detail'])->where(['id' => '[0-9]+'])->name('account.order.detail');
    });

    // Cart
    Route::group(['prefix' => 'cart'], function () {
        Route::get('index', [AjaxCartController::class, 'index'])->name('cart.index');
        Route::post('/apply-discount', [AjaxCartController::class, 'applyPromotion'])->name('cart.applyDiscount');
        Route::post('/remove-voucher/{voucherId}', [AjaxCartController::class, 'removeVoucher'])->name('cart.removeVoucher');
    });

    // Promotion
    Route::get('/promotion', [FPromotionController::class, 'index'])->name('promotion.home_index');
    Route::post('/receive/{promotion}', [FPromotionController::class, 'receivePromotion'])->name('promotion.receive');

    // ORDER
    Route::group(['prefix' => 'order'], function () {
        Route::get('checkout', [FontendOrderController::class, 'checkout'])->name('order.checkout');
        Route::post('store', [FontendOrderController::class, 'store'])->name('store.order');
        Route::get('success', [FontendOrderController::class, 'success'])->name('order.success');
        Route::get('failed', [FontendOrderController::class, 'failed'])->name('order.failed');
    });

    // WISHLIST
    Route::group(['prefix' => 'wishlist'], function () {
        Route::get('index', [AjaxWishlistController::class, 'index'])->name('wishlist.index');
    });

    // PAYMENT VNPAY
    Route::get('return/vnpay', [VnpayController::class, 'vnpayReturn'])->name('vnpay.return');
    Route::get('return/vnpay_ipn', [VnpayController::class, 'vnpayIpn'])->name('vnpay.ipn');

    // PAYMENT MOMO
    Route::get('return/momo', [MomoController::class, 'momoReturn'])->name('momo.return');
    Route::get('return/momo_ipn', [MomoController::class, 'momoIpn'])->name('momo.ipn');

    // ĐÁNH GIÁ SẢN PHẨM
    Route::get('/producreview', [ProductReviewController::class, 'index']);
    Route::get('/information', [ProductReviewController::class, 'view_order']);
    Route::get('/producreview-data/{slug}', [ProductReviewController::class, 'data']);
    Route::post('/producreview/create/{slug}', [ProductReviewController::class, 'create']);
    Route::post('/producreview/like', [ProductReviewController::class, 'like']);
    Route::get('/producreview/like-data/{slug}', [ProductReviewController::class, 'likedata']);
    Route::get('/product/check/{slug}', [ProductReviewController::class, 'checkIfRated']);
    Route::post('/producreview-delete', [ProductReviewController::class, 'delete']);
    Route::post('/producreview-update', [ProductReviewController::class, 'update']);

    // BÌNH LUẬN BÀI VIẾT
    Route::get('/view-content', [ContentController::class, 'view_content']);
    Route::get('/view-content-data', [ContentController::class, 'data']);
    Route::post('/view-content-create', [ContentController::class, 'create']);
    Route::post('/view-content-delete', [ContentController::class, 'delete']);
    Route::post('/view-content-update', [ContentController::class, 'update']);
    Route::post('/content/like', [ContentController::class, 'like']);
    Route::get('/content/like-data', [ContentController::class, 'likedata']);
    Route::get('/content/check', [ContentController::class, 'checkIfRated']);
    Route::get('/comments', [ContentController::class, 'loadCommentsPage']);
});
