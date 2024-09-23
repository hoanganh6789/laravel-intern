<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProductColor;
use App\Models\ProductSize;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


class ProductController extends Controller
{
    public function index()
    {

        $productColor = ProductColor::query()->latest('id')->select(['id', 'name'])->get();
        $productSize = ProductSize::query()->latest('id')->select(['id', 'name'])->get();

        return response()->json([
            'data' => [
                'productColors' => $productColor,
                'productSizes' => $productSize,
            ],
            'message' => 'create success'
        ], Response::HTTP_OK);
    }

    public function show()
    {
        // $productColor = ProductColor::query()->latest('id')->get();
        // $productSize = ProductSize::query()->latest('id')->get();


        // return response()->json([
        //     'data' => [
        //         'productColors' => $productColor,
        //         'productSizes' => $productSize,
        //     ]
        // ], Response::HTTP_OK);
    }
}
