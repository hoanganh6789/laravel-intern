<?php


use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LoginSocialController;
use App\Http\Controllers\Auth\RegisterController;
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

// route client
Route::get('/',                             [HomeController::class, 'home'])->name('home');

Route::get('/shop',                         [ShopController::class, 'index'])->name('shop.index');
Route::get('/shop/{category}',              [ShopController::class, 'shop'])->name('shop.category');
Route::get('/shop/{slug}/detail',           [ShopController::class, 'detail'])->name('shop.detail');

// Route::get('/shop/{slug}/detail', [ShopController::class, 'detail2'])->name('shop.detail2');

Route::get('/about',                        [AboutController::class, 'index'])->name('about');
Route::get('/contact',                      [ContactController::class, 'index'])->name('contact');
Route::get('/policy',                       [PolicyController::class, 'index'])->name('policy');

Route::get('/wishlist',                     [WishlistController::class, 'wishlist'])->name('wishlist.index');
Route::get('/cart',                         [CartController::class, 'index'])->name('cart.index');

Route::get('/check-out',                    [CheckOutController::class, 'index'])->name('check-out');
Route::post('/check-out/handle', [CheckOutController::class, 'handle'])->name('check-out.handle');

// middleware route
Route::middleware(['auth'])->group(function () {
    // Route::get('/account',                  [AccountController::class, 'index'])
    //     ->name('account.index');
    Route::as('account.')
        ->prefix('/account')
        ->group(function () {
            Route::get('/', [AccountController::class, 'index'])->name('index');
            Route::get('/orders', [AccountController::class, 'orders'])->name('orders');
            Route::get('/orders/{id}', [AccountController::class, 'orderDetail'])->name('order_detail');
        });
});

// auth route
Route::get('/auth/redirect/{social}', [LoginSocialController::class, 'redirect'])->name('social.redirect');
Route::get('/auth/callback/{social}', [LoginSocialController::class, 'callback'])->name('social.callback');

Auth::routes([
    'login' => false,
    'register' => false,
    // 'verify' => true
]);

// Custom login - register
Route::get('/login', [LoginController::class, 'showFormLogin'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

Route::get('/register', [RegisterController::class, 'showFormRegister'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);



// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// ajax
Route::post('/ajax/cart/add', [ShopController::class, 'addToCart']);
Route::post('/ajax/cart/update', [CartController::class, 'update']);
