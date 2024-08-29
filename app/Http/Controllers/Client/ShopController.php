<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    private const PATH_VIEW = 'client.';
    public function shop($category = null)
    {


        if ($category) {
            $this->handleCategory($category);
        }

        $products = [
            [
                'img_1' => '/assets/theme/client/images/products/product-1.jpg',
                'img_2' => '/assets/theme/client/images/products/product-1-2.jpg',
                'type' => 'HOT',
                'sale' => '-20%',
                'category' => 'category',
                'name' => 'Ultimate 3D Bluetooth Speaker',
                'price_regular' => '90.00',
                'price_sale' => '70.00'
            ],
            [
                'img_1' => '/assets/theme/client/images/products/product-2.jpg',
                'img_2' => '/assets/theme/client/images/products/product-2-2.jpg',
                'type' => 'HOT',
                'sale' => '-20%',
                'category' => 'category',
                'name' => 'Ultimate 3D Bluetooth Speaker',
                'price_regular' => '90.00',
                'price_sale' => '70.00'
            ],
            [
                'img_1' => '/assets/theme/client/images/products/product-3.jpg',
                'img_2' => '/assets/theme/client/images/products/product-3-2.jpg',
                'type' => 'HOT',
                'sale' => '-20%',
                'category' => 'category',
                'name' => 'Ultimate 3D Bluetooth Speaker',
                'price_regular' => '90.00',
                'price_sale' => '70.00'
            ],
            [
                'img_1' => '/assets/theme/client/images/products/product-4.jpg',
                'img_2' => '/assets/theme/client/images/products/product-4-2.jpg',
                'type' => 'HOT',
                'sale' => '-20%',
                'category' => 'category',
                'name' => 'Ultimate 3D Bluetooth Speaker',
                'price_regular' => '90.00',
                'price_sale' => '70.00'
            ],
            [
                'img_1' => '/assets/theme/client/images/products/product-5.jpg',
                'img_2' => '/assets/theme/client/images/products/product-5-2.jpg',
                'type' => 'HOT',
                'sale' => '-20%',
                'category' => 'category',
                'name' => 'Ultimate 3D Bluetooth Speaker',
                'price_regular' => '90.00',
                'price_sale' => '70.00'
            ],
            [
                'img_1' => '/assets/theme/client/images/products/product-6.jpg',
                'img_2' => '/assets/theme/client/images/products/product-6-2.jpg',
                'type' => 'HOT',
                'sale' => '-20%',
                'category' => 'category',
                'name' => 'Ultimate 3D Bluetooth Speaker',
                'price_regular' => '90.00',
                'price_sale' => '70.00'
            ],
            [
                'img_1' => '/assets/theme/client/images/products/product-7.jpg',
                'img_2' => '/assets/theme/client/images/products/product-7-2.jpg',
                'type' => 'HOT',
                'sale' => '-20%',
                'category' => 'category',
                'name' => 'Ultimate 3D Bluetooth Speaker',
                'price_regular' => '90.00',
                'price_sale' => '70.00'
            ],
            [
                'img_1' => '/assets/theme/client/images/products/product-8.jpg',
                'img_2' => '/assets/theme/client/images/products/product-8-2.jpg',
                'type' => 'HOT',
                'sale' => '-20%',
                'category' => 'category',
                'name' => 'Ultimate 3D Bluetooth Speaker',
                'price_regular' => '90.00',
                'price_sale' => '70.00'
            ],
            [
                'img_1' => '/assets/theme/client/images/products/product-9.jpg',
                'img_2' => '/assets/theme/client/images/products/product-9-2.jpg',
                'type' => 'HOT',
                'sale' => '-20%',
                'category' => 'category',
                'name' => 'Ultimate 3D Bluetooth Speaker',
                'price_regular' => '90.00',
                'price_sale' => '70.00'
            ],
            [
                'img_1' => '/assets/theme/client/images/products/product-10.jpg',
                'img_2' => '/assets/theme/client/images/products/product-10-2.jpg',
                'type' => 'HOT',
                'sale' => '-20%',
                'category' => 'category',
                'name' => 'Ultimate 3D Bluetooth Speaker',
                'price_regular' => '90.00',
                'price_sale' => '70.00'
            ],
            [
                'img_1' => '/assets/theme/client/images/products/product-11.jpg',
                'img_2' => '/assets/theme/client/images/products/product-11-2.jpg',
                'type' => 'HOT',
                'sale' => '-20%',
                'category' => 'category',
                'name' => 'Ultimate 3D Bluetooth Speaker',
                'price_regular' => '90.00',
                'price_sale' => '70.00'
            ]
        ];

        return view(self::PATH_VIEW . __FUNCTION__, compact('products'));
    }

    public function detail()
    {

        $featureds = [
            [
                'img_1' => '/assets/theme/client/images/products/product-1.jpg',
                'img_2' => '/assets/theme/client/images/products/product-1-2.jpg',
                'type' => 'HOT',
                'sale' => '-20%',
                'category' => 'category',
                'name' => 'Ultimate 3D Bluetooth Speaker',
                'price_regular' => '59.00',
                'price_sale' => '49.00'
            ],
            [
                'img_1' => '/assets/theme/client/images/products/product-2.jpg',
                'img_2' => '/assets/theme/client/images/products/product-2-2.jpg',
                'type' => 'HOT',
                'sale' => '-20%',
                'category' => 'category',
                'name' => 'Ultimate 3D Bluetooth Speaker',
                'price_regular' => '59.00',
                'price_sale' => '49.00'
            ],
            [
                'img_1' => '/assets/theme/client/images/products/product-3.jpg',
                'img_2' => '/assets/theme/client/images/products/product-3-2.jpg',
                'type' => 'HOT',
                'sale' => '-20%',
                'category' => 'category',
                'name' => 'Ultimate 3D Bluetooth Speaker',
                'price_regular' => '59.00',
                'price_sale' => '49.00'
            ],
            [
                'img_1' => '/assets/theme/client/images/products/product-4.jpg',
                'img_2' => '/assets/theme/client/images/products/product-4-2.jpg',
                'type' => 'HOT',
                'sale' => '-20%',
                'category' => 'category',
                'name' => 'Ultimate 3D Bluetooth Speaker',
                'price_regular' => '59.00',
                'price_sale' => '49.00'
            ],
            [
                'img_1' => '/assets/theme/client/images/products/product-3.jpg',
                'img_2' => '/assets/theme/client/images/products/product-3-2.jpg',
                'type' => 'HOT',
                'sale' => '-20%',
                'category' => 'category',
                'name' => 'Ultimate 3D Bluetooth Speaker',
                'price_regular' => '59.00',
                'price_sale' => '49.00'
            ],
            [
                'img_1' => '/assets/theme/client/images/products/product-2.jpg',
                'img_2' => '/assets/theme/client/images/products/product-2-2.jpg',
                'type' => 'HOT',
                'sale' => '-20%',
                'category' => 'category',
                'name' => 'Ultimate 3D Bluetooth Speaker',
                'price_regular' => '59.00',
                'price_sale' => '49.00'
            ],
            [
                'img_1' => '/assets/theme/client/images/products/product-4.jpg',
                'img_2' => '/assets/theme/client/images/products/product-4-2.jpg',
                'type' => 'HOT',
                'sale' => '-20%',
                'category' => 'category',
                'name' => 'Ultimate 3D Bluetooth Speaker',
                'price_regular' => '59.00',
                'price_sale' => '49.00'
            ],
            [
                'img_1' => '/assets/theme/client/images/products/product-2.jpg',
                'img_2' => '/assets/theme/client/images/products/product-2-2.jpg',
                'type' => 'HOT',
                'sale' => '-20%',
                'category' => 'category',
                'name' => 'Ultimate 3D Bluetooth Speaker',
                'price_regular' => '59.00',
                'price_sale' => '49.00'
            ],
            [
                'img_1' => '/assets/theme/client/images/products/product-1.jpg',
                'img_2' => '/assets/theme/client/images/products/product-1-2.jpg',
                'type' => 'HOT',
                'sale' => '-20%',
                'category' => 'category',
                'name' => 'Ultimate 3D Bluetooth Speaker',
                'price_regular' => '59.00',
                'price_sale' => '49.00'
            ]
        ];

        return view(self::PATH_VIEW . 'shop-detail', compact('featureds'));
    }

    public function handleCategory($category)
    {

        //        if(\request()->price){
        //            dd($category, \request()->price);
        //        }

        if (\request()->color && \request()->price) {
            dd($category, \request()->color, \request()->price);
        }

        dd($category);
    }
}
