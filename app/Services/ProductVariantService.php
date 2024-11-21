<?php

namespace App\Services;

use App\Models\ProductVariant;
use Illuminate\Support\Facades\Log;

class ProductVariantService
{
    public function findByIdWhereIn($id)
    {
        try {
            return ProductVariant::with(['product', 'size', 'color'])
                ->whereIn('id', $id)
                ->orderByDesc('id')
                ->get();
        } catch (\Throwable $th) {
            //throw $th;
            Log::error($th->getMessage());
            return false;
        }
    }

    public function findByIdRelation($id)
    {
        try {
            return ProductVariant::with(['product', 'size', 'color'])
                ->where('id', $id)
                ->first();
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
        }
    }

    // public function getProductByVariantId($id)
    // {
    //     try {
    //         // return ProductVariant::with([''])
    //     } catch (\Throwable $th) {
    //         Log::error($th->getMessage());
    //     }
    // }
}
