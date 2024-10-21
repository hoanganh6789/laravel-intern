@extends('client.layouts.master')
@section('title', 'Cart')

@section('content')

<div class="container">

    @if($cart && $cart->cartItems->isNotEmpty())
    <ul class="checkout-progress-bar d-flex justify-content-center flex-wrap">
        <li class="active">
            <a href="{{ route('cart.index') }}">Shopping Cart</a>
        </li>
        <li style="pointer-events: none">
            <a href="{{ route('check-out') }}">Checkout</a>
        </li>
        <li class="disabled">
            <a href="cart.html">Order Complete</a>
        </li>
    </ul>

    <div class="row">
        <div class="col-lg-12">
            <div class="cart-table-container">
                <table class="table table-cart">
                    <thead>
                        <tr>
                            <th class="thumbnail-col"></th>
                            <th class="name-col">Name</th>
                            <th class="color-col">Color</th>
                            <th class="size-col">Size</th>
                            <th class="price-col">Price</th>
                            <th class="qty-col">Quantity</th>
                            <th class="text-right">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($cart->cartItems as $item)

                        @php
                        $price = $item->productVariant->product->price_sale ?: $item->productVariant->product->price_regular;
                        $slug = $item->productVariant->product->slug;
                        $image = $item->productVariant->product->thumb_image;
                        $name = $item->productVariant->product->name;
                        $color = $item->productVariant->color->name;
                        $size = $item->productVariant->size->name;
                        @endphp

                        <tr class="product-row">
                            <td>
                                <figure class="product-image-container">
                                    <a href="{{ route('shop.detail', $slug) }}" class="product-image">
                                        @if(!empty($image) && Storage::exists($image))
                                        <img src="{{ Storage::url($image) }}" alt="Product">
                                        @endif
                                    </a>

                                    <a href="cart.html#" class="btn-remove icon-cancel" title="Remove Product"></a>
                                </figure>
                            </td>
                            <td class="product-col">
                                <h5 class="product-title">
                                    <a href="{{ route('shop.detail', $slug) }}" target="_blank">
                                        {{ limitTextLeng($name, 20) }}
                                    </a>
                                </h5>
                            </td>
                            <td>
                                {{ $color }}
                            </td>
                            <td>
                                {{ $size }}
                            </td>
                            <td>
                                {{ formatPrice($price) }}đ
                            </td>
                            <td>
                                <div class="product-single-qty">
                                    <input class="horizontal-quantity form-control" type="text" value="{{ $item->quantity }}">
                                </div>
                            </td>
                            <td class="text-right">
                                <span class="subtotal-price">
                                    {{ calculateProductSubTotal($price, $item->quantity) }}đ
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>


                    <tfoot>
                        <tr>
                            <td colspan="5" class="clearfix">
                                <div class="float-left">
                                    <div class="cart-discount">
                                        <form action="cart.html#">
                                            <div class="input-group">
                                                {{-- <input type="text" class="form-control form-control-sm"
                                                    placeholder="Coupon Code" required> --}}

                                                <select class="form-select form-select-sm" placeholder="Coupon Code" required>

                                                    <option value="">Mã giảm giá 20.000đ</option>
                                                    <option value="">Mã giảm giá 5% tổng đơn trên 1 triệu</option>
                                                    <option value="">Mã giảm giá 20.000đ</option>
                                                    <option value="">Mã giảm giá 20.000đ</option>
                                                </select>

                                                <div class="input-group-append">
                                                    <button class="btn btn-sm" type="button">
                                                        Apply Coupon
                                                    </button>
                                                </div>
                                            </div><!-- End .input-group -->
                                        </form>
                                    </div>
                                </div><!-- End .float-left -->
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div><!-- End .cart-table-container -->
        </div><!-- End .col-lg-8 -->

        <div class="col-lg-12">
            <div class="cart-summary">
                <h3>TOTALS</h3>

                <table class="table table-totals">
                    <tbody>
                        <tr>
                            <td>Subtotal</td>
                            <td>$17.90</td>
                        </tr>

                    </tbody>

                    <tfoot>
                        <tr>
                            <td>Total</td>
                            <td>
                                {{ formatPrice($total) }}đ
                            </td>
                        </tr>
                    </tfoot>
                </table>

                <div class="checkout-methods">
                    <a href="{{ route('check-out') }}" class="btn btn-block btn-dark">
                        Proceed to Checkout
                        <i class="fa fa-arrow-right"></i>
                    </a>
                </div>
            </div><!-- End .cart-summary -->
        </div><!-- End .col-lg-4 -->
    </div>

    @else

    <div style="height: 100vh" class="d-flex justify-content-center align-items-center">
        <h2 class="fst-italic text-danger">
            Bạn chưa có sản phẩm nào. <a href="{{ route('shop.index') }}">Mua Hàng</a>
        </h2>
    </div>

    @endif
</div><!-- End .container -->

<div class="mb-6"></div><!-- margin -->

@endsection
