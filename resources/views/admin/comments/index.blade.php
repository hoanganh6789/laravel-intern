@extends('admin.layouts.master')
@section('title', 'Categories')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Categories</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    {{-- <li class="breadcrumb-item"><a href="javascript: void(0);">Categories</a></li> --}}
                    <li class="breadcrumb-item active">Categories</li>
                </ol>
            </div>

        </div>
    </div>
</div>
<!-- end page title -->

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row mb-2">
                    <div class="col-sm-4">
                        <div class="search-box me-2 mb-2 d-inline-block">
                            <div class="position-relative">
                                <input type="text" class="form-control" id="searchTableList" placeholder="Search...">
                                <i class="bx bx-search-alt search-icon"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="text-sm-end">
                            <a href="{{ route('admin.categories.create') }}"
                                class="btn btn-success btn-rounded waves-effect waves-light mb-2 me-2 addCustomers-modal">
                                <i class="mdi mdi-plus me-1"></i>
                                New Category
                            </a>
                        </div>
                    </div><!-- end col-->
                </div>

                <div class="table-responsive min-vh-100">
                    <table class="table align-middle table-nowrap dt-responsive nowrap w-100">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Childen</th>
                                <th>Is_active</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td class="dtr-control sorting_1" tabindex="0">
                                    <div class="d-none">11</div>
                                    <div class="form-check font-size-16"> <input class="form-check-input"
                                            type="checkbox" id="customerlistcheck-11"> <label class="form-check-label"
                                            for="customerlistcheck-11"></label> </div>
                                </td>

                                <td>
                                    <img src="https://laravel.com/img/logomark.min.svg" alt=""
                                        style="height: 30px; width: 30px">
                                </td>

                                <td>
                                    Thời Trang Nam
                                </td>

                                <td>

                                </td>

                                <td>
                                    <span class="badge bg-success font-size-12 p-2">
                                        public
                                    </span>
                                </td>

                                <td>
                                    <div class="dropdown">
                                        <a href="#" class="dropdown-toggle card-drop" data-bs-toggle="dropdown"
                                            aria-expanded="false">
                                            <i class="mdi mdi-dots-horizontal font-size-18"></i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-end" style="">
                                            <li>
                                                <a href="{{ route('admin.categories.edit', 1) }}"
                                                    class="dropdown-item edit-list">
                                                    <i class="mdi mdi-pencil font-size-16 text-success me-1"></i>
                                                    Edit
                                                </a>
                                            </li>
                                            <li>
                                                <form action="">
                                                    <a href="#" class="dropdown-item remove-list">
                                                        <i class="mdi mdi-trash-can font-size-16 text-danger me-1"></i>
                                                        Delete
                                                    </a>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>


                    <div class="row">
                        <div class="col-sm-12 col-md-5">
                            <div class="dataTables_info" id="customerList-table_info" role="status" aria-live="polite">
                                Showing 1 to 10 of 12 entries</div>
                        </div>


                        <div class="col-sm-12 col-md-7">
                            <div class="dataTables_paginate paging_simple_numbers pagination-rounded"
                                id="customerList-table_paginate">
                                <ul class="pagination">
                                    <li class="paginate_button page-item previous disabled"
                                        id="customerList-table_previous"><a aria-controls="customerList-table"
                                            aria-disabled="true" role="link" data-dt-idx="previous" tabindex="-1"
                                            class="page-link"><i class="mdi mdi-chevron-left"></i></a></li>
                                    <li class="paginate_button page-item active"><a href="#"
                                            aria-controls="customerList-table" role="link" aria-current="page"
                                            data-dt-idx="0" tabindex="0" class="page-link">1</a></li>
                                    <li class="paginate_button page-item "><a href="#"
                                            aria-controls="customerList-table" role="link" data-dt-idx="1" tabindex="0"
                                            class="page-link">2</a></li>
                                    <li class="paginate_button page-item next" id="customerList-table_next"><a href="#"
                                            aria-controls="customerList-table" role="link" data-dt-idx="next"
                                            tabindex="0" class="page-link"><i class="mdi mdi-chevron-right"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>


                    </div>


                </div>
                <!-- end table responsive -->
            </div>
            <!-- end card body -->
        </div>
        <!-- end card -->
    </div>
    <!-- end col -->
</div>
@endsection
