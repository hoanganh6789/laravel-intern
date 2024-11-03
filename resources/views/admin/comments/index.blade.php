@extends('admin.layouts.master')
@section('title', 'Comemnts')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Comments</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">Comments</li>
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
                    </div>

                    <div class="table-responsive min-vh-100">
                        <table class="table align-middle table-nowrap dt-responsive nowrap w-100">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Avatar</th>
                                    <th>Name</th>
                                    <th>Product</th>
                                    <th>Content</th>
                                    <th>Rating</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>

                                @foreach ($comments as $comment)
                                    <tr>
                                        <td class="dtr-control sorting_1" tabindex="0">
                                            <div class="d-none">{{ $comment->id }}</div>
                                            <div class="form-check font-size-16"> <input class="form-check-input"
                                                    type="checkbox" id="customerlistcheck-11"> <label
                                                    class="form-check-label" for="customerlistcheck-11"></label> </div>
                                        </td>

                                        <td>
                                            @if (!empty($comment->user->avatar) && Storage::exists($comment->user->avatar))
                                                <img src="{{ Storage::url($comment->user->avatar) }}"
                                                    alt="{{ $comment->user->name }}" width="30px" height="30px">
                                            @else
                                                <img src="https://laravel.com/img/logomark.min.svg" alt=""
                                                    style="height: 30px; width: 30px">
                                            @endif
                                        </td>

                                        <td>
                                            {{ $comment->user->name }}
                                        </td>

                                        <td>
                                            {{ limitTextLeng($comment->product->name, 20) }}
                                        </td>

                                        <td>
                                            {{ limitTextLeng($comment->content, 20, '***') }}
                                        </td>

                                        <td>
                                            <span class="badge bg-primary p-2">
                                                {{ $comment->rating }}
                                            </span>

                                        </td>

                                        <td>
                                            <div class="dropdown">
                                                <a href="#" class="dropdown-toggle card-drop"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="mdi mdi-dots-horizontal font-size-18"></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-end" style="">
                                                    <li>
                                                        <form action="{{ route('admin.comments.destroy', $comment) }}"
                                                            method="POST" id="delete-comment-{{ $comment->id }}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button" class="dropdown-item remove-list"
                                                                onclick="handleDelete({{ $comment->id }})">
                                                                <i
                                                                    class="mdi mdi-trash-can font-size-16 text-danger me-1"></i>
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


                        <div class="row">
                            {{ $comments->links('admin.layouts.components.pagination') }}
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

@section('script')
    <script src="{{ asset('assets/js/admin/comments/index.js') }}"></script>
@endsection
