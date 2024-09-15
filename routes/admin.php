<?php

use App\Http\Controllers\Admin\{BannerController, CategoryController, SubCategoryController};
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\DashBoardController;
use App\Http\Controllers\Admin\FlashSaleController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController;
use App\Models\SubCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashBoardController::class, 'index'])->name('dashboard');
Route::resource('categories', CategoryController::class);
Route::resource('sub-categories', SubCategoryController::class);
Route::resource('users', UserController::class);
Route::resource('products', ProductController::class);
Route::resource('comments', CommentController::class);
Route::resource('orders', OrderController::class);
Route::resource('flash-sales', FlashSaleController::class);
Route::resource('coupons', CouponController::class);
Route::resource('banner', BannerController::class);
Route::resource('menu', MenuController::class);
