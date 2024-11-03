<?php

namespace App\Repositories;

use App\Models\OrderItem;

class OrderItemRepository extends BaseRepository
{
    /**
     * @var OrderItem $model
     */

    protected $model;
    public function __construct(OrderItem $model)
    {
        parent::__construct($model);
    }

    public function getAllWithRelation($orderId)
    {
        return $this->model
            ->with(['order'])
            ->latest('id')
            ->where('order_id', $orderId)
            ->get();
    }
}
