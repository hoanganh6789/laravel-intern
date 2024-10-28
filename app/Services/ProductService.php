<?php

namespace App\Services;

use App\Repositories\ProductRepository;
use Illuminate\Log\Logger;
use Illuminate\Support\Facades\Log;

class ProductService
{
    protected $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function all()
    {
        return $this->productRepository->getAllWithRelation(1);
    }

    public function allProductRelated($categoryId, $subCategoryId, $productId)
    {
        try {
            return $this->productRepository->getProductRelated($categoryId, $subCategoryId, $productId);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return false;
        }
    }

    public function getTop10Product()
    {
        try {
            return $this->productRepository->getTop10();
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return false;
        }
    }
}
