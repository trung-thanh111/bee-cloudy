<?php

use App\Http\Controllers\Ajax\AttributeController as AjaxAttributeController;
use App\Http\Controllers\Ajax\CartController as AjaxCartController;
use App\Http\Controllers\Ajax\ProductController as AjaxProductController;
use App\Http\Controllers\Ajax\SearchController as AjaxSearchController;
use App\Http\Controllers\Ajax\WishlistController as AjaxWishlistController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Internal Ajax Routes
|--------------------------------------------------------------------------
*/

// SEARCH SUGGESTION
Route::get('/ajax/search/suggestion', [AjaxSearchController::class, 'suggestion'])->name('ajax.search.suggestions');

// ATTRIBUTE 
Route::get('/ajax/attribute/getAttribute', [AjaxAttributeController::class, 'getAttribute'])->name('ajax.attribute.getAttribute');
Route::get('/ajax/attribute/loadAttribute', [AjaxAttributeController::class, 'loadAttribute'])->name('ajax.attribute.loadAttribute');
Route::get('ajax/product/loadVariant', [AjaxProductController::class, 'loadVariant'])->name('ajax.loadVariant');

// CART AJAX
Route::post('/ajax/cart/addToCart', [AjaxCartController::class, 'addToCart'])->name('ajax.cart.addToCart');
Route::post('/ajax/cart/updateCart', [AjaxCartController::class, 'updateCart'])->name('ajax.cart.updateCart');
Route::get('/ajax/cart/LoadOrderByCartId', [AjaxCartController::class, 'LoadOrderByCartId'])->name('ajax.cart.LoadOrderByCartId');
Route::post('/ajax/cart/sessionOrderByCartId', [AjaxCartController::class, 'sessionOrderByCartId'])->name('ajax.cart.sessionOrderByCartId');
Route::get('/ajax/cart/getOrderByCartId', [AjaxCartController::class, 'getOrderByCartId'])->name('ajax.cart.getOrderByCartId');
Route::post('/ajax/cart/clearSessionId', [AjaxCartController::class, 'clearSessionId'])->name('ajax.cart. ');
Route::delete('/ajax/cart/destroyCart', [AjaxCartController::class, 'destroyCart'])->name('ajax.cart.destroyCart');
Route::delete('/ajax/cart/clearCart', [AjaxCartController::class, 'clearCart'])->name('ajax.cart.clearCart');

// WISHLIST AJAX
Route::post('/ajax/wishlist/toggle', [AjaxWishlistController::class, 'toggle'])->name('ajax.wishlist.toggle');
