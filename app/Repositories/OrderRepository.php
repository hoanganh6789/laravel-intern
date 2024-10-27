<?php

namespace App\Repositories;

use App\Models\Order;

class OrderRepository extends BaseRepository
{
    /**
     *
     * @var Order $model
     */
    protected $model;

    public function __construct(Order $model)
    {
        parent::__construct($model);
    }

    public function all()
    {
        return $this->model->latest('id')->get();
    }

    
}
