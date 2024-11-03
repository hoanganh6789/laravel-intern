<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Services\OrderItemService;
use App\Services\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    private const PATH_VIEW = 'client.account.';

    protected $orderService;
    protected $orderItemService;

    public function __construct(OrderService $orderService, OrderItemService $orderItemService)
    {
        $this->orderService = $orderService;
        $this->orderItemService = $orderItemService;
    }

    public function index()
    {
        $user = Auth::user();
        return view(self::PATH_VIEW . 'dashboard', compact('user'));
    }

    public function orders()
    {
        $userId = Auth::id();
        $orders = $this->orderService->getOrderWithUserId($userId);
        return view(self::PATH_VIEW . __FUNCTION__, compact('orders'));
    }

    public function orderDetail($id)
    {
        $orderItems = $this->orderItemService->getAllWithRelation($id);
        $order = $this->orderService->getOrderById($id);

        return view(self::PATH_VIEW . 'order_detail', compact('orderItems', 'order'));
    }
}
