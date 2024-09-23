<?php

namespace App\Http\Controllers\Admin;

use App\Helper\Toastr;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductSize;
use App\Models\ProductVariant;
use App\Models\SubCategory;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private const VIEW_PATH = 'admin.products.';
    public function index()
    {
        return view(self::VIEW_PATH . __FUNCTION__);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tags = Tag::query()->latest()->get();
        $categories = Category::query()->latest()->get();
        $subCategories = SubCategory::query()->latest()->get();
        $colors = ProductColor::query()->latest()->get();
        $sizes = ProductSize::query()->latest()->get();

        return view(self::VIEW_PATH . __FUNCTION__, compact(['categories', 'subCategories', 'tags', 'colors', 'sizes']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $images = [];
            // handle products, product_colors, product_galleries, product_sizes, product_tags, product_variants

            DB::transaction(function () use ($request, &$images) {
                $product = $request->product;

                $product['is_active'] = $request->boolean('product.is_active', false);
                $product['is_hot_deal'] = $request->boolean('product.is_hot_deal', false);
                $product['is_good_deal'] = $request->boolean('product.is_good_deal', false);
                $product['is_new'] = $request->boolean('product.is_new', false);
                $product['is_show_home'] = $request->boolean('product.is_show_home', false);
                $product['slug'] = Str::slug($product['name'], '-') . '-' .  time();
                $product['sku'] =  'SKU-' . Str::uuid();;


                if ($request->hasFile('product.thumb_image')) {
                    $product['thumb_image'] = Storage::put('products', $request->file('product.thumb_image'));
                }

                // dd($product);

                $newProduct = Product::create($product);

                // if ($request->has('product.images')) {
                //     $product['image'] = 'image new';
                // }

                // if ($request->product_colors && $request->product_sizes) {
                //     foreach ($request->product_colors as $color) {
                //         // ProductColor::create($color);
                //         // echo $color . "<br/>";
                //         $productColor = [
                //             'product_id' => $newProduct->id,
                //             'color' => $color['name']
                //         ];
                //         // ProductVariant::create();
                //     }

                //     foreach ($request->product_sizes as $size) {
                //         $productSize = [];
                //     }
                // }



                // if ($request->has('tags')) {
                //     Tag::query()->create($request->tags);
                //     // Tag::query()->create($request->tags);
                // }


                // ProductVariant::create([
                //     'product_id' => $newProduct->id,
                //     'color_id' => $productColor->id,
                //     'size_id' => $productSize->id,
                //     'sku' => 'VAR-' . Str::uuid(),  // SKU duy nhất cho mỗi variant
                //     'price' => $size['price'], // Giá có thể khác nhau cho mỗi variant
                //     'quantity' => $size['quantity'] // Số lượng tồn kho cho từng variant
                // ]);
            });

            Toastr::success(null, 'Thao tác thành công');
            return redirect()->route('admin.products.index');

            // dd($request->all());
        } catch (\Throwable $th) {
            Toastr::error(null, 'Đã xảy ra lỗi');
            Log::error($th->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view(self::VIEW_PATH . __FUNCTION__);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view(self::VIEW_PATH . __FUNCTION__);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function handleData(Request $request)
    {
        $dataProduct = $request->except(['product_variants', 'tags', 'product_galleries']);

        dd($dataProduct);
    }
}
