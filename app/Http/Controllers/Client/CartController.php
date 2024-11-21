<?php

namespace App\Http\Controllers\Client;

use App\Helper\Toastr;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use App\Services\CartItemService;
use App\Services\CartService;
use App\Services\ProductService;
use App\Services\ProductVariantService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    private const PATH_VIEW = 'client.';
    protected $cartItemService;
    protected $cartService;
    protected $productService;
    protected $productVariantService;

    public function __construct(
        CartItemService $cartItemService,
        CartService $cartService,
        ProductService $productService,
        ProductVariantService $productVariantService
    ) {
        $this->cartItemService = $cartItemService;
        $this->cartService = $cartService;
        $this->productService = $productService;
        $this->productVariantService = $productVariantService;
    }

    public function index()
    {
        $userId = Auth::id();

        if ($userId) {
            [$cart, $total] = $this->cartService->getCartWithTotal($userId);
            // return view(self::PATH_VIEW . 'cart', compact('cart', 'total'));
        } else {
            $dataCart = session('cart');

            if (empty($dataCart)) {
                $cart = [];
                $total = 0;
            } else {
                $productIds = array_keys($dataCart);

                $productVariannts = $this->productVariantService->findByIdWhereIn($productIds);
                $total = 0;

                // $products = $productVariannts->product;

                $cart = $productVariannts->map(function ($product) use ($dataCart, &$total) {
                    $productVariantId = $product->id;
                    $quantity = $dataCart[$productVariantId]['quantity'];

                    $price = $product->product->price_sale ?: $product->product->price_regular;
                    $productTotal = $price * $quantity;
                    $total += $productTotal;

                    $newItem = [
                        'product_variant_id' => $productVariantId,
                        'image' => $product->product->thumb_image,
                        'name' => $product->product->name,
                        'color' => $product->color->name,
                        'size' => $product->size->name,
                        'price' => $price,
                        'quantity' => $quantity,
                        'subTotal' => $productTotal,
                        'slug' => $product->product->slug,
                    ];

                    session()->put("cart.$productVariantId", $newItem);

                    // return [
                    //     // 'product_variant_id' => $productVariantId,
                    //     // 'quantity' => $quantity,
                    //     // 'name' => $product->product->name,
                    //     // 'price' => $price,
                    //     // 'total' => $productTotal,
                    //     // 'data' => $product


                    //     ##@@@@@##
                    //     'product_variant_id' => $productVariantId,
                    //     'image' => $product->product->thumb_image,
                    //     'name' => $product->product->name,
                    //     'color' => $product->color->name,
                    //     'size' => $product->size->name,
                    //     'price' => $price,
                    //     'quantity' => $quantity,
                    //     'subTotal' => $productTotal,
                    //     'slug' => $product->product->slug
                    //     // 'data' => $product
                    // ];
                });

                session()->put('total', $total);

                $cart = $dataCart;

                // dd($cart, $total);
            }
        }

        return view(self::PATH_VIEW . 'cart', compact('cart', 'total'));
    }

    public function update(Request $request)
    {
        try {
            $quantity = $request->quantity;
            $id = $request->id;

            $user = Auth::user();

            if ($user) {
                $cartItem = $this->cartItemService->find($id);

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
            } else {
                // Lấy data session cart
                $cartItem = session('cart');
                // kiểm tra có tồn tại bản ghi k
                if (isset($cartItem[$id])) {
                    $cartItem[$id]['quantity'] = $quantity;
                    $cartItem[$id]['subTotal'] = $cartItem[$id]['price'] * $cartItem[$id]['quantity'];
                    session(['cart' => $cartItem]);

                    $total = array_reduce($cartItem, function ($total, $item) {
                        return $total + $item['subTotal'];
                    }, 0);
                }

                return response()->json([
                    'quantity' => $quantity,
                    'id' => $id,
                    'subTotal' => $cartItem[$id]['subTotal'],
                    'total' => $total,
                    'status' => true,
                    'cart' => $cartItem[$id]
                ]);
            }


        } catch (\Throwable $th) {
            Log::error($th->getMessage());
        }
    }
}
