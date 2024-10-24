<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CheckOutServices
{
    public function handleOrder($data)
    {
        if ($data['payment'] === 'momo') {
            return $this->isMomo();
        }

        try {
            $data['user_id'] = Auth::id();
            $data['status_order'] ??= 'pending';
            $data['status_payment'] ??= 'unpaid';


            DB::transaction(function () use ($data) {
                $order = Order::create($data);
                foreach ($data['product'] as $value) {
                    $order->orderItems()->create([
                        'product_variant_id' => $value['product_variant_id'],
                        'quantity' => $value['quantity'],
                        'product_name' => $value['product_name'],
                        'product_sku' => $value['product_sku'],
                        'product_img_thumbnail' => $value['product_img_thumbnail'],
                        'product_price_regular' => $value['product_price_regular'],
                        'product_price_sale' => $value['product_price_sale'],
                        'variant_size_name' => $value['variant_size_name'],
                        'variant_color_name' => $value['variant_color_name'],
                    ]);
                }
            }, 5);

            $cart = Cart::where('user_id', Auth::id())->first();

            if ($cart) {
                $cart->cartItems()->delete();
                $cart->delete();
            }
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return false;
        }
    }

    private function isMomo()
    {
        dd('momo');
    }
}
