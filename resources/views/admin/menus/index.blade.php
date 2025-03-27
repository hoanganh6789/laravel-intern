@extends('admin.layouts.master')
@section('title', 'Menus')
@section('content')

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Menu</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item active">Menus</li>
                </ol>
            </div>

        </div>
    </div>
</div>

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
                            <a href="{{ route('admin.menus.create') }}" class="btn btn-success btn-rounded waves-effect waves-light mb-2 me-2 addCustomers-modal">
                                <i class="mdi mdi-plus me-1"></i>
                                New Menu
                            </a>
                        </div>
                    </div><!-- end col-->
                </div>

                <div class="table-responsive min-vh-100">
                    <table class="table align-middle table-nowrap dt-responsive nowrap w-100">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Position</th>
                                <th>Parent_Id</th>
                                <th>Is_active</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach ($menus as $menu)
                            <tr>
                                <td class="dtr-control sorting_1" tabindex="0">
                                    <div class="d-none">{{ $menu->id }}
                                    </div>
                                    <div class="form-check font-size-16"> <input class="form-check-input" type="checkbox" id="customerlistcheck-{{ $menu->id }}"> <label class="form-check-label" for="customerlistcheck-{{ $menu->id }}"></label> </div>
                                </td>

                                <td>
                                    {{ $menu->name }}
                                </td>

                                <td>
                                    {{ $menu->slug }}
                                </td>

                                <td>
                                    <span class="badge bg-success font-size-12 p-2">
                                        {{ $menu->position }}
                                    </span>
                                </td>

                                <td>
                                    <span class="badge {{ $menu->parent_id ? 'bg-warning' : 'bg-danger' }} font-size-12 p-2">
                                        {{ $menu->parent_id ?? 'No Data' }}
                                    </span>
                                </td>

                                <td>
                                    <span class="badge {{ $menu->is_active ? 'bg-primary' : 'bg-danger' }} font-size-12 p-2">
                                        {{ $menu->is_active ? "Active" : 'No Active' }}
                                    </span>
                                </td>

                                <td>
                                    <div class="dropdown">
                                        <a href="#" class="dropdown-toggle card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="mdi mdi-dots-horizontal font-size-18"></i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-end" style="">
                                            <li>
                                                <a href="{{ route('admin.menus.edit', $menu) }}" class="dropdown-item edit-list">
                                                    <i class="mdi mdi-pencil font-size-16 text-success me-1"></i>
                                                    Edit
                                                </a>
                                            </li>
                                            <li>
                                                <form action="{{ route('admin.menus.destroy', $menu) }}" method="POST" id="menu-form-delete-{{ $menu->id }}">
                                                    @csrf
                                                    @method("DELETE")


                                                    <button type='button' class="dropdown-item remove-list" onclick="handleDelete({{ $menu->id }})">
                                                        <i class="mdi mdi-trash-can font-size-{{ $menu->id }} text-danger me-1"></i>
                                                        Delete
                                                    </button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            @endforeach


                        </tbody>
                    </table>


                    {{-- <div class="row">
                        {{ $categories->links('admin.layouts.components.pagination') }}
                </div> --}}


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
