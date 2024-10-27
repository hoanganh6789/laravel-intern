<?php

namespace App\Services;

use App\Models\Order;
use App\Repositories\OrderRepository;

class OrderService
{
    protected $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function create(array $data)
    {
        return $this->orderRepository->create($data);
    }

    public function getOrderById($id)
    {
        return $this->orderRepository->find($id);
    }

    public function getOrderWithUserId($userId)
    {
        $orders = Order::with(['orderItems'])->latest('id')->where('user_id', $userId)->get();

        return $orders;

        // dd($quantity);

        // dd($order);
    }
}
