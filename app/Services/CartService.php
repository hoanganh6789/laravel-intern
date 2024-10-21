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
}
