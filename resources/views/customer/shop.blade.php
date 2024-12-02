@extends('layout.app')

@section('content')
    <!-- Start Banner Area -->
    <section class="banner-area organic-breadcrumb">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
                <div class="col-first">
                    <h1>Shop Category page</h1>
                    <nav class="d-flex align-items-center">
                        <a href="index.html">Home<span class="lnr lnr-arrow-right"></span></a>
                        <a href="#">Shop<span class="lnr lnr-arrow-right"></span></a>
                        <a href="category.html">Fashon Category</a>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <div class="container mt-5">
        <div class="row">
            <!-- Sidebar Filters -->
            <div class="col-lg-3">
                <div class="sidebar-categories">
                    <div class="head">Product Filters</div>

                    <!-- Brand Filter -->
                    <div class="common-filter mt-5">
                        <div class="head mb-2">Brands</div>
                        <form action="{{ route('shop') }}" method="GET">
                            <ul>
                                @foreach ($brands as $brand)
                                    <li class="filter-list">
                                        <input class="pixel-radio" type="radio" id="{{ $brand }}" name="brand"
                                            value="{{ $brand }}" {{ request('brand') == $brand ? 'checked' : '' }}>
                                        <label for="{{ $brand }}">{{ $brand }}</label>
                                    </li>
                                @endforeach
                            </ul>
                            <button type="submit" class="btn btn-primary mt-2">Apply</button>
                        </form>
                    </div>

                    <!-- Price Filter -->
                    <div class="common-filter mt-5 mb-5">
                        <div class="head mb-2">Price</div>
                        <form action="{{ route('shop') }}" method="GET">
                            <input type="number" name="price_min" placeholder="Min" class="form-control"
                                value="{{ request('price_min') }}">
                            <input type="number" name="price_max" placeholder="Max" class="form-control mt-2"
                                value="{{ request('price_max') }}">
                            <button type="submit" class="btn btn-primary mt-2">Apply</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Product Grid -->
            <div class="col-lg-9">
                <div class="row">
                    @forelse($products as $product)
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="single-product">
                                <img style="width: 150px;height: 150px; object-fit: contain;"
                                    src="{{ asset('storage/' . $product->image1) }}" alt="{{ $product->name }}"
                                    class="img-fluid">
                                <div class="product-details">
                                    <h6>{{ $product->name }}</h6>
                                    <div class="price">
                                        <h6>${{ $product->selling_price }}</h6>
                                        <h6 class="l-through">
                                            ${{ $product->selling_price * 0.05 + $product->selling_price }}
                                        </h6>
                                    </div>
                                    <div class="prd-bottom">
                                        <a href="javascript:void(0);" class="social-info add-to-cart"
                                            data-id="{{ $product->id }}" data-quantity="1">
                                            <span class="ti-bag"></span>
                                            <p class="hover-text">add to bag</p>
                                        </a>

                                        <a href="" class="social-info">
                                            <span class="lnr lnr-heart"></span>
                                            <p class="hover-text">Wishlist</p>
                                        </a>
                                        <a href="single-product/{{ $product->id }}" class="social-info">
                                            <span class="lnr lnr-move"></span>
                                            <p class="hover-text">view more</p>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p>No products found.</p>
                    @endforelse
                </div>

                <div class="pagination-wrapper d-flex justify-content-center mt-4">
                    {{ $products->links() }}
                </div>


            </div>
        </div>
    </div>
@endsection

@push('scripts')
@endpush
