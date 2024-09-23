@extends('admin.layouts.master')
@section('title', 'New Product')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Create Product</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.products.index') }}">Products</a>
                    </li>
                    <li class="breadcrumb-item active">Create New</li>
                </ol>
            </div>
        </div>


        <form id="form-create-product" action="{{ route('admin.products.store') }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">Thumb Image</label>

                                <div class="text-center">
                                    <div class="position-relative d-inline-block">
                                        <div class="position-absolute bottom-0 end-0">
                                            <label for="project-image-input" class="mb-0" data-bs-toggle="tooltip"
                                                data-bs-placement="right" title="Select Image">
                                                <div class="avatar-xs">
                                                    <div
                                                        class="avatar-title bg-light border rounded-circle text-muted cursor-pointer shadow font-size-16">
                                                        <i class='bx bxs-image-alt'></i>
                                                    </div>
                                                </div>
                                            </label>
                                            <input class="form-control d-none" value="" id="project-image-input"
                                                type="file" accept="image/png, image/gif, image/jpeg"
                                                name="product[thumb_image]" onchange="previewImage(event)">
                                        </div>
                                        <div class="avatar-lg">
                                            <div class="avatar-title bg-light rounded-circle">
                                                <img src id="projectlogo-img" class="avatar-lg h-auto rounded-circle" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <input name="product[name]" type="text" class="form-control"
                                    placeholder="Enter product name...">
                                <div class="invalid-feedback">Please enter a project name.</div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="projectname-input" class="form-label">
                                            Price Regular
                                        </label>
                                        <input name="product[price_regular]" type="number" class="form-control"
                                            placeholder="Enter product price_regular...">
                                        <div class="invalid-feedback">Please enter a project name.</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="projectname-input" class="form-label">
                                            Price Sale
                                        </label>
                                        <input name="product[price_sale]" type="number" class="form-control"
                                            placeholder="Enter product number...">
                                        <div class="invalid-feedback">Please enter a project name.</div>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Description</label>
                                <input type="text" class="form-control" name="product[description]" />
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Content</label>
                                <input type="text" class="form-control" name="product[content]" />
                            </div>
                        </div>
                        <!-- end card body -->
                    </div>

                    <div class="card">
                        <div class="card-body">

                            <div class="card-title mb-4">
                                <h4>Biến Thể</h4>
                            </div>

                            <div class="mb-3">
                                <button class="btn btn-info" id="product-btn-add-color" type="button">
                                    Thêm Màu
                                </button>

                                <button class="btn btn-outline-danger" id="product-btn-add-size" type="button">
                                    Thêm Size
                                </button>
                            </div>

                            <div class="mb-3">

                                <div class="card">
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <div class="card-title" id="color-name-product">
                                                <h4>Màu</h4>
                                            </div>

                                            <div class="row" id="render-product-color"></div>
                                        </div>

                                        <div class="mb-3">
                                            <div class="card-title mt-1" id="size-name-product">
                                                <h4>Size</h4>
                                            </div>

                                            <div class="row" id="render-product-size">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div class="card-title">
                                    <h4>Table Review</h4>
                                </div>

                                <div class="">
                                    <button type="button" class="btn btn-outline-danger">Áp Dụng Cho All</button>
                                </div>
                            </div>

                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Màu</th>
                                        <th>Size</th>
                                        <th>Giá</th>
                                        <th>Kho Hàng</th>
                                        <th>Image</th>
                                    </tr>
                                </thead>

                                <tbody id="render-tbody-product">

                                </tbody>

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
                                <label class="form-label">Select Tags</label>

                                <select id="select-tag-product-multiple" class="select2 form-control select2-multiple"
                                    multiple="multiple" data-placeholder="Choose ..." name="tags[]">

                                    {{-- @foreach ($tags as $tag)
                                    <option value="ao-phong-nam">Áo Phông Nam</option>
                                    @endforeach --}}

                                    <option value="ao-polo-nam">Áo Polo Nam</option>
                                    <option value="ao-so-mi-nam">Áo Sơ Mi Nam</option>
                                    <option value="vay-nu">Váy Nữ</option>
                                    <option value="dam-nu">Đầm Nữ</option>
                                    <option value="bikini-nu">Bikini Nữ</option>
                                </select>
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

                            <div class="mb-3">
                                <div class="form-check form-switch mb-3">
                                    <label class="form-check-label">is_active</label>
                                    <input class="form-check-input" type="checkbox" checked=""
                                        name="product[is_active]">
                                </div>
                            </div>

                            <div class="mb-3">
                                <div class="form-check form-switch mb-3">
                                    <label class="form-check-label">is_hot_deal</label>
                                    <input class="form-check-input" type="checkbox" checked=""
                                        name="product[is_hot_deal]">
                                </div>
                            </div>

                            <div class="mb-3">
                                <div class="form-check form-switch mb-3">
                                    <label class="form-check-label">is_good_deal</label>
                                    <input class="form-check-input" type="checkbox" checked=""
                                        name="product[is_good_deal]">
                                </div>
                            </div>

                            <div class="mb-3">
                                <div class="form-check form-switch mb-3">
                                    <label class="form-check-label">is_new</label>
                                    <input class="form-check-input" type="checkbox" checked="" name="product[is_new]">
                                </div>
                            </div>

                            <div class="mb-3">
                                <div class="form-check form-switch mb-3">
                                    <label class="form-check-label">is_show_home</label>
                                    <input class="form-check-input" type="checkbox" checked=""
                                        name="product[is_show_home]">
                                </div>
                            </div>


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
<script src="{{ asset('assets/theme/admin/libs/dropzone/dropzone-min.js') }}"></script>
<script src="{{ asset('assets/js/admin/products/create.js') }}"></script>
{{-- <script src="{{ asset('assets/theme/admin/js/pages/form-file-upload.init.js') }}"></script> --}}
{{-- <script src="{{ asset('assets/theme/admin/js/pages/project-create.init.js') }}"></script> --}}
@endsection
