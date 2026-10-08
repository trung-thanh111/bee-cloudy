<?php

use App\Http\Controllers\Api\CartController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::prefix('cart')->group(function () {
    Route::get('index', [CartController::class, 'index'])->name('cart.index');
    Route::post('store', [CartController::class, 'store'])->name('cart.store');
    // Route::post('update/{id}', [CartController::class, 'update'])->name('cart.update');
    // Route::delete('destroy/{id}', [CartController::class, 'destroy'])->name('cart.index');
});
