<?php

namespace App\Services;

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

    
}
