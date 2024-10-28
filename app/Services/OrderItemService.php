<?php

namespace App\Services;

use App\Repositories\OrderItemRepository;
use Illuminate\Support\Facades\Log;

class OrderItemService
{
    protected $orderItemRepository;

    public function __construct(OrderItemRepository $orderItemRepository)
    {
        $this->orderItemRepository = $orderItemRepository;
    }

    public function getAllWithRelation($orderId)
    {
        try {
            return $this->orderItemRepository->getAllWithRelation($orderId);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return false;
        }
    }
}
