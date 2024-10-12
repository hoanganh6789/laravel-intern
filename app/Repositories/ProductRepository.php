<?php

namespace App\Repositories;

use App\Models\Product;


/**
 * @extends BaseRepository<Product>
 */

class ProductRepository extends BaseRepository
{
    /**
     * @var Product $model
     */
    protected $model;

    public function __construct(Product $model)
    {
        parent::__construct($model);
    }

    public function getAllWithRelation($perPage = 10)
    {
        return $this->model->with(['category', 'subCategory', 'tags'])->latest('id')->paginate($perPage);
    }
}
