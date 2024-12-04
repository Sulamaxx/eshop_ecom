@extends('layout.app')

@section('content')
    <!-- Start Banner Area -->
    <section class="banner-area organic-breadcrumb">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
                <div class="col-first">
                    <h1>Checkout</h1>
                    <nav class="d-flex align-items-center">
                        <a href="index.html">Home<span class="lnr lnr-arrow-right"></span></a>
                        <a href="single-product.html">Checkout</a>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- End Banner Area -->

    <!--================Checkout Area =================-->
    <section class="checkout_area section_gap">
        <div class="container">
            <div class="billing_details">
                <div class="row">

                    <div class="col-lg-4 d-lg-none d-block">
                        <div class="order_box">
                            <h2>Your Order</h2>
                            <ul class="list">
                                <li><a href="#">Product <span>Total</span></a></li>
                                @php
                                    $total = 0;
                                @endphp
                                @foreach ($cartItems as $item)
                                    <li>
                                        <a href="#" class="row">
                                            <span class="col-12">{{ $item->product->name }}</span>

                                            <span class="col-6"
                                                style="text-align: end">${{ number_format($item->product->selling_price * $item->quantity, 2) }}</span>
                                            <span class="col-6">x {{ $item->quantity }}</span>
                                        </a>
                                    </li>
                                    @php
                                        $total += $item->product->selling_price * $item->quantity;
                                    @endphp
                                @endforeach
                            </ul>

                            <ul class="list list_2 mt-5">
                                <li style="text-align: end">Subtotal <span
                                        class="col-12">${{ number_format($total, 2) }}</span></li>
                                <li style="text-align: end">Delivery Cost <span class="col-12">$30.00</span></li>
                                <li style="text-align: end">Total <span
                                        class="col-12">${{ number_format($total + 30, 2) }}</span></li>
                            </ul>

                        </div>
                    </div>

                    <div class="col-lg-8 mt-5 mt-lg-0">
                        <h3>Billing Details</h3>

                        @if (count($exist_addresses) > 0)
                            <div class="form-group">
                                <h4>Select an Existing Address</h4>
                                @foreach ($exist_addresses as $address)
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input select-address"
                                            name="selected_address" id="address_{{ $address->id }}"
                                            data-address="{{ json_encode($address) }}">
                                        <label class="form-check-label" for="address_{{ $address->id }}">
                                            {{ $address->first_name }} {{ $address->last_name }},
                                            {{ $address->address_line1 }}, {{ $address->address_line2 ?? '' }},
                                            {{ $address->city }}, {{ $address->district }},
                                            ZIP: {{ $address->zip }},
                                            Phone: {{ $address->phone }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        @endif

                        <form class="row contact_form" action="{{ route('checkout.submit') }}" method="POST"
                            novalidate="novalidate">
                            @csrf
                            <input type="number" id="address_id" hidden name="address_id">
                            <div class="col-md-6 form-group p_star">
                                <input type="text" class="form-control" id="first" name="first_name" required>
                                <span class="placeholder" data-placeholder="First name"></span>
                            </div>
                            <div class="col-md-6 form-group p_star">
                                <input type="text" class="form-control" id="last" name="last_name" required>
                                <span class="placeholder" data-placeholder="Last name"></span>
                            </div>
                            <div class="col-md-6 form-group p_star">
                                <input type="number" class="form-control" id="number" name="phone" required>
                                <span class="placeholder" data-placeholder="Phone number"></span>
                            </div>
                            <div class="col-md-6 form-group p_star">
                                <input type="email" class="form-control" id="email" name="email" required>
                                <span class="placeholder" data-placeholder="Email Address"></span>
                            </div>
                            <div class="col-md-12 form-group p_star">
                                <input type="text" class="form-control" id="add1" name="address_line1" required>
                                <span class="placeholder" data-placeholder="Address line 01"></span>
                            </div>
                            <div class="col-md-12 form-group p_star">
                                <input type="text" class="form-control" id="add2" name="address_line2">
                                <span class="placeholder" data-placeholder="Address line 02"></span>
                            </div>
                            <div class="col-md-12 form-group p_star">
                                <input type="text" class="form-control" id="city" name="city" required>
                                <span class="placeholder" data-placeholder="Town/City"></span>
                            </div>
                            <div class="col-md-12 form-group p_star">
                                <input type="text" class="form-control" id="district" name="district" required>
                                <span class="placeholder" data-placeholder="District"></span>
                            </div>
                            <div class="col-md-12 form-group">
                                <input type="text" class="form-control" id="zip" name="zip"
                                    placeholder="Postcode/ZIP" required>
                            </div>
                            <div class="col-md-12 form-group">
                                <div class="row justify-content-center align-items-center">
                                    <label class="col-6">Payment Method:</label>
                                    <select class="form-control col-6" name="payment_method" required>
                                        <option value="cash">Cash on Delivery</option>
                                        <option value="card">Card Payment</option>
                                    </select>
                                </div>
                            </div>

                            <div class="creat_account col-12">
                                <div class="row justify-content-center">
                                    <input type="checkbox" id="f-option4" name="selector">
                                    <label for="f-option4">I’ve read and accept the </label>
                                    <a href="#">terms & conditions*</a>
                                </div>
                            </div>
                            <div class="col-md-12 form-group">
                                <button type="submit" class=" col-12 primary-btn">Submit Order</button>
                            </div>
                        </form>

                    </div>

                    <div class="col-lg-4 d-lg-block d-none">
                        <div class="order_box">
                            <h2>Your Order</h2>
                            <ul class="list">
                                <li><a href="#">Product <span>Total</span></a></li>
                                @php
                                    $total = 0;
                                @endphp
                                @foreach ($cartItems as $item)
                                    <li>
                                        <a href="#" class="row">
                                            <span class="col-12">{{ $item->product->name }}</span>

                                            <span class="col-6"
                                                style="text-align: end">${{ number_format($item->product->selling_price * $item->quantity, 2) }}</span>
                                            <span class="col-6">x {{ $item->quantity }}</span>
                                        </a>
                                    </li>
                                    @php
                                        $total += $item->product->selling_price * $item->quantity;
                                    @endphp
                                @endforeach
                            </ul>

                            <ul class="list list_2 mt-5">
                                <li style="text-align: end">Subtotal <span
                                        class="col-12">${{ number_format($total, 2) }}</span></li>
                                <li style="text-align: end">Delivery Cost <span class="col-12">$30.00</span></li>
                                <li style="text-align: end">Total <span
                                        class="col-12">${{ number_format($total + 30, 2) }}</span></li>
                            </ul>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!--================End Checkout Area =================-->
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const addressRadios = document.querySelectorAll('.select-address');

            addressRadios.forEach(radio => {
                radio.addEventListener('change', function() {
                    const address = JSON.parse(this.dataset.address);

                    document.getElementById('address_id').value = address.id;
                    document.getElementById('first').value = address.first_name;
                    document.getElementById('last').value = address.last_name;
                    document.getElementById('number').value = address.phone;
                    document.getElementById('email').value = address.email;
                    document.getElementById('add1').value = address.address_line1;
                    document.getElementById('add2').value = address.address_line2 || '';
                    document.getElementById('city').value = address.city;
                    document.getElementById('district').value = address.district;
                    document.getElementById('zip').value = address.zip;
                });
            });
        });
    </script>
@endpush
