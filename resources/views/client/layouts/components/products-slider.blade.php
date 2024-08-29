@isset($products)

<div class="container">
    <h2 class="section-title">Related Products</h2>

    <div class="products-slider owl-carousel owl-theme dots-top dots-small">
        @foreach ($products as $product)
        <div class="product-default">
            <figure>
                <a href="product.html">
                    <img src="{{ $product['img_1'] }}" width="280" height="280" alt="product">
                    <img src="{{ $product['img_2'] }}" width="280" height="280" alt="product">
                </a>
                <div class="label-group">
                    <div class="product-label label-hot">{{ $product['type'] }}</div>
                    <div class="product-label label-sale">{{ $product['sale'] }}</div>
                </div>
            </figure>
            <div class="product-details">
                <div class="category-list">
                    <a href="{{ route('shop.category', 'thoi-trang-nam') }}" class="product-category">{{
                        $product['category'] }}</a>
                </div>
                <h3 class="product-title">
                    <a href="{{ route('shop.detail', 'ao-phong-nam-123') }}">{{ $product['name'] }}</a>
                </h3>
                <div class="ratings-container">
                    <div class="product-ratings">
                        <span class="ratings" style="width:80%"></span>
                        <!-- End .ratings -->
                        <span class="tooltiptext tooltip-top"></span>
                    </div>
                    <!-- End .product-ratings -->
                </div>
                <!-- End .product-container -->
                <div class="price-box">
                    <del class="old-price">$59.00</del>
                    <span class="product-price">$49.00</span>
                </div>
                <!-- End .price-box -->
                <div class="product-action">
                    <a href="{{ route('wishlist.index') }}" title="Wishlist" class="btn-icon-wish">
                        <i class="icon-heart"></i>
                    </a>
                    <a href="{{ route('shop.detail', 'ao-phong-nam-123') }}" class="btn-icon btn-add-cart">
                        <i class="fa fa-arrow-right"></i>
                        <span>SELECT OPTIONS</span>
                    </a>
                    <a href="ajax/product-quick-view.html" class="btn-quickview" title="Quick View">
                        <i class="fas fa-external-link-alt"></i>
                    </a>
                </div>
            </div>
            <!-- End .product-details -->
        </div>
        @endforeach

    </div>
</div>
@endisset
