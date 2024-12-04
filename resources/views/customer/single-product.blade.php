@extends('layout.app')

@section('content')
    <style>
        .list {
            list-style: none;
            padding: 0;
            display: flex;
        }

        .list li {
            cursor: pointer;
            margin-right: 5px;
        }

        .list li i {
            font-size: 24px;
            color: gray;
        }

        .list li.filled i {
            color: gold;
        }
    </style>
    <!-- Start Banner Area -->
    <section class="banner-area organic-breadcrumb">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
                <div class="col-first">
                    <h1>Product Details Page</h1>
                    <nav class="d-flex align-items-center">
                        <a href="/">Home<span class="lnr lnr-arrow-right"></span></a>
                        <a href="/shop">Shop<span class="lnr lnr-arrow-right"></span></a>
                        <a href="">product-details</a>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- End Banner Area -->

    <!--================Single Product Area =================-->
    <div class="product_image_area">
        <div class="container">
            <div class="row s_product_inner">
                <div class="col-lg-6">
                    <div class="s_Product_carousel">
                        <div class="single-prd-item">
                            <img class="img-fluid" style="width: 450px; height: 350px; object-fit: contain;"
                                src="{{ asset('storage/' . $product->image1) }}" alt="">
                        </div>
                        <div class="single-prd-item">
                            <img class="img-fluid" style="width: 450px; height: 350px; object-fit: contain;"
                                src="{{ asset('storage/' . $product->image2) }}" alt="">
                        </div>
                        <div class="single-prd-item">
                            <img class="img-fluid" style="width: 450px; height: 350px; object-fit: contain;"
                                src="{{ asset('storage/' . $product->image3) }}" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 offset-lg-1">
                    <div class="s_product_text">
                        <h3>{{ $product->name }}</h3>
                        <h2>${{ $product->selling_price }}</h2>
                        <ul class="list">
                            <li><a class="active" href=""><span>Brand</span> : {{ $product->brand }}</a></li>
                            <li><a href=""><span>Availibility</span> :
                                    @if ($product->qty > 0)
                                        In Stock
                                    @else
                                        Out Of Stock
                                    @endif
                                </a></li>
                        </ul>
                        <div class="product_count">
                            <label for="qty">Quantity:</label>
                            <input type="text" name="qty" id="sst" maxlength="12" value="1"
                                title="Quantity:" class="input-text qty">
                            <button
                                onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst )) result.value++;return false;"
                                class="increase items-count" type="button"><i class="lnr lnr-chevron-up"></i></button>
                            <button
                                onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst ) &amp;&amp; sst > 0 ) result.value--;return false;"
                                class="reduced items-count" type="button"><i class="lnr lnr-chevron-down"></i></button>
                        </div>
                        <div class="card_area d-flex align-items-center">
                            <a class="primary-btn add-to-cart-single" href="javascript:void(0);"
                                data-id="{{ $product->id }}">Add to Cart</a>
                            <a class="icon_btn" href=""><i class="lnr lnr lnr-heart"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--================End Single Product Area =================-->

    <!--================Product Description Area =================-->
    <section class="product_description_area">
        <div class="container">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home"
                        aria-selected="true">Description</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab"
                        aria-controls="contact" aria-selected="false">Comments</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" id="review-tab" data-toggle="tab" href="#review" role="tab"
                        aria-controls="review" aria-selected="false">Reviews</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <p>{{ $product->description }}</p>
                </div>

                <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="comment_list">
                                <div class="review_item">
                                    <div class="media">
                                        <div class="d-flex">
                                            <img src="{{ asset('img/product/review-1.png') }}" alt="">
                                        </div>
                                        <div class="media-body">
                                            <h4>Blake Ruiz</h4>
                                            <h5>12th Feb, 2018 at 05:56 pm</h5>
                                            <a class="reply_btn" href="#">Reply</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="review_item reply">
                                    <div class="media">
                                        <div class="d-flex">
                                            <img src="{{ asset('img/product/review-2.png') }}" alt="">
                                        </div>
                                        <div class="media-body">
                                            <h4>Blake Ruiz</h4>
                                            <h5>12th Feb, 2018 at 05:56 pm</h5>
                                            <a class="reply_btn" href="#">Reply</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="review_item">
                                    <div class="media">
                                        <div class="d-flex">
                                            <img src="{{ asset('img/product/review-3.png') }}" alt="">
                                        </div>
                                        <div class="media-body">
                                            <h4>Blake Ruiz</h4>
                                            <h5>12th Feb, 2018 at 05:56 pm</h5>
                                            <a class="reply_btn" href="#">Reply</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="review_box">
                                <h4>Post a comment</h4>
                                <form class="row contact_form" action="contact_process.php" method="post"
                                    id="contactForm" novalidate="novalidate">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="name" name="name"
                                                placeholder="Your Full name">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="email" class="form-control" id="email" name="email"
                                                placeholder="Email Address">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="number" name="number"
                                                placeholder="Phone Number">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <textarea class="form-control" name="message" id="message" rows="1" placeholder="Message"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12 text-right">
                                        <button type="submit" value="submit" class="btn primary-btn">Submit Now</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade show active" id="review" role="tabpanel" aria-labelledby="review-tab">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="row total_rate">
                                <div class="col-12">
                                    <div class="box_total">
                                        <h5>Overall</h5>
                                        <h4>
                                            @php
                                                $totalRatings = $product_rates->sum('rating');
                                                $totalReviews = $product_rates->count();
                                                $overallRating = $totalReviews > 0 ? $totalRatings / $totalReviews : 0;
                                            @endphp
                                            {{ number_format($overallRating, 1) }}
                                        </h4>
                                        <h6>({{ $totalReviews }} Reviews)</h6>
                                    </div>

                                </div>
                            </div>

                        </div>
                        <div class="col-lg-6">
                            <div class="review_box">
                                <h4>Add a Review</h4>
                                <p>Your Rating:</p>
                                @if (count($own_rate) > 0)
                                    <ul class="list">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <li data-value="{{ $i }}"
                                                class="{{ $i <= $own_rate[0]->rating ? 'filled' : '' }}">
                                                <i
                                                    class="fa {{ $i <= $own_rate[0]->rating ? 'fa-star' : 'fa-star-o' }}"></i>
                                            </li>
                                        @endfor
                                    </ul>
                                @else
                                    <ul class="list">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <li data-value="{{ $i }}">
                                                <i class="fa fa-star-o"></i>
                                            </li>
                                        @endfor
                                    </ul>
                                @endif
                            </div>
                        </div>

                    </div>
                    <div class="row mt-3">
                        @if (count($product_rates) > 0)
                            @foreach ($product_rates as $product_rate)
                                <div class="review_item col-4">
                                    <div class="media">
                                        <div class="d-flex">
                                            <img src="{{ asset('img/product/review-1.png') }}" alt="">
                                        </div>
                                        <div class="media-body">
                                            <h4>{{ $product_rate->user->fname ?? 'Anonymous' }}</h4>
                                            @for ($i = 1; $i <= 5; $i++)
                                                @if ($i <= $product_rate->rating)
                                                    <i class="fa fa-star" style="color: gold;"></i>
                                                @else
                                                    <i class="fa fa-star-o" style="color: gray;"></i>
                                                @endif
                                            @endfor
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>

                </div>
            </div>

        </div>
        </div>
    </section>
    <!--================End Product Description Area =================-->

    <!-- Start related-product Area -->
    <section class="related-product-area section_gap_bottom">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 text-center">
                    <div class="section-title">
                        <h1>Deals of the Week</h1>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut
                            labore et dolore
                            magna aliqua.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-9">
                    <div class="row">

                        @foreach ($relatedProducts as $product)
                            <div class="col-lg-4 col-md-4 col-sm-6 mb-20">
                                <div class="single-related-product d-flex">
                                    <a href="/single-product/{{ $product->id }}"><img
                                            src="{{ asset('storage/' . $product->image1) }}"
                                            style="width: 150px; height: 150px; object-fit: contain;" alt=""></a>
                                    <div class="desc">
                                        <a href="/single-product/{{ $product->id }}"
                                            class="title">{{ $product->name }}</a>
                                        <div class="price">
                                            <h6>${{ $product->selling_price }}</h6>
                                            <h6 class="l-through">
                                                ${{ $product->selling_price * 0.05 + $product->selling_price }}</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="ctg-right">
                        <a href="#" target="_blank">
                            <img class="img-fluid d-block mx-auto" src="{{ asset('img/category/c5.jpg') }}"
                                alt="">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End related-product Area -->
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('.add-to-cart-single').on('click', function(e) {
                e.preventDefault();
                let productId = $(this).data('id');
                let quantity = $('.qty').val();
                $.ajax({
                    url: `/cart/add/${productId}/${quantity}`,
                    type: 'GET',
                    data: {
                        _token: '{{ csrf_token() }}',
                    },
                    success: function(response) {
                        console.log(response);
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
            });
        });

        document.addEventListener("DOMContentLoaded", function() {
            const stars = document.querySelectorAll(".list li");

            stars.forEach(star => {
                star.addEventListener("click", function() {
                    const value = this.getAttribute("data-value");
                    updateStars(value);

                    $.ajax({
                        url: `/rate-product`,
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            product_id: window.location.pathname.split('/').pop(),
                            rating: value,
                        },
                        success: function(response) {
                            if (response.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success',
                                    text: `You have successfully rated ${response.rating}`,
                                });
                                window.location.reload();
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: 'An unknown error occurred.',
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
                            if (error == "Unauthorized") {
                                window.location = "/login";
                            }
                        },
                    });
                });
            });

            function updateStars(rating) {
                stars.forEach(star => {
                    const starValue = star.getAttribute("data-value");
                    const icon = star.querySelector("i");

                    if (!icon) {
                        console.error("No <i> tag found inside the star element.");
                        return;
                    }

                    if (starValue <= rating) {
                        star.classList.add("filled");
                        icon.className = "fa fa-star";
                    } else {
                        star.classList.remove("filled");
                        icon.className = "fa fa-star-o";
                    }
                });
            }
        });
    </script>
@endpush
