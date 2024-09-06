<?php

use App\Http\Controllers\Auth\LoginSocialController;
use App\Http\Controllers\Client\AboutController;
use App\Http\Controllers\Client\AccountController;
use App\Http\Controllers\Client\CartController;
use App\Http\Controllers\Client\CheckOutController;
use App\Http\Controllers\Client\ContactController;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\PolicyController;
use App\Http\Controllers\Client\ShopController;
use App\Http\Controllers\Client\WishlistController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// route client
Route::get('/',                             [HomeController::class, 'home'])->name('home');

Route::get('/shop',                         [ShopController::class, 'shop'])->name('shop.index');
Route::get('/shop/{category}',              [ShopController::class, 'shop'])->name('shop.category');
Route::get('/shop/detail/{slug}',           [ShopController::class, 'detail'])->name('shop.detail');

Route::get('/about',                        [AboutController::class, 'index'])->name('about');
Route::get('/contact',                      [ContactController::class, 'index'])->name('contact');
Route::get('/policy',                       [PolicyController::class, 'index'])->name('policy');

Route::get('/wishlist',                     [WishlistController::class, 'wishlist'])->name('wishlist.index');
Route::get('/cart',                         [CartController::class, 'index'])->name('cart.index');
Route::get('/check-out',                    [CheckOutController::class, 'index'])->name('check-out');


// middleware route
Route::middleware(['auth'])->group(function () {
    Route::get('/account',                  [AccountController::class, 'index'])->name('account.index');
});

// auth route
Route::get('/auth/redirect/{social}', [LoginSocialController::class, 'redirect'])->name('social.redirect');
Route::get('/auth/callback/{social}', [LoginSocialController::class, 'callback'])->name('social.callback');

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
