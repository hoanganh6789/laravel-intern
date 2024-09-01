@extends('admin.layouts.master')
@section('title', 'New User')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Create User</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.users.index') }}">Users</a>
                    </li>
                    <li class="breadcrumb-item active">Create New</li>
                </ol>
            </div>
        </div>


        <form action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
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
                                                type="file" accept="image/png, image/gif, image/jpeg" name="avatar"
                                                onchange="previewImage(event)">
                                        </div>
                                        <div class="avatar-lg">
                                            <div class="avatar-title bg-light rounded-circle">
                                                <img src id="projectlogo-img" class="avatar-lg h-auto rounded-circle" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Name</label>
                                        <input name="name" type="text" class="form-control"
                                            placeholder="Enter user name..." required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Email</label>
                                        <input name="email" type="email" class="form-control"
                                            placeholder="Enter user email..." required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Password</label>
                                        <input name="password" type="password" class="form-control"
                                            placeholder="Enter user password..." required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Phone</label>
                                        <input name="phone" type="text" class="form-control"
                                            placeholder="Enter user phone..." required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end card body -->
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Address</label>
                                        <input name="address" type="text" class="form-control"
                                            placeholder="Enter user address..." required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">City</label>
                                        <select class="form-select" name="city">
                                            <option value="Member" selected>Member</option>
                                            <option value="Admin">Admin</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">District</label>
                                        <select class="form-select" name="district">
                                            <option value="Member" selected>Member</option>
                                            <option value="Admin">Admin</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Ward</label>
                                        <select class="form-select" name="ward">
                                            <option value="Member" selected>Member</option>
                                            <option value="Admin">Admin</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end col -->
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title mb-3">Publish</h5>

                            <div class="mb-3">
                                <label class="form-label">Role</label>
                                <select class="form-select" name="role">
                                    <option value="Member" selected>Member</option>
                                    <option value="Admin">Admin</option>
                                </select>
                            </div>

                            <div>
                                <div class="form-check form-switch mb-3">
                                    <label class="form-check-label">is_active</label>
                                    <input class="form-check-input" type="checkbox" checked="" name="is_active">
                                </div>
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
<script src="{{ asset('assets/js/admin/users/create.js') }}"></script>
{{-- <script src="{{ asset('assets/theme/admin/js/pages/form-file-upload.init.js') }}"></script> --}}
{{-- <script src="{{ asset('assets/theme/admin/js/pages/project-create.init.js') }}"></script> --}}
@endsection
