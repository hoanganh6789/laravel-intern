<?php

namespace App\Repositories;

use App\Models\CartItem;


class CartItemRepository extends BaseRepository
{
    /**
     * @var CartItem $model
     */
    protected $model;

    public function __construct(CartItem $model)
    {
        parent::__construct($model);
    }
}
