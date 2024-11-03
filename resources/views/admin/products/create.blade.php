@extends('admin.layouts.master')
@section('title', 'New Product')

@section('style')
<link rel="stylesheet" href="{{ asset('assets/css/admin/product-create.css') }}">
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Thêm Sảm Phẩm</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.products.index') }}">Sản Phẩm</a>
                    </li>
                    <li class="breadcrumb-item active">Thêm Sản Phẩm</li>
                </ol>
            </div>
        </div>


        <form id="form-create-product" action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">Ảnh Bìa</label>

                                <div class="text-center">
                                    <div class="position-relative d-inline-block">
                                        <div class="position-absolute bottom-0 end-0">
                                            <label for="project-image-input" class="mb-0" data-bs-toggle="tooltip" data-bs-placement="right" title="Select Image">
                                                <div class="avatar-xs">
                                                    <div class="avatar-title bg-light border rounded-circle text-muted cursor-pointer shadow font-size-16">
                                                        <i class='bx bxs-image-alt'></i>
                                                    </div>
                                                </div>
                                            </label>
                                            <input class="form-control d-none" value="" id="project-image-input" type="file" accept="image/png, image/gif, image/jpeg" name="product[thumb_image]" onchange="previewImage(event)">
                                        </div>
                                        <div class="avatar-lg">
                                            <div class="avatar-title bg-light">
                                                <img src id="projectlogo-img" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Tên</label>
                                <input name="product[name]" type="text" class="form-control @error('product.name')
                                        is-invalid
                                    @enderror" placeholder="Enter product name..." value="{{ old('product.name') }}">
                                @error('product.name')
                                <div class="text-danger fst-italic">*{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="projectname-input" class="form-label">
                                            Price Regular
                                        </label>
                                        <input name="product[price_regular]" type="number" class="form-control @error('product.price_regular')
                                                is-invalid
                                            @enderror" placeholder="Enter product price_regular..." value="{{ old('product.price_regular') }}">
                                        @error('product.price_regular')
                                        <div class="text-danger fst-italic">*{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="projectname-input" class="form-label">
                                            Price Sale
                                        </label>
                                        <input name="product[price_sale]" type="number" class="form-control @error('product.price_sale')
                                            is-invalid
                                            @enderror" placeholder="Enter product number..." value="{{ old('product.price_sale') }}">
                                        @error('product.price_sale')
                                        <div class="text-danger fst-italic">*{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Mô Tả</label>
                                <input type="text" class="form-control @error('product.description')
                                        is-invalid
                                    @enderror" name="product[description]" value="{{ old('product.description') }}" />
                                @error('product.description')
                                <div class="text-danger fst-italic">*{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Content</label>
                                <input type="text" class="form-control @error('product.content')
                                        is-invalid
                                    @enderror" name="product[content]" value="{{ old('product.content') }}" />
                                @error('product.content')
                                <div class="text-danger fst-italic">*{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <!-- end card body -->
                    </div>

                    <div class="card">

                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Gallery</h4>
                            <button type="button" class="btn btn-primary" onclick="addImageGallery()">Thêm ảnh</button>
                        </div>

                        <div class="card-body">

                            <div class="live-preview">
                                <div class="row gy-4" id="gallery_list">
                                    <div class="col-md-4" id="gallery_default_item">
                                        <label for="gallery_default" class="form-label">Image</label>
                                        <div class="d-flex">
                                            <input type="file" class="form-control" name="product_galleries[]" id="gallery_default">
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">

                            <div class="card-title mb-4">
                                <h4>Biến Thể</h4>
                            </div>

                            <div class="mb-3">

                                <div class="row">
                                    <div class="col-lg-6">
                                        <span class="form-label">Color</span>
                                        <select id="select-color-product-multiple" class="select2 form-control select2-multiple" multiple="multiple" data-placeholder="Select color ..." name="colors[]">
                                        </select>
                                        @error('colors')
                                        <div class="text-danger fst-italic">*{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-lg-6">
                                        <span class="form-label">Size</span>
                                        <select id="select-size-product-multiple" class="select2 form-control select2-multiple" multiple="multiple" data-placeholder="Select size ..." name="sizes[]">
                                        </select>
                                        @error('sizes')
                                        <div class="text-danger fst-italic">*{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>


                    <div class="card" id="table-product-variant-preview">

                        <div class="card-body">
                            <div class="card-title">Table Review</div>

                            <div class="d-flex justify-content-between mb-2">
                                <div>
                                    <input type="number" placeholder="Kho hàng" class="form-control" id="product-quantity-variant-all">
                                </div>

                                <div class="">
                                    <button id="apply-quantity-variant-all" type="button" class="btn btn-outline-danger">Áp Dụng Cho All</button>
                                </div>
                            </div>

                            <table class="table table-bordered mb-0">
                                <thead>
                                    <tr class="text-center">
                                        <th>Màu</th>
                                        <th>Size</th>
                                        <th>Kho Hàng</th>
                                        <th>Image</th>
                                    </tr>
                                </thead>

                                <tbody id="render-tbody-product"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- end col -->
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title mb-3">Publish</h5>

                            <div class="mb-3">
                                <label class="form-label">SKU</label>
                                <input type="text" name="product[sku]" class="form-control @error('product.sku')
                                        is-invalid
                                    @enderror" value="{{ old('product.sku') }}">
                                @error('product.sku')
                                <div class="text-danger fst-italic">*{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Select Tags</label>

                                <select id="select-tag-product-multiple" class="select2 form-control select2-multiple" multiple="multiple" data-placeholder="Choose ..." name="tags[]">
                                    @foreach ($tags as $tag)
                                    <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                    @endforeach
                                </select>

                                @error('tags')
                                <div class="text-danger fst-italic">*{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">
                                    Category
                                </label>

                                <select class="form-control select2-multiple" name="product[category_id]">
                                    @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">
                                        {{ $category->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">
                                    Sub Category
                                </label>

                                <select class="form-control select2-multiple" name="product[sub_category_id]">
                                    @foreach ($subCategories as $subCategory)
                                    <option value="{{ $subCategory->id }}">
                                        {{ $subCategory->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                            @php
                            $is = ['is_active', 'is_hot_deal', 'is_good_deal', 'is_new', 'is_show_home'];
                            @endphp

                            @foreach ($is as $item)
                            <div class="mb-3">
                                <div class="form-check form-switch mb-3">
                                    <label class="form-check-label">{{ $item }}</label>
                                    <input class="form-check-input" value="1" type="checkbox" {{ $item === 'is_active' ? 'checked' : '' }} name="product[{{ $item }}]">
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <!-- end card body -->
                    </div>
                </div>
                <!-- end col -->

                <div class="col-lg-8">
                    <div class="text-end mb-4">
                        <button type="button" id="submit-create-form-product" class="btn btn-primary">Create</button>
                    </div>
                </div>
            </div>
    </div>
    </form>

</div>
</div>
@endsection

@section('script')
{{-- <script src="{{ asset('assets/theme/admin/libs/dropzone/dropzone-min.js') }}"></script> --}}
<script src="{{ asset('assets/js/admin/products/create.js') }}"></script>

{{-- <script src="{{ asset('assets/theme/admin/js/pages/form-file-upload.init.js') }}"></script> --}}


{{-- <script src="{{ asset('assets/theme/admin/js/pages/form-file-upload.init.js') }}"></script> --}}
{{-- <script src="{{ asset('assets/theme/admin/js/pages/project-create.init.js') }}"></script> --}}
@endsection
