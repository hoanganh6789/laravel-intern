@extends('admin.layouts.master')
@section('title')
{{ $subCategory->name }}
@endsection
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Update SubCategory</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.sub-categories.index') }}">SubCategories</a>
                    </li>
                    <li class="breadcrumb-item active">Update SubCategory</li>
                </ol>
            </div>
        </div>


        <form id="sub-category-form-edit-{{ $subCategory->id }}"
            action="{{ route('admin.sub-categories.update', $subCategory) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">

                            <div class="mb-3">
                                <label class="form-label">Category</label>
                                <select class="form-select" name="category_id">
                                    <option value="{{ $subCategory->category->id }}" selected>
                                        {{ $subCategory->category->name }}
                                    </option>
                                    @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">
                                        {{ $category->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="projectname-input" class="form-label">Name</label>
                                <input id="projectname-input" name="name" type="text" class="form-control"
                                    placeholder="Enter category name..." value="{{ $subCategory->name }}" required>
                                @error('name')
                                <div class="text-danger fst-italic">
                                    * {{ $message }}
                                </div>
                                @enderror
                            </div>


                            <div class="mb-3">
                                <label for="projectname-input" class="form-label">Name</label>
                                <input id="projectname-input" name="slug" type="text" class="form-control"
                                    placeholder="Enter category slug..." value="{{ $subCategory->slug }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="projectname-input" class="form-label">Description</label>
                                <textarea name="description" type="text" class="form-control"
                                    placeholder="Enter category description..." required>
                                    {{ $subCategory->description }}
                                </textarea>
                            </div>
                        </div>
                        <!-- end card body -->
                    </div>
                </div>
                <!-- end col -->
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title mb-3">Publish</h5>

                            <div class="mb-3">
                                <div class="form-check form-switch mb-3">
                                    <label class="form-check-label">status</label>
                                    <input class="form-check-input" type="checkbox" {{ $subCategory->status ?
                                    'checked' :
                                    ''
                                    }} name="status">
                                </div>
                            </div>

                            <div>
                                <div class="form-check form-switch mb-3">
                                    <label class="form-check-label">is_active</label>
                                    <input class="form-check-input" type="checkbox" {{ $subCategory->is_active ?
                                    'checked' :
                                    ''
                                    }} name="is_active">
                                </div>
                            </div>
                        </div>
                        <!-- end card body -->
                    </div>
                </div>
                <!-- end col -->

                <div class="col-lg-8">
                    <div class="text-end mb-4">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </div>
            </div>
        </form>

    </div>
</div>
@endsection

@section('script')
<script src="{{ asset('assets/theme/admin/libs/dropzone/dropzone-min.js') }}"></script>
<script src="{{ asset('assets/js/admin/categories/update.js') }}"></script>
{{-- <script src="{{ asset('assets/theme/admin/js/pages/form-file-upload.init.js') }}"></script> --}}
{{-- <script src="{{ asset('assets/theme/admin/js/pages/project-create.init.js') }}"></script> --}}
@endsection
