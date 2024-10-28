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

    public function getTop10()
    {
        return $this->model
            ->with(['category', 'subCategory', 'tags'])
            ->latest('id')
            ->limit(10)
            ->get();
    }

    public function getProductRelated($categoryId, $subCategoryId, $productId)
    {
        return $this->model
            ->with(['category', 'subCategory', 'tags'])
            ->latest('id')
            ->where(function ($query) use ($categoryId, $subCategoryId) {
                $query->where('category_id', $categoryId)
                    ->orWhere('sub_category_id', $subCategoryId);
            })
            ->whereNot('id', $productId)
            ->limit(10)
            ->get();
    }
}
