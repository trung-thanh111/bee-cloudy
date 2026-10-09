<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group.
|
*/

// Authentication routes
require __DIR__ . '/web/auth.php';

// Frontend public routes
require __DIR__ . '/web/frontend.php';

// Frontend authenticated routes (Profile, Order, Wishlist, Review, Comment...)
require __DIR__ . '/web/user.php';

// Internal Ajax routes
require __DIR__ . '/web/ajax.php';

// Backend / Admin management routes
require __DIR__ . '/web/backend.php';

// Fallback 404
Route::fallback(function () {
    return view('fontend.error.404');
});
