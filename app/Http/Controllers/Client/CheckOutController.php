<?php

namespace App\Http\Controllers\Client;

use App\Helper\Toastr;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrderClientRequest;
use App\Models\Cart;
use App\Services\CartService;
use App\Services\CheckOutServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckOutController extends Controller
{
    private const PATH_VIEW = 'client.';

    protected $checkOutServices;
    protected $cartServices;

    public function __construct(CheckOutServices $checkOutServices, CartService $cartService)
    {
        $this->checkOutServices = $checkOutServices;
        $this->cartServices = $cartService;
    }

    public function index()
    {
        $userId = Auth::id();

        $orderId = request()->orderId ?: null;
        $resultCode = request()->resultCode ?: null;

        $cart = [];
        $total = 0;

        if ($userId) {
            [$cart, $total] = $this->cartServices->getCartWithTotal($userId);
        } else {
            if (session()->has('cart') && session()->get('total')) {
                $cart = session('cart');
                $total = session('total');
            }
        }

        if (empty($cart)) {
            return redirect()->route('shop.index');
        }

        if (request()->has('orderId') && request()->has('resultCode') && $resultCode == 0) {
            return $this->checkOutServices->isMomo();
        }

        return view(self::PATH_VIEW . 'check-out', compact('cart', 'total'));
    }

    public function handle(StoreOrderClientRequest $request)
    {

        // StoreOrderClientRequest
        if ($request->payment == 'momo') {
            return $this->checkOutServices->handleOrder($request->all());
        }

        if ($request->payment == "thanhtoannhanhang") {
            $this->checkOutServices->handleOrder($request->all());
            Toastr::success(null, 'Mua hàng thành công');
            return redirect()->route('home');
        }
    }
}
