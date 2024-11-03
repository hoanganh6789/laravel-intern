<?php

namespace App\Services;

use App\Models\Order;
use App\Repositories\OrderRepository;
use Illuminate\Support\Facades\Log;

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

    public function getAllPaginate()
    {
        try {
            return $this->orderRepository->getAllWithRelation(['orderItems'], 10);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return false;
        }
    }

    public function deleteOrder($id)
    {
        try {
            //code...

            $order =  $this->findById($id);

            if ($order) {
                return $order->delete();
            }
        } catch (\Throwable $th) {
            //throw $th;
            Log::error($th->getMessage());
            return false;
        }
    }

    public function findById($id)
    {
        try {
            //code...
            $order =  $this->orderRepository->find($id);
            if (!empty($order)) {
                return $order;
            }
        } catch (\Throwable $th) {
            //throw $th;
            Log::error($th->getMessage());
            return false;
        }
    }
}
