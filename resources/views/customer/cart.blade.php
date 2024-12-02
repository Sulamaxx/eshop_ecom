@extends('layout.app')

@section('content')
    <!-- Start Banner Area -->
    <section class="banner-area organic-breadcrumb">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
                <div class="col-first">
                    <h1>Shopping Cart</h1>
                    <nav class="d-flex align-items-center">
                        <a href="index.html">Home<span class="lnr lnr-arrow-right"></span></a>
                        <a href="category.html">Cart</a>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- End Banner Area -->

    <!--================Cart Area =================-->
    <section class="cart_area">
        <div class="container">
            <div class="cart_inner">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Product</th>
                                <th scope="col">Price</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cartItems as $item)
                                @if (Auth::check())
                                    {{-- Authenticated user cart --}}
                                    <tr>
                                        <td>
                                            <div class="media">
                                                <div class="d-flex">
                                                    <img style="width: 80px;height: 80px;object-fit: contain;"
                                                        src="{{ asset('storage/' . $item->product->image1) }}"
                                                        alt="">
                                                </div>
                                                <div class="media-body">
                                                    <p>{{ $item->product->name }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <h5>${{ $item->product->selling_price }}</h5>
                                        </td>
                                        <td>
                                            <div class="product_count">
                                                <input type="number" name="qty" id="sst-{{ $item->id }}"
                                                    maxlength="12" value="{{ $item->quantity }}" title="Quantity:"
                                                    class="input-text qty">
                                                <button class="increase items-count" type="button"
                                                    onclick="increaseQty({{ $item->id }}, {{ $item->product->selling_price }})">
                                                    <i class="lnr lnr-chevron-up"></i>
                                                </button>
                                                <button class="reduced items-count" type="button"
                                                    onclick="decreaseQty({{ $item->id }}, {{ $item->product->selling_price }})">
                                                    <i class="lnr lnr-chevron-down"></i>
                                                </button>
                                            </div>
                                        </td>
                                        <td>
                                            <h5 id="subtotal-{{ $item->id }}">
                                                ${{ $item->product->selling_price * $item->quantity }}</h5>
                                        </td>
                                        <td>
                                            <button class="btn btn-danger btn-sm"
                                                onclick="removeFromCart({{ $item->id }})">
                                                Remove
                                            </button>
                                        </td>
                                    </tr>
                                @else
                                    {{-- Session-based cart --}}
                                    @foreach (\App\Models\Product::where('status', 'Active')->get() as $product)
                                        @if ($product->id == $item['product_id'])
                                            <tr>
                                                <td>
                                                    <div class="media">
                                                        <div class="d-flex">
                                                            <img style="width: 80px;height: 80px;object-fit: contain;"
                                                                src="{{ asset('storage/' . $product->image1) }}"
                                                                alt="">
                                                        </div>
                                                        <div class="media-body">
                                                            <p>{{ $product->name }}</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <h5>${{ $product->selling_price }}</h5>
                                                </td>
                                                <td>
                                                    <div class="product_count">
                                                        <input type="number" name="qty" id="sst-{{ $product->id }}"
                                                            maxlength="12" value="{{ $item['quantity'] }}"
                                                            title="Quantity:" class="input-text qty">
                                                        <button class="increase items-count" type="button"
                                                            onclick="increaseQty({{ $product->id }}, {{ $product->selling_price }})">
                                                            <i class="lnr lnr-chevron-up"></i>
                                                        </button>
                                                        <button class="reduced items-count" type="button"
                                                            onclick="decreaseQty({{ $product->id }}, {{ $product->selling_price }})">
                                                            <i class="lnr lnr-chevron-down"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                                <td>
                                                    <h5 id="subtotal-{{ $product->id }}">
                                                        ${{ $product->selling_price * $item['quantity'] }}</h5>
                                                </td>
                                                <td>
                                                    <button class="btn btn-danger btn-sm"
                                                        onclick="removeFromCart({{ $product->id }})">
                                                        Remove
                                                    </button>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                @endif
                            @endforeach

                            <tr>
                                <td colspan="4" style="text-align: right;"><strong>Total:</strong></td>
                                <td>
                                    <h5 id="cart-total">$ 0.00</h5>
                                </td>
                            </tr>
                            <tr class="out_button_area">
                                <td colspan="4" style="text-align: right;"></td>
                                <td>
                                    <div class="checkout_btn_inner d-flex align-items-center">
                                        <a class="primary-btn col-12 text-center" href="/checkout">Proceed to checkout</a>
                                    </div>
                                </td>
                            </tr>
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </section>
    <!--================End Cart Area =================-->
@endsection

@push('scripts')
    <script>
        function updateTotal() {
            let total = 0;
            $('[id^="subtotal-"]').each(function() {
                total += parseFloat($(this).text().replace('$', '').trim());
            });

            $('#cart-total').text(`$${total.toFixed(2)}`);
        }

        updateTotal();

        function increaseQty(itemId, price) {
            let inputField = $(`#sst-${itemId}`);
            let currentQuantity = parseInt(inputField.val());
            let newQuantity = currentQuantity + 1;

            inputField.val(newQuantity);
            updateCart(itemId, newQuantity, price);
        }

        function decreaseQty(itemId, price) {
            console.log(price)
            let inputField = $(`#sst-${itemId}`);
            let currentQuantity = parseInt(inputField.val());
            let newQuantity = Math.max(currentQuantity - 1, 1);

            inputField.val(newQuantity);
            updateCart(itemId, newQuantity, price);
        }

        function updateCart(itemId, newQuantity, price) {
            let subtotal = newQuantity * price;
            $(`#subtotal-${itemId}`).text(`$${subtotal.toFixed(2)}`);
            updateTotal();
            $.ajax({
                url: '/cart/update',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    id: itemId,
                    quantity: newQuantity
                },
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: response.message,
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: response.error,
                        });
                    }
                },
                error: function(xhr, status, error) {
                    console.error(error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: error,
                    });
                }
            });
        }


        function removeFromCart(id) {
            if (confirm('Are you sure you want to remove this item from the cart?')) {
                $.ajax({
                    url: `/cart/remove/${id}`,
                    type: 'POST',
                    headers: {
                        _method: 'DELETE',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: response.message,
                            });
                            location.reload();
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Failed to remove item.',
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: error,
                        });
                    }
                });
            }
        }
    </script>
@endpush
