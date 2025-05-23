<?php

namespace App\Services;

use App\Helper\Toastr;
use App\Models\Cart;
use App\Models\Order;
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

    public function handleOrder($data)
    {
        try {
            $data['user_id'] = Auth::id();
            $data['status_order'] ??= 'pending';
            $data['status_payment'] ??= 'unpaid';


            if ($data['payment'] === 'momo') {
                $data['status_payment'] = 'paid';
                session(['data-checkout' => $data]);
                // return $this->handleMomo($data['total_price']);
                return $this->momoService->redirectMomo($data['total_price']); // update new use service
            }


            return $this->createOrderAndOrderItem($data);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return false;
        }
    }

    public function isMomo()
    {
        // xử lý logic sau khi thanh toán thành công
        $data = session('data-checkout');

        if (!empty($data)) {
            $this->createOrderAndOrderItem($data);
        }

        Toastr::success(null, 'Thanh toán thành công');
        return redirect()->route('shop.index');
    }


    public function execPostRequest($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data)
            )
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        //execute post
        $result = curl_exec($ch);
        //close connection
        curl_close($ch);
        return $result;
    }

    public function handleMomo($amount = 0)
    {
        $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";

        $partnerCode = 'MOMOBKUN20180529';
        $accessKey = 'klm05TvNBzhg7h7j';
        $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
        $orderInfo = "Thanh toán qua MoMo";
        // $amount = "10000";
        $orderId = time() . "";
        $redirectUrl = "https://laravel-intern.test/check-out";
        $ipnUrl = "https://laravel-intern.test/check-out";
        $extraData = "";

        $requestId = time() . "";
        $requestType = "payWithATM";
        // $extraData = ($_POST["extraData"] ? $_POST["extraData"] : "");

        //before sign HMAC SHA256 signature
        $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
        $signature = hash_hmac("sha256", $rawHash, $secretKey);
        $data = array(
            'partnerCode' => $partnerCode,
            'partnerName' => "Test",
            "storeId" => "MomoTestStore",
            'requestId' => $requestId,
            'amount' => $amount,
            'orderId' => $orderId,
            'orderInfo' => $orderInfo,
            'redirectUrl' => $redirectUrl,
            'ipnUrl' => $ipnUrl,
            'lang' => 'vi',
            'extraData' => $extraData,
            'requestType' => $requestType,
            'signature' => $signature
        );
        $result = $this->execPostRequest($endpoint, json_encode($data));
        $jsonResult = json_decode($result, true);  // decode json

        return redirect()->to($jsonResult['payUrl']);
    }

    protected function createOrderAndOrderItem($data)
    {
        DB::transaction(function () use ($data) {
            $order = $this->orderRepository->create($data);

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
    }
}
