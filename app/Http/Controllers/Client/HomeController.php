<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    private const PATH_VIEW = 'client.';
    public function home()
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
        return view(self::PATH_VIEW . __FUNCTION__, compact('featureds'));
    }
}
