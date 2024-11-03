<?php

use App\Http\Controllers\Api\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/{productId}/{sizeId}/{colorId}/variants', [ProductController::class, 'filterVariant']);

// Route::post('cart/add', [ProductController::class, 'handleAddToCart']);

Route::get('/product/{id}', [ProductController::class, 'show']);
