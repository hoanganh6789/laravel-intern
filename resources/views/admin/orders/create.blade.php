@extends('admin.layouts.master')
@section('title', 'New Category')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Create Category</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.categories.index') }}">Categories</a>
                    </li>
                    <li class="breadcrumb-item active">Create New</li>
                </ol>
            </div>
        </div>


        <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="projectname-input" class="form-label">Name</label>
                                <input id="projectname-input" name="name" type="text" class="form-control"
                                    placeholder="Enter category name..." required>
                                <div class="invalid-feedback">Please enter a project name.</div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Image</label>

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
                                                type="file" accept="image/png, image/gif, image/jpeg" name="image">
                                        </div>
                                        <div class="avatar-lg">
                                            <div class="avatar-title bg-light rounded-circle">
                                                <img src="projects-create.html" id="projectlogo-img"
                                                    class="avatar-md h-auto rounded-circle" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
                                <label class="form-label" for="project-status-input">Status</label>
                                <select class="form-select" id="project-status-input">
                                    <option value="Completed">Completed</option>
                                    <option value="Inprogress" selected>Inprogress</option>
                                    <option value="Delay">Delay</option>
                                </select>
                                <div class="invalid-feedback">Please select project status.</div>
                            </div>

                            <div>
                                <label class="form-label" for="project-visibility-input">Visibility</label>
                                <select class="form-select" id="project-visibility-input">
                                    <option value="Private">Private</option>
                                    <option value="Public">Public</option>
                                    <option value="Team">Team</option>
                                </select>
                            </div>
                        </div>
                        <!-- end card body -->
                    </div>
                </div>
                <!-- end col -->

                <div class="col-lg-8">
                    <div class="text-end mb-4">
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                </div>
            </div>
        </form>

    </div>
</div>
@endsection

@section('script')
<script src="{{ asset('assets/theme/admin/libs/dropzone/dropzone-min.js') }}"></script>
{{-- <script src="{{ asset('assets/theme/admin/js/pages/form-file-upload.init.js') }}"></script> --}}
{{-- <script src="{{ asset('assets/theme/admin/js/pages/project-create.init.js') }}"></script> --}}
@endsection
