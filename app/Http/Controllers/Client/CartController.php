<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    private const PATH_VIEW = 'client.';
    public function index()
    {
        $userId = Auth::id();

        if ($userId) {
            $cart = Cart::with(['cartItems.productVariant.product'])
                ->where('user_id', $userId)
                ->first();

            $total = $cart->cartItems->reduce(function ($sum, $cartItem) {
                $price = $cartItem->productVariant->product->price_sale ?: $cartItem->productVariant->product->price_regular;
                $quantity = $cartItem->quantity;

                return $sum + $price * $quantity;
            }, 0);
        }

        return view(self::PATH_VIEW . 'cart', compact('cart', 'total'));
    }
}
