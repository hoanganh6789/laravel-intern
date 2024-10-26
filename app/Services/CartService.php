<?php

namespace App\Services;

use App\Repositories\CartItemRepository;
use App\Repositories\CartRepository;

class CartService
{
    protected $cartRepository;
    protected $cartItemRepository;

    public function __construct(CartRepository $cartRepository, CartItemRepository $cartItemRepository)
    {
        $this->cartRepository = $cartRepository;
        $this->cartItemRepository = $cartItemRepository;
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

    public function getAllByUserId($userId)
    {
        return $this->cartRepository->findByUserIdWithRelation($userId);
    }

    public function getCartWithTotal($userId)
    {
        $cart = $this->cartRepository->findByUserIdWithRelation($userId);

        if (!$cart || !$cart->cartItems) {
            return [null, 0];
        }

        $total = $cart->cartItems->reduce(function ($sum, $cartItem) {
            $price = $cartItem->productVariant->product->price_sale ?: $cartItem->productVariant->product->price_regular;

            return $sum + $price * $cartItem->quantity;
        }, 0);

        return [$cart, $total];
    }
}
