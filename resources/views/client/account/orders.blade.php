@extends('client.layouts.account-layout')
@section('view-tab')
<div class="order-content">
    <h3 class="account-sub-title d-none d-md-block">
        <i class="sicon-social-dropbox align-middle mr-3"></i>
        Orders
    </h3>
    <div class="order-table-container text-center">
        <table class="table table-order text-left">
            <thead>
                <tr>
                    <th class="order-id">#</th>
                    <th class="order-status">Quantity</th>
                    <th class="order-status">Status</th>
                    <th class="order-payment">Payment</th>
                    <th class="order-total">Total</th>
                    <th class="order-date">DATE</th>
                </tr>
            </thead>
            <tbody>
                @if(!empty($orders))

                @foreach ($orders as $key => $order)
                <tr>
                    <td>
                        {{ $key + 1 }}
                    </td>
                    <td>
                        {{ $order->orderItems->count() }}
                    </td>
                    <td>
                        <span class="badge p-2 {{ statusOrderClass($order->status_order) }}">
                            {{ matchStatusOrder($order->status_order) }}
                        </span>
                    </td>
                    <td>
                        <span style="color: #fff" class="p-2 badge {{ $order->status_payment == 'unpaid' ? 'bg-danger' : 'bg-primary' }}">
                            {{ matchStatusPayMent($order->status_payment) }}
                        </span>
                    </td>
                    <td>
                        {{ formatPrice($order->total_price) }}đ
                    </td>
                    <td>
                        {{ \Carbon\Carbon::parse($order->created_at)->format('Y/m/d') }}
                    </td>
                    <td>
                        <a href="{{ route('account.order_detail', $order) }}" class="text-warning">
                            <i class="ri-eye-line"></i>
                        </a>
                    </td>
                </tr>
                @endforeach


                @else
                <tr>
                    <td class="text-center p-0" colspan="7">
                        <p class="mb-5 mt-5">
                            No Order has been made yet.
                        </p>
                    </td>
                </tr>
                @endif
            </tbody>
        </table>
        <hr class="mt-0 mb-3 pb-2" />

        {{-- <a href="category.html" class="btn btn-dark">Go Shop</a> --}}
    </div>
</div>
@endsection
