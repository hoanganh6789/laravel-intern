<?php

namespace App\Http\Controllers\Client;

use App\Helper\Toastr;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use App\Services\CartItemService;
use App\Services\CartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    private const PATH_VIEW = 'client.';
    protected $cartItemService;
    protected $cartService;

    public function __construct(CartItemService $cartItemService, CartService $cartService)
    {
        $this->cartItemService = $cartItemService;
        $this->cartService = $cartService;
    }

    public function index()
    {
        $userId = Auth::id();

        if ($userId) {
            [$cart, $total] = $this->cartService->getCartWithTotal($userId);
        } else {
            $cart = [];
            $total = 0;
        }

        return view(self::PATH_VIEW . 'cart', compact('cart', 'total'));
    }

    public function update(Request $request)
    {
        try {
            $quantity = $request->quantity;
            $id = $request->id;

            $cartItem = CartItem::query()->where('id', $id)->first();

            if (!$cartItem) {
                return response()->json([
                    'quantity' => $quantity - 1,
                    'id' => $id,
                    'status' => false
                ]);
            }

            $cartItem->update(['quantity' => $quantity]);

            $subTotal = $cartItem->quantity * ($cartItem->productVariant->product->price_sale ?: $cartItem->productVariant->product->price_regular);

            $total = $this->cartItemService->calculateCartTotal($cartItem->cart->user_id);

            return response()->json([
                'quantity' => $quantity,
                'id' => $id,
                'subTotal' => $subTotal,
                'total' => $total,
                'status' => true
            ]);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
        }
    }
}
