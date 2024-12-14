<?php

namespace App\Services;

use App\Helper\Toastr;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use App\Repositories\OrderRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CheckOutServices
{

    protected $orderRepository;
    protected $momoService;
    public function __construct(OrderRepository $orderRepository, MomoService $momoService)
    {
        $this->orderRepository = $orderRepository;
        $this->momoService = $momoService;
    }

    // public function handleOrder($data)
    // {
    //     $user = Auth::user();

    //     try {


    //         if ($user) {
    //             $data['user_id'] = Auth::id();
    //             $data['status_order'] ??= 'pending';
    //             $data['status_payment'] ??= 'unpaid';


    //             if ($data['payment'] === 'momo') {
    //                 $data['status_payment'] = 'paid';
    //                 session(['data-checkout' => $data]);
    //                 // return $this->handleMomo($data['total_price']);
    //                 return $this->momoService->redirectMomo($data['total_price']); // update new use service
    //             }


    //             return $this->createOrderAndOrderItem($data);
    //         } else {
    //             // Transaction
    //             /**
    //              * Thêm người dùng khi nhập form
    //              * Lấy id của người dùng và truyền id để insert vào bảng order
    //              * Lưu bảng order item
    //              */

    //             if ($data['payment'] == 'momo') {
    //                 $data['status_payment'] = 'paid';
    //                 session(['data-checkout' => $data]);
    //                 return $this->momoService->redirectMomo($data['total_price']);
    //             }

    //             // dd($data);

    //             DB::transaction(function () use ($data) {
    //                 $user = User::create([
    //                     'name' => $data['user_name'],
    //                     'email' => $data['user_email'],
    //                     'phone' => $data['user_phone'],
    //                     'is_active' => 0,
    //                     'role' => 'member'
    //                 ]);

    //                 $order = Order::create([
    //                     'user_id' => $user->id,
    //                     'user_name' => $user->name,
    //                     'user_email' => $user->email,
    //                     'user_phone' => $user->phone,
    //                     'user_address' => $data['user_address'],
    //                     'status_order' => 'pending',
    //                     'status_payment' => 'unpaid',
    //                     'total_price' => $data['total_price']
    //                 ]);

    //                 foreach ($data['product'] as $key => $product) {
    //                     OrderItem::create([
    //                         'order_id' => $order->id,
    //                         'product_variant_id' => $key,
    //                         'quantity' => $product['quantity'],
    //                         'product_name' => $product['product_name'],
    //                         'product_sku' => $product['product_sku'],
    //                         'product_img_thumbnail' => $product['product_img_thumbnail'],
    //                         'product_price_regular' => $product['product_price_regular'],
    //                         'product_price_sale' => $product['product_price_sale'],
    //                         'variant_size_name' => $product['variant_size_name'],
    //                         'variant_color_name' => $product['variant_color_name'],
    //                     ]);
    //                 }
    //             });

    //             session()->forget('cart');
    //             session()->forget('total');

    //             return true;
    //         }
    //     } catch (\Throwable $th) {
    //         Log::error($th->getMessage());
    //         return false;
    //     }
    // }

    // public function isMomo()
    // {
    //     // xử lý logic sau khi thanh toán thành công
    //     $data = session('data-checkout');

    //     $user = Auth::user();

    //     if ($user) {
    //         if (!empty($data)) {
    //             $this->createOrderAndOrderItem($data);
    //         }
    //     } else {
    //         DB::transaction(function () use ($data) {
    //             $user = User::create([
    //                 'name' => $data['user_name'],
    //                 'email' => $data['user_email'],
    //                 'phone' => $data['user_phone'],
    //                 'is_active' => 0,
    //                 'role' => 'member'
    //             ]);

    //             $order = Order::create([
    //                 'user_id' => $user->id,
    //                 'user_name' => $user->name,
    //                 'user_email' => $user->email,
    //                 'user_phone' => $user->phone,
    //                 'user_address' => $data['user_address'],
    //                 'status_order' => 'pending',
    //                 'status_payment' => 'unpaid',
    //                 'total_price' => $data['total_price']
    //             ]);

    //             foreach ($data['product'] as $key => $product) {
    //                 OrderItem::create([
    //                     'order_id' => $order->id,
    //                     'product_variant_id' => $key,
    //                     'quantity' => $product['quantity'],
    //                     'product_name' => $product['product_name'],
    //                     'product_sku' => $product['product_sku'],
    //                     'product_img_thumbnail' => $product['product_img_thumbnail'],
    //                     'product_price_regular' => $product['product_price_regular'],
    //                     'product_price_sale' => $product['product_price_sale'],
    //                     'variant_size_name' => $product['variant_size_name'],
    //                     'variant_color_name' => $product['variant_color_name'],
    //                 ]);
    //             }
    //         });

    //         session()->forget('cart');
    //         session()->forget('total');
    //     }

    //     Toastr::success(null, 'Thanh toán thành công');
    //     return redirect()->route('shop.index');
    // }

    // protected function createOrderAndOrderItem($data)
    // {
    //     DB::transaction(function () use ($data) {
    //         $order = $this->orderRepository->create($data);

    //         foreach ($data['product'] as $value) {
    //             $order->orderItems()->create([
    //                 'product_variant_id' => $value['product_variant_id'],
    //                 'quantity' => $value['quantity'],
    //                 'product_name' => $value['product_name'],
    //                 'product_sku' => $value['product_sku'],
    //                 'product_img_thumbnail' => $value['product_img_thumbnail'],
    //                 'product_price_regular' => $value['product_price_regular'],
    //                 'product_price_sale' => $value['product_price_sale'],
    //                 'variant_size_name' => $value['variant_size_name'],
    //                 'variant_color_name' => $value['variant_color_name'],
    //             ]);
    //         }
    //     }, 5);

    //     $cart = Cart::where('user_id', Auth::id())->first();

    //     if ($cart) {
    //         $cart->cartItems()->delete();
    //         $cart->delete();
    //     }
    // }


    public function handleOrder($data)
    {
        $user = Auth::user();

        try {
            if ($user) {
                return $this->processAuthenticatedOrder($user, $data);
            }

            return $this->processGuestOrder($data);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return false;
        }
    }

    protected function processAuthenticatedOrder($user, array $data)
    {
        $data['user_id'] = $user->id;
        $data['status_order'] ??= 'pending';
        $data['status_payment'] ??= 'unpaid';

        ## Option thanh toán momo
        if ($this->isMomoPayment($data)) {
            return $this->redirectToMomo($data);
        }

        // Option: thanh toán nhận hàng thì tạo đơn hàng mới
        return $this->createOrderAndOrderItems($data);
    }

    ##

    protected function processGuestOrder(array $data)
    {
        // Option: thanh toán momo
        if ($this->isMomoPayment($data)) {
            return $this->redirectToMomo($data);
        }
        ;

        // Optio: thanh toán nhận hàng
        DB::transaction(function () use ($data) {
            $user = $this->createGuestUser($data);
            $data['user_id'] = $user->id;
            $this->createOrderAndOrderItems($data);
        });

        $this->clearSessionCart();
        return true;
    }

    ##
    protected function redirectToMomo(array $data)
    {
        session(['data-checkout' => $data]);
        return $this->momoService->redirectMomo($data['total_price']);
    }

    ##
    protected function createGuestUser(array $data)
    {
        return User::create([
            'name' => $data['user_name'],
            'email' => $data['user_email'],
            'phone' => $data['user_phone'],
            'is_active' => 0,
            'role' => 'member'
        ]);
    }

    ##
    protected function createOrderAndOrderItems(array $data)
    {
        DB::transaction(function () use ($data) {

            $order = $this->orderRepository->create($data);

            foreach ($data as $key => $product) {
                $order->orderItems()->create([
                    'product_variant_id' => $product['product_variant_id'],
                    'quantity' => $product['quantity'],
                    'product_name' => $product['product_name'],
                    'product_sku' => $product['product_sku'],
                    'product_img_thumbnail' => $product['product_img_thumbnail'],
                    'product_price_regular' => $product['product_price_regular'],
                    'product_price_sale' => $product['product_price_sale'],
                    'variant_size_name' => $product['variant_size_name'],
                    'variant_color_name' => $product['variant_color_name'],
                ]);
            }
        });

        // Sau khi tạo xong thì cart và cart_items
        $this->clearUserCart();
    }

    ## clear cart
    protected function clearUserCart()
    {
        if ($cart = Cart::where('user_id', Auth::id())->first()) {
            $cart->cartItems()->delete();
            $cart->delete();
        }
    }

    ## clear session
    protected function clearSessionCart()
    {
        session()->forget(['cart', 'total']);
    }

    ## check isset payment is momo
    protected function isMomoPayment($data)
    {
        return isset($data['payment']) && $data['payment'] === 'momo';
    }
}
