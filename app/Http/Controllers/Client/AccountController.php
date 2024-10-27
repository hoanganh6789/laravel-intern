<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Services\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    private const PATH_VIEW = 'client.account.';

    protected $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function index()
    {
        $user = Auth::user();

        // dd($user);

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
        $orderItems = OrderItem::with(['order'])
            ->latest('id')
            ->where('order_id', $id)
            ->get();

        $order = $this->orderService->getOrderById($id);

        return view(self::PATH_VIEW . 'order_detail', compact('orderItems', 'order'));
    }
}
