<?php

namespace App\Http\Controllers\Api;

use App\Helper\Toastr;
use App\Http\Controllers\Controller;
use App\Models\ProductColor;
use App\Models\ProductSize;
use App\Models\ProductVariant;
use App\Services\CartItemService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    protected $cartItemService;

    public function __construct(CartItemService $cartItemService)
    {
        $this->cartItemService = $cartItemService;
    }

    public function index()
    {

        $productColor = ProductColor::query()->latest('id')->select(['id', 'name'])->get();
        $productSize = ProductSize::query()->latest('id')->select(['id', 'name'])->get();

        $colorId = request()->get('color_id');
        $sizeId = request()->get('size_id');

        return response()->json([
            'data' => [
                'productColors' => $productColor,
                'productSizes' => $productSize,
            ],
            'message' => 'create success'
        ], Response::HTTP_OK);
    }

    public function show()
    {
        // $productColor = ProductColor::query()->latest('id')->get();
        // $productSize = ProductSize::query()->latest('id')->get();


        // return response()->json([
        //     'data' => [
        //         'productColors' => $productColor,
        //         'productSizes' => $productSize,
        //     ]
        // ], Response::HTTP_OK);
    }

    public function filterVariant($productId, $sizeId, $colorId)
    {

        $variantId = ProductVariant::query()
            ->where([
                ['product_id', $productId],
                ['product_size_id', $sizeId],
                ['product_color_id', $colorId],
            ])
            ->first(['id']);

        if (!$variantId) {
            return response()->json([
                'message' => "Not Found",
                'status' => false
            ], Response::HTTP_NOT_FOUND);
        }

        return response()->json([
            'variantId' => $variantId->id,
            'status' => true
        ], Response::HTTP_OK);
    }

    public function handleAddToCart(Request $request)
    {
        // return $this->cartItemService->handleAddToCart($request->all());


        try {
            // $isCart = $this->findCartByUserId($data['user_id']);
            $userId = Auth::id();
            $user = Auth::user();


            return response()->json([
                'data' => $request->all(),
                'count' => 1,
                'user_id' => $user
            ]);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return false;
        }

        // $data = $request->all();

        // return response()->json([
        //     'count' => 1,
        //     'data' => $data
        // ]);
    }
}
