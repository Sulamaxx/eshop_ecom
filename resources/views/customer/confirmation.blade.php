@extends('layout.app')

@section('content')
    <!-- Start Banner Area -->
    <section class="banner-area organic-breadcrumb">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
                <div class="col-first">
                    <h1>Confirmation</h1>
                    <nav class="d-flex align-items-center">
                        <a href="index.html">Home<span class="lnr lnr-arrow-right"></span></a>
                        <a href="category.html">Confirmation</a>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- End Banner Area -->

    <!--================Order Details Area =================-->
    <section class="order_details section_gap">
        <div class="container">
            <h3 class="title_confirmation">Thank you. Your order has been received.</h3>
            <div class="row order_d_inner">
                <div class="col-lg-6">
                    <div class="details_item">
                        <h4>Order Info</h4>
                        <ul class="list">
                            <li><span>Order number</span> : {{ $order[0]->id }}</li>
                            <li><span>Date</span> : {{ $order[0]->created_at }}</li>
                            <li><span>Total</span> : $ {{ number_format($order[0]->total_amount, 2) }}
                            </li>
                            <li><span>Payment method</span> : {{ $order[0]->payment_method }}</li>
                            <li><span>Payment Status</span> : <span
                                    class="bg-warning p-1 text-dark">{{ $order[0]->payment_status }}</span></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="details_item">
                        <h4>Billing Address</h4>
                        <ul class="list">
                            <li><span>Address Line 1</span> : {{ $order[0]?->billing_address?->address_line1 }}</li>
                            <li><span>Address Line 2</span> : {{ $order[0]?->billing_address?->address_line2 }}</li>
                            <li><span>City</span> : {{ $order[0]?->billing_address?->city }}</li>
                            <li><span>District</span> : {{ $order[0]?->billing_address?->district }}</li>
                            <li><span>Postcode </span> : {{ $order[0]?->billing_address?->zip }}</li>
                        </ul>
                    </div>
                </div>

            </div>
            <div class="order_details_table">
                <h2>Order Details</h2>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Product</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order_items as $item)
                                <tr>
                                    <td>
                                        <p>{{ $item->product->name }}</p>
                                    </td>
                                    <td>
                                        <h5>x {{ $item->quantity }}</h5>
                                    </td>
                                    <td>
                                        <p>${{ number_format($item->selling_price, 2) }}</p>
                                    </td>
                                </tr>
                            @endforeach

                            <tr>
                                <td>
                                    <h4>Subtotal</h4>
                                </td>
                                <td>
                                    <h5></h5>
                                </td>
                                <td>
                                    <p>${{ number_format($order_items->sum(fn($item) => $item->selling_price * $item->quantity), 2) }}
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h4>Delivery</h4>
                                </td>
                                <td>
                                    <h5></h5>
                                </td>
                                <td>
                                    <p>$30.00</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h4>Total</h4>
                                </td>
                                <td>
                                    <h5></h5>
                                </td>
                                <td>
                                    <p>${{ number_format($order[0]->total_amount, 2) }}</p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <!--================End Order Details Area =================-->
@endsection

@push('scripts')
@endpush
