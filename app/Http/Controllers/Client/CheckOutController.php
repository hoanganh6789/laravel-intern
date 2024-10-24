<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrderClientRequest;
use App\Models\Cart;
use App\Services\CheckOutServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckOutController extends Controller
{
    private const PATH_VIEW = 'client.';

    protected $checkOutServices;

    public function __construct(CheckOutServices $checkOutServices)
    {
        $this->checkOutServices = $checkOutServices;
    }

    public function index()
    {
        $userId = Auth::id();

        $cart = [];

        if ($userId) {
            $cart = Cart::with(['cartItems.productVariant.product'])
                ->where('user_id', $userId)
                ->first();


            if (empty($cart)) {
                return redirect()->route('shop.index');
            }

            $total = $cart->cartItems->reduce(function ($sum, $cartItem) {
                $price = $cartItem->productVariant->product->price_sale ?: $cartItem->productVariant->product->price_regular;
                $quantity = $cartItem->quantity;

                return $sum + $price * $quantity;
            }, 0);
        } else {
            $cart = [];
        }

        return view(self::PATH_VIEW . 'check-out', compact('cart', 'total'));
    }

    public function handle(Request $request)
    {

        $order = $this->checkOutServices->handleOrder($request->all());

        // if ($order) {
        //     return redirect()->route('home');
        // } else {
        //     return back();
        // }

        // return $this->checkOutServices->handleOrder($request->all());
    }
}
