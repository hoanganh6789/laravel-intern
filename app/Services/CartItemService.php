<?php

namespace App\Services;

use App\Models\Cart;
use App\Repositories\CartItemRepository;
use App\Repositories\CartRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CartItemService
{
    protected $cartRepository;
    protected $cartItemRepository;

    public function __construct(CartRepository $cartRepository, CartItemRepository $cartItemRepository)
    {
        $this->cartRepository = $cartRepository;
        $this->cartItemRepository = $cartItemRepository;
    }

    public function handleAddToCart($data)
    {
        try {
            // $isCart = $this->findCartByUserId($data['user_id']);
            $userId = Auth::id();
            $user = Auth::user();


            return response()->json([
                'data' => $data,
                'count' => 1,
                'user_id' => $user
            ]);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return false;
        }
    }

    public function findCartByUserId($id)
    {
        return $this->cartRepository->findByUserId($id);
    }

    public function calculateCartTotal($userId)
    {
        $cart = $this->cartRepository->findByUserIdWithRelation($userId);

        if (!$cart || !$cart->cartItems) {
            return 0;
        }

        return $cart->cartItems->reduce(function ($sum, $cartItem) {
            $price = $cartItem->productVariant->product->price_sale ?: $cartItem->productVariant->product->price_regular;

            return $sum + $price * $cartItem->quantity;
        }, 0);
    }
}
