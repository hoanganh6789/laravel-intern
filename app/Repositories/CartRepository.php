<?php

namespace App\Repositories;

use App\Models\Cart;

class CartRepository extends BaseRepository
{
    /**
     * @var Cart $model
     */
    protected $model;

    public function __construct(Cart $model)
    {
        parent::__construct($model);
    }

    public function findByUserId($userId)
    {
        return $this->model->query()->findOrFail($userId);
    }

    public function findByUserIdWithRelation($userId)
    {
        return $this->model->query()->with(['cartItems.productVariant.product'])->where('user_id', $userId)->first();
    }
}
