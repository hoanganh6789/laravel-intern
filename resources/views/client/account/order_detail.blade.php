@php
use App\Models\Order;
@endphp

@extends('client.layouts.master')
@section('title', 'Account Settings')
@section('content')
@section('style')
<link rel="stylesheet" href="{{ asset('assets/css/client/order_detail.css') }}">
@endsection

<div class="page-header">
    <div class="container d-flex flex-column align-items-center">
        <h1>
            Chi Tiết Đơn Hàng
        </h1>
    </div>
</div>

<div class="container">

    <nav class="breadcrumb">
        <a class="breadcrumb-item" href="{{ route('home') }}">Home</a>
        <a class="breadcrumb-item" href="{{ route('account.orders') }}">Orders</a>
        <span class="breadcrumb-item active" aria-current="page">
            Đơn Hàng: {{ time() }}
        </span>
    </nav>

    <div class="row">

        <div class="col-12">
            <section class="py-5">
                <ul class="timeline">

                    @foreach (Order::STATUS_ORDER as $status)
                    <li class="timeline-item mb-2">
                        <p class="fw-bold active">
                            {{ $status }}
                        </p>
                    </li>
                    @endforeach
                </ul>
            </section>
        </div>

        <div class="col-12">
            <div class="row">
                <div class="col-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3>Thông Tin Người Nhận:</h3>
                            </div>

                            <div class="mb-1 mt-3">
                                Name: {{ $order->user_name }}
                            </div>
                            <div class="mb-1">
                                Email: {{ $order->user_email }}
                            </div>
                            <div class="mb-1">
                                Phone: {{ $order->user_phone }}
                            </div>
                            <div class="mb-1">
                                Address: {{ $order->user_address }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3>Thông Tin Đơn Hàng:</h3>
                            </div>

                            <div class="mb-1 mt-3">
                                Status Order:
                                <span class="badge p-2 {{ statusOrderClass($order->status_order) }}"> {{ matchStatusOrder($order->status_order) }}</span>
                            </div>

                            <div class="mb-1">
                                Status Payment:
                                <span style="color: #fff" class="badge p-2 {{ $order->status_payment == 'unpaid' ? 'bg-danger' : 'bg-primary' }}">
                                    {{ matchStatusPayMent($order->status_payment) }}
                                </span>
                            </div>

                            <div class="mb-1">
                                Total: {{ formatPrice($order->total_price) }}đ
                            </div>

                            <div class="mb-1">
                                Time: {{ date_format($order->created_at, 'Y/m/y H:i') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Image</th>
                            <th scope="col">Name</th>
                            <th scope="col">Sku</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Size</th>
                            <th scope="col">Color</th>
                            <th scope="col">Price</th>
                            <th scope="col">SubTotal</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($orderItems as $item)

                        @php
                        $price = $item->product_price_sale ?: $item->product_price_regular;
                        $subTotal = $price * $item->quantity;
                        @endphp

                        <tr class="">
                            <td scope="row">
                                @if(!empty($item->product_img_thumbnail) && Storage::exists($item->product_img_thumbnail))
                                <img src="{{ Storage::url($item->product_img_thumbnail) }}" alt="{{ $item->product_name }}" width="60px" height="60px">
                                @endif
                            </td>
                            <td>
                                {{ limitTextLeng($item->product_name, 10) }}
                            </td>
                            <td>{{ $item->product_sku }}</td>
                            <td>x{{ $item->quantity }}</td>
                            <td>{{ $item->variant_size_name }}</td>
                            <td>{{ $item->variant_color_name }}</td>
                            <td>
                                {{ formatPrice($price) }}đ
                            </td>
                            <td>
                                {{ formatPrice($subTotal) }}đ
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>

        @if($order->status_order == Order::STATUS_ORDER_PENDING)
        <div class="col-12">
            <button class="btn btn-danger">Hủy đơn hàng</button>
        </div>
        @endif
    </div>
</div>




@endsection
