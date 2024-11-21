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

    public function getProductBySlug($slug)
    {
        try {
            $product = $this->productRepository->getProductBySlug(['category', 'tags', 'galleries', 'variants.color', 'variants.size'], $slug);

            $colors = $product->variants->pluck('color')->unique('id');
            $sizes = $product->variants->pluck('size')->unique('id');

            return [$product, $colors, $sizes];
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return false;
        }
    }

    public function findById($id)
    {
        try {
            //code...
            $products = $this->productRepository->find($id);

            if (!empty($products)) {
                return $products;
            }
        } catch (\Throwable $th) {
            //throw $th;
            Log::error($th->getMessage());
            return false;
        }
    }

    public function findByIdWhereIn($id)
    {
        try {
            //code...
            $products = $this->productRepository->findByIdWhereIn($id);

            if (!empty($products)) {
                return $products;
            }
        } catch (\Throwable $th) {
            //throw $th;
            Log::error($th->getMessage());
            return false;
        }
    }
}
