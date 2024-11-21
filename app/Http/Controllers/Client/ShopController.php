<?php

namespace App\Http\Controllers\Client;

use App\Helper\Toastr;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Comment;
use App\Models\Product;
use App\Services\CommentService;
use App\Services\ProductService;
use App\Services\ProductVariantService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ShopController extends Controller
{
    private const PATH_VIEW = 'client.';

    protected $commentService;
    protected $productService;

    protected $productVariantService;

    public function __construct(CommentService $commentService, ProductService $productService, ProductVariantService $productVariantService)
    {
        $this->commentService = $commentService;
        $this->productService = $productService;
        $this->productVariantService = $productVariantService;
    }

    public function index()
    {
        $products = Product::with(['category'])->latest('id')->paginate(20);
        return view('client.shop', compact('products'));
    }

    public function detail2($slug)
    {
        dd($slug);
    }
    public function shop($category = null)
    {


        if ($category) {
            $this->handleCategory($category);
        }

        $products = [
            [
                'img_1' => '/assets/theme/client/images/products/product-1.jpg',
                'img_2' => '/assets/theme/client/images/products/product-1-2.jpg',
                'type' => 'HOT',
                'sale' => '-20%',
                'category' => 'category',
                'name' => 'Ultimate 3D Bluetooth Speaker',
                'price_regular' => '90.00',
                'price_sale' => '70.00'
            ],
            [
                'img_1' => '/assets/theme/client/images/products/product-2.jpg',
                'img_2' => '/assets/theme/client/images/products/product-2-2.jpg',
                'type' => 'HOT',
                'sale' => '-20%',
                'category' => 'category',
                'name' => 'Ultimate 3D Bluetooth Speaker',
                'price_regular' => '90.00',
                'price_sale' => '70.00'
            ],
            [
                'img_1' => '/assets/theme/client/images/products/product-3.jpg',
                'img_2' => '/assets/theme/client/images/products/product-3-2.jpg',
                'type' => 'HOT',
                'sale' => '-20%',
                'category' => 'category',
                'name' => 'Ultimate 3D Bluetooth Speaker',
                'price_regular' => '90.00',
                'price_sale' => '70.00'
            ],
            [
                'img_1' => '/assets/theme/client/images/products/product-4.jpg',
                'img_2' => '/assets/theme/client/images/products/product-4-2.jpg',
                'type' => 'HOT',
                'sale' => '-20%',
                'category' => 'category',
                'name' => 'Ultimate 3D Bluetooth Speaker',
                'price_regular' => '90.00',
                'price_sale' => '70.00'
            ],
            [
                'img_1' => '/assets/theme/client/images/products/product-5.jpg',
                'img_2' => '/assets/theme/client/images/products/product-5-2.jpg',
                'type' => 'HOT',
                'sale' => '-20%',
                'category' => 'category',
                'name' => 'Ultimate 3D Bluetooth Speaker',
                'price_regular' => '90.00',
                'price_sale' => '70.00'
            ],
            [
                'img_1' => '/assets/theme/client/images/products/product-6.jpg',
                'img_2' => '/assets/theme/client/images/products/product-6-2.jpg',
                'type' => 'HOT',
                'sale' => '-20%',
                'category' => 'category',
                'name' => 'Ultimate 3D Bluetooth Speaker',
                'price_regular' => '90.00',
                'price_sale' => '70.00'
            ],
            [
                'img_1' => '/assets/theme/client/images/products/product-7.jpg',
                'img_2' => '/assets/theme/client/images/products/product-7-2.jpg',
                'type' => 'HOT',
                'sale' => '-20%',
                'category' => 'category',
                'name' => 'Ultimate 3D Bluetooth Speaker',
                'price_regular' => '90.00',
                'price_sale' => '70.00'
            ],
            [
                'img_1' => '/assets/theme/client/images/products/product-8.jpg',
                'img_2' => '/assets/theme/client/images/products/product-8-2.jpg',
                'type' => 'HOT',
                'sale' => '-20%',
                'category' => 'category',
                'name' => 'Ultimate 3D Bluetooth Speaker',
                'price_regular' => '90.00',
                'price_sale' => '70.00'
            ],
            [
                'img_1' => '/assets/theme/client/images/products/product-9.jpg',
                'img_2' => '/assets/theme/client/images/products/product-9-2.jpg',
                'type' => 'HOT',
                'sale' => '-20%',
                'category' => 'category',
                'name' => 'Ultimate 3D Bluetooth Speaker',
                'price_regular' => '90.00',
                'price_sale' => '70.00'
            ],
            [
                'img_1' => '/assets/theme/client/images/products/product-10.jpg',
                'img_2' => '/assets/theme/client/images/products/product-10-2.jpg',
                'type' => 'HOT',
                'sale' => '-20%',
                'category' => 'category',
                'name' => 'Ultimate 3D Bluetooth Speaker',
                'price_regular' => '90.00',
                'price_sale' => '70.00'
            ],
            [
                'img_1' => '/assets/theme/client/images/products/product-11.jpg',
                'img_2' => '/assets/theme/client/images/products/product-11-2.jpg',
                'type' => 'HOT',
                'sale' => '-20%',
                'category' => 'category',
                'name' => 'Ultimate 3D Bluetooth Speaker',
                'price_regular' => '90.00',
                'price_sale' => '70.00'
            ]
        ];

        return view(self::PATH_VIEW . __FUNCTION__, compact('products'));
    }

    public function detail($slugProduct)
    {

        try {
            [$product, $colors, $sizes] = $this->productService->getProductBySlug($slugProduct);

            $comments = $this->commentService->getComment($product->id);

            $relatedProducts = $this->productService->allProductRelated($product->category_id, $product->sub_category_id, $product->id);

            $featureds = [
                [
                    'img_1' => '/assets/theme/client/images/products/product-1.jpg',
                    'img_2' => '/assets/theme/client/images/products/product-1-2.jpg',
                    'type' => 'HOT',
                    'sale' => '-20%',
                    'category' => 'category',
                    'name' => 'Ultimate 3D Bluetooth Speaker',
                    'price_regular' => '59.00',
                    'price_sale' => '49.00'
                ],
                [
                    'img_1' => '/assets/theme/client/images/products/product-2.jpg',
                    'img_2' => '/assets/theme/client/images/products/product-2-2.jpg',
                    'type' => 'HOT',
                    'sale' => '-20%',
                    'category' => 'category',
                    'name' => 'Ultimate 3D Bluetooth Speaker',
                    'price_regular' => '59.00',
                    'price_sale' => '49.00'
                ],
                [
                    'img_1' => '/assets/theme/client/images/products/product-3.jpg',
                    'img_2' => '/assets/theme/client/images/products/product-3-2.jpg',
                    'type' => 'HOT',
                    'sale' => '-20%',
                    'category' => 'category',
                    'name' => 'Ultimate 3D Bluetooth Speaker',
                    'price_regular' => '59.00',
                    'price_sale' => '49.00'
                ],
                [
                    'img_1' => '/assets/theme/client/images/products/product-4.jpg',
                    'img_2' => '/assets/theme/client/images/products/product-4-2.jpg',
                    'type' => 'HOT',
                    'sale' => '-20%',
                    'category' => 'category',
                    'name' => 'Ultimate 3D Bluetooth Speaker',
                    'price_regular' => '59.00',
                    'price_sale' => '49.00'
                ],
                [
                    'img_1' => '/assets/theme/client/images/products/product-3.jpg',
                    'img_2' => '/assets/theme/client/images/products/product-3-2.jpg',
                    'type' => 'HOT',
                    'sale' => '-20%',
                    'category' => 'category',
                    'name' => 'Ultimate 3D Bluetooth Speaker',
                    'price_regular' => '59.00',
                    'price_sale' => '49.00'
                ],
                [
                    'img_1' => '/assets/theme/client/images/products/product-2.jpg',
                    'img_2' => '/assets/theme/client/images/products/product-2-2.jpg',
                    'type' => 'HOT',
                    'sale' => '-20%',
                    'category' => 'category',
                    'name' => 'Ultimate 3D Bluetooth Speaker',
                    'price_regular' => '59.00',
                    'price_sale' => '49.00'
                ],
                [
                    'img_1' => '/assets/theme/client/images/products/product-4.jpg',
                    'img_2' => '/assets/theme/client/images/products/product-4-2.jpg',
                    'type' => 'HOT',
                    'sale' => '-20%',
                    'category' => 'category',
                    'name' => 'Ultimate 3D Bluetooth Speaker',
                    'price_regular' => '59.00',
                    'price_sale' => '49.00'
                ],
                [
                    'img_1' => '/assets/theme/client/images/products/product-2.jpg',
                    'img_2' => '/assets/theme/client/images/products/product-2-2.jpg',
                    'type' => 'HOT',
                    'sale' => '-20%',
                    'category' => 'category',
                    'name' => 'Ultimate 3D Bluetooth Speaker',
                    'price_regular' => '59.00',
                    'price_sale' => '49.00'
                ],
                [
                    'img_1' => '/assets/theme/client/images/products/product-1.jpg',
                    'img_2' => '/assets/theme/client/images/products/product-1-2.jpg',
                    'type' => 'HOT',
                    'sale' => '-20%',
                    'category' => 'category',
                    'name' => 'Ultimate 3D Bluetooth Speaker',
                    'price_regular' => '59.00',
                    'price_sale' => '49.00'
                ]
            ];

            return view(
                self::PATH_VIEW . 'shop-detail',
                compact(
                    'featureds',
                    'product',
                    'colors',
                    'sizes',
                    'comments',
                    'relatedProducts'
                )
            );
        } catch (\Throwable $th) {
            abort(404);
        }
    }

    public function handleCategory($category)
    {

        //        if(\request()->price){
        //            dd($category, \request()->price);
        //        }

        if (\request()->color && \request()->price) {
            dd($category, \request()->color, \request()->price);
        }

        dd($category);
    }


    // return response()->json([
    //     'user' => $userId,
    //     'status' => true,
    //     'message' => "thanh cong"
    // ]);

    public function addToCart(Request $request)
    {
        $userId = Auth::id();

        if (!$userId) {
            // Khởi tạo session cart rỗng
            $cart = session('cart', []);

            $productVariantId = $request->product_variant_id;
            $productQuantity = $request->quantity;

            // Lấy thông tin sản phẩm
            $productVariant = $this->productVariantService->findByIdRelation($productVariantId);

            if (!$productVariant) {
                return response()->json([
                    'message' => 'Sản phẩm không tồn tại',
                    'status' => false
                ], Response::HTTP_NOT_FOUND);
            }

            $price = $productVariant->product->price_sale ?: $productVariant->product->price_regular;
            $subTotal = $price * $productQuantity;

            if (isset($cart[$productVariantId])) {
                // Đã tồn tại id thì cộng số lượng, cộng trừ số lượng
                $cart[$productVariantId]['quantity'] += $productQuantity;
                $cart[$productVariantId]['subTotal'] += $subTotal;
            } else {
                // Chưa tồn tại thì = mảng mới
                // $cart[$productVariantId] = $request->all();

                $cart[$productVariantId] = [
                    'product_variant_id' => $productVariantId,
                    'image' => $productVariant->product->thumb_image,
                    'name' => $productVariant->product->name,
                    'color' => $productVariant->color->name,
                    'size' => $productVariant->size->name,
                    'price' => $price,
                    'quantity' => $productQuantity,
                    'subTotal' => $subTotal,
                    'slug' => $productVariant->product->slug,
                ];
            }

            session(['cart' => $cart]);
            $total = array_sum(array_column($cart, 'subTotal'));
            session()->put('total', $total);

            return response()->json([
                'count' => count(session('cart')),
                'message' => 'Thêm vào giỏ hàng thành công',
                'status' => true,
                'carts' => $cart,
                'total' => $total
            ], Response::HTTP_OK);
        }

        try {
            DB::transaction(function () use ($userId, $request) {
                $cart = Cart::firstOrCreate([
                    'user_id' => $userId
                ]);

                $cartItem = CartItem::query()
                    ->where([
                        ['cart_id', $cart->id],
                        ['product_variant_id', $request->product_variant_id]
                    ])->first();

                if ($cartItem) {
                    $cartItem->increment('quantity', $request->quantity);
                } else {
                    CartItem::create([
                        'cart_id' => $cart->id,
                        'product_variant_id' => $request->product_variant_id,
                        'quantity' => $request->quantity
                    ]);
                }
            });

            $countCart = Cart::where('user_id', $userId)->first()->cartItems()->count();

            return response()->json([
                'count' => $countCart,
                'message' => 'Thêm vào giỏ hàng thành công',
                'status' => true
            ], Response::HTTP_OK);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            return response()->json([
                'message' => 'Serve Error',
                'status' => false
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        // if ($userId) {

        //     DB::transaction(function () use ($userId, $request) {
        //         $cart = Cart::firstOrCreate([
        //             'user_id' => $userId
        //         ]);

        //         $cartItem = CartItem::query()
        //             ->where([
        //                 ['cart_id', $cart->id],
        //                 ['product_variant_id', $request->product_variant_id]
        //             ])->first();

        //         if ($cartItem) {
        //             $cartItem->increment('quantity', $request->quantity);
        //         } else {
        //             CartItem::create([
        //                 'cart_id' => $cart->id,
        //                 'product_variant_id' => $request->product_variant_id,
        //                 'quantity' => $request->quantity
        //             ]);
        //         }

        //         // $countCart = $cart->cartItems()->count();

        //         $countCart = CartItem::query()->where('cart_id', $cart->id)->count();
        //         $message = "Thêm vào giỏ hàng thành công";

        //         return response()->json([
        //             'count' => $countCart,
        //             'message' => $message,
        //             'status' => true
        //         ]);
        //     });


        //     // $isCart = Cart::query()->where('user_id', $userId)->first();

        //     // // nếu cart rỗng thì create
        //     // if (empty($isCart)) {
        //     //     $isCart = Cart::create([
        //     //         'user_id' => $userId
        //     //     ]);
        //     // }

        //     // $checkCartItem = CartItem::query()->where([
        //     //     ['cart_id', $isCart->id],
        //     //     ['product_variant_id', $request->product_variant_id]
        //     // ])->first();

        //     // // nếu cart_item chưa có sản phẩm thì create
        //     // if (empty($checkCartItem)) {
        //     //     CartItem::create([
        //     //         'cart_id' => $isCart->id,
        //     //         'product_variant_id' => $request->product_variant_id,
        //     //         'quantity' => $request->quantity
        //     //     ]);
        //     // } else {
        //     //     CartItem::query()->where([
        //     //         ['cart_id', $isCart->id],
        //     //         ['product_variant_id', $request->product_variant_id]
        //     //     ])->increment('quantity', $request->quantity);
        //     // }


        //     // $countCart = CartItem::query()->where('cart_id', $isCart->id)->count();
        //     // $message = "Thêm vào giỏ hàng thành công";
        // } else {
        //     return response()->json([
        //         'message' => 'Thêm không thành công',
        //         'status' => false
        //     ]);
        // }
    }

    public function handleComment(Request $request)
    {
        $comment = $this->commentService->createComment($request->all());

        if ($comment) {
            Toastr::success(null, 'Cảm ơn bạn đã comment');
            return back();
        }
    }
}
