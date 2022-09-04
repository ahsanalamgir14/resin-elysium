@extends('layouts.frontend')

@section('content')
    <div class="body-wrapper">
        <!-- Begin Slider With Banner Area -->
        <div class="slider-with-banner">
            <div class="container">
                <div class="row">
                    <!-- Begin Slider Area -->
                    <div class="col-lg-8 col-md-8">
                        <div class="slider-area">
                            <div class="slider-active owl-carousel">
                                <!-- Begin Single Slide Area -->
                                @foreach ($banners as $banner)
                                    <div style="background-image: url(storage/banners/{{ $banner->image }})"
                                        class="single-slide align-center-left animation-style-01 slider-images-position">
                                        <div class="slider-progress"></div>
                                        <div class="slider-content">
                                            {{-- <h5>Sale Offer <span>-20% Off</span> This Week</h5> --}}
                                            <h2>{{ $banner->btn_text }}</h2>
                                            {{-- <h3>Starting at <span>$1209.00</span></h3> --}}
                                            <div class="default-btn slide-btn">
                                                <a class="links" href="shop-left-sidebar.html">Shopping Now</a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <!-- Slider Area End Here -->
                    <!-- Begin Li Banner Area -->
                    <div class="col-lg-4 col-md-4 text-center pt-xs-30">
                        <div class="li-banner">
                            <a href="javascript:void(0)">
                                <img src="{{ asset('storage/home-images/banner_01.jpg') }}" alt="">
                            </a>
                        </div>
                        <div class="li-banner mt-15 mt-sm-30 mt-xs-30">
                            <a href="javascript:void(0)">
                                <img style="height: 227px;" src="{{ asset('storage/home-images/banner_02.jpg') }}"
                                    alt="">
                            </a>
                        </div>
                    </div>
                    <!-- Li Banner Area End Here -->
                </div>
            </div>
        </div>
        <!-- Slider With Banner Area End Here -->
        <!-- Begin Product Area -->
        <div class="product-area pt-60 pb-50">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="li-product-tab">
                            <ul class="nav li-product-menu">
                                <li><a class="active" data-toggle="tab" href="#li-new-product"><span>New
                                            Arrival</span></a></li>
                                {{-- <li><a data-toggle="tab" href="#li-bestseller-product"><span>Bestseller</span></a></li>
                            <li><a data-toggle="tab" href="#li-featured-product"><span>Featured Products</span></a> --}}
                                </li>
                            </ul>
                        </div>
                        <!-- Begin Li's Tab Menu Content Area -->
                    </div>
                </div>
                <div class="tab-content">
                    <div id="li-new-product" class="tab-pane active show" role="tabpanel">
                        <div class="row">
                            <div class="product-active owl-carousel">
                                {{-- <div class="col-lg-12"> --}}
                                <!-- single-product-wrap start -->
                                @foreach ($products as $product)
                                    <div class="single-product-wrap card-item-padding">
                                        <div class="product-image">
                                            <a href="product-view?slug={{ $product->slug }}">
                                                <img src="{{ asset('storage/products/' . $product->main_image) }}"
                                                    alt="{{ $product->main_image }}">
                                            </a>
                                            <span class="sticker">New</span>
                                        </div>
                                        <div class="product_desc">
                                            <div class="product_desc_info">
                                                <div class="product-review">
                                                    <h5 class="manufacturer">
                                                        <a
                                                            href="{{ url(
                                                                'all-products/?' .
                                                                    http_build_query([
                                                                        'filter_categories' => [$product->category->id],
                                                                    ]),
                                                            ) }}">{{ $product->category->name }}</a>
                                                    </h5>
                                                    <div class="rating-box">
                                                        <ul class="rating">
                                                            <li><i class="fa fa-star-o"></i></li>
                                                            <li><i class="fa fa-star-o"></i></li>
                                                            <li><i class="fa fa-star-o"></i></li>
                                                            <li class="no-star"><i class="fa fa-star-o"></i></li>
                                                            <li class="no-star"><i class="fa fa-star-o"></i></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <h4><a class="product_name"
                                                        href="product-view?slug={{ $product->slug }}">{{ $product->name }}</a>
                                                </h4>
                                                <div class="price-box">
                                                    <span class="new-price">Rs. {{ $product->price }}</span>
                                                </div>
                                            </div>
                                            <div class="add-actions">
                                                <ul class="add-actions-link">
                                                    <li class="add-cart active">
                                                        @if(!isset($product->quotes))
                                                        <a href="javascript:void(0)" onclick="add_to_cart(this, {{ $product->id }})">Add to cart</a>
                                                        @else
                                                        <a href="javascript:void(0)" onclick="loadAddToCartModal({{ $product }})">Add to Cart</a>
                                                        @endif
                                                    </li>
                                                    <li><a class="links-details" href="wishlist.html"><i
                                                                class="fa fa-heart-o"></i></a></li>
                                                    <li><a href="#" title="quick view" class="quick-view-btn"
                                                            data-toggle="modal" data-target="#exampleModalCenter"><i
                                                                class="fa fa-eye"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                <!-- single-product-wrap end -->
                                {{-- </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="default-btn text-center mt-4">
                    <a href="{{ url('all-products') }}" class="links">Browse ALL</a>
                </div>
            </div>
        </div>
        <!-- Product Area End Here -->
        <!-- Begin Li's Static Banner Area -->
        <div class="li-static-banner">
            <div class="container">
                <div class="row">
                    <!-- Begin Single Banner Area -->
                    <div class="col-lg-4 col-md-4 text-center">
                        <div class="single-banner">
                            <a href="#">
                                <img src="{{ asset('storage/home-images/static_01.jpg') }}" width="200px" height="220px"
                                    alt="Li's Static Banner">
                            </a>
                        </div>
                    </div>
                    <!-- Single Banner Area End Here -->
                    <!-- Begin Single Banner Area -->
                    <div class="col-lg-4 col-md-4 text-center pt-xs-30">
                        <div class="single-banner">
                            <a href="#">
                                <img src="{{ asset('storage/home-images/static_02.jpg') }}" width="200px" height="220px"
                                    alt="Li's Static Banner">
                            </a>
                        </div>
                    </div>
                    <!-- Single Banner Area End Here -->
                    <!-- Begin Single Banner Area -->
                    <div class="col-lg-4 col-md-4 text-center pt-xs-30">
                        <div class="single-banner">
                            <a href="#">
                                <img src="{{ asset('storage/home-images/static_03.jpg') }}" width="200px"
                                    height="220px" alt="Li's Static Banner">
                            </a>
                        </div>
                    </div>
                    <!-- Single Banner Area End Here -->
                </div>
            </div>
        </div>
        <!-- Li's Static Banner Area End Here -->
        <!-- Begin Li's Laptop Product Area -->
        <section class="product-area li-laptop-product pt-40 pb-45">
            @foreach ($home_categories as $home_cat)
                @if (count($home_cat->products) > 0)
                    <div class="container pt-20">
                        <div class="row">
                            <!-- Begin Li's Section Area -->
                            <div class="col-lg-12">
                                <div class="li-section-title">
                                    <h2>
                                        <span>{{ $home_cat->name }}</span>
                                    </h2>
                                </div>
                                <div class="row">
                                    <div class="product-active owl-carousel">
                                        {{-- <div class="col-lg-12"> --}}
                                        <!-- single-product-wrap start -->
                                        @foreach ($home_cat->products as $product)
                                            <div class="single-product-wrap card-item-padding">
                                                <div class="product-image">
                                                    <a href="product-view?slug={{ $product->slug }}">
                                                        <img src="{{ asset('storage/products/' . $product->main_image) }}"
                                                            alt="{{ $product->main_image }}">
                                                    </a>
                                                    {{-- <span class="sticker">New</span> --}}
                                                </div>
                                                <div class="product_desc">
                                                    <div class="product_desc_info">
                                                        <div class="product-review">
                                                            <h5 class="manufacturer">
                                                                <a
                                                                    href="{{ url(
                                                                        'all-products/?' .
                                                                            http_build_query([
                                                                                'filter_categories' => [$product->category->id],
                                                                            ]),
                                                                    ) }}">{{ $product->category->name }}</a>
                                                            </h5>
                                                            <div class="rating-box">
                                                                <ul class="rating">
                                                                    <li><i class="fa fa-star-o"></i></li>
                                                                    <li><i class="fa fa-star-o"></i></li>
                                                                    <li><i class="fa fa-star-o"></i></li>
                                                                    <li class="no-star"><i class="fa fa-star-o"></i></li>
                                                                    <li class="no-star"><i class="fa fa-star-o"></i></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <h4><a class="product_name"
                                                                href="product-view?slug={{ $product->slug }}">{{ $product->name }}</a>
                                                        </h4>
                                                        <div class="price-box">
                                                            <span class="new-price">Rs. {{ $product->price }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="add-actions">
                                                        <ul class="add-actions-link">
                                                            <li class="add-cart active">
                                                                @if(!isset($product->quotes))
                                                                <a href="javascript:void(0)" onclick="add_to_cart(this, {{ $product->id }})">Add to cart</a>
                                                                @else
                                                                <a href="javascript:void(0)" onclick="loadAddToCartModal({{ $product }})">Add to Cart</a>
                                                                @endif
                                                            </li>
                                                            <li><a class="links-details" href="wishlist.html"><i
                                                                        class="fa fa-heart-o"></i></a></li>
                                                            <li><a href="#" title="quick view"
                                                                    class="quick-view-btn" data-toggle="modal"
                                                                    data-target="#exampleModalCenter"><i
                                                                        class="fa fa-eye"></i></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                        @foreach ($home_cat->sub_categories as $sub_category)
                                            {{-- var_dump($) --}}
                                            @foreach ($sub_category->products as $product)
                                                <div class="single-product-wrap card-item-padding">
                                                    <div class="product-image">
                                                        <a href="product-view?slug={{ $product->slug }}">
                                                            <img src="{{ asset('storage/products/' . $product->main_image) }}"
                                                                alt="{{ $product->main_image }}">
                                                        </a>
                                                        {{-- <span class="sticker">New</span> --}}
                                                    </div>
                                                    <div class="product_desc">
                                                        <div class="product_desc_info">
                                                            <div class="product-review">
                                                                <h5 class="manufacturer">
                                                                    <a
                                                                        href="{{ url(
                                                                            'all-products/?' .
                                                                                http_build_query([
                                                                                    'filter_categories' => [$product->category->id],
                                                                                ]),
                                                                        ) }}">{{ $product->category->name }}</a>
                                                                </h5>
                                                                <div class="rating-box">
                                                                    <ul class="rating">
                                                                        <li><i class="fa fa-star-o"></i></li>
                                                                        <li><i class="fa fa-star-o"></i></li>
                                                                        <li><i class="fa fa-star-o"></i></li>
                                                                        <li class="no-star"><i class="fa fa-star-o"></i>
                                                                        </li>
                                                                        <li class="no-star"><i class="fa fa-star-o"></i>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                            <h4><a class="product_name"
                                                                    href="product-view?slug={{ $product->slug }}">{{ $product->name }}</a>
                                                            </h4>
                                                            <div class="price-box">
                                                                <span class="new-price">Rs. {{ $product->price }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="add-actions">
                                                            <ul class="add-actions-link">
                                                                <li class="add-cart active">
                                                                    @if(!isset($product->quotes))
                                                                    <a href="javascript:void(0)" onclick="add_to_cart(this, {{ $product->id }})">Add to cart</a>
                                                                    @else
                                                                    <a href="javascript:void(0)" onclick="loadAddToCartModal({{ $product }})">Add to Cart</a>
                                                                    @endif
                                                                </li>
                                                                <li><a class="links-details" href="wishlist.html"><i
                                                                            class="fa fa-heart-o"></i></a></li>
                                                                <li><a href="#" title="quick view"
                                                                        class="quick-view-btn" data-toggle="modal"
                                                                        data-target="#exampleModalCenter"><i
                                                                            class="fa fa-eye"></i></a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endforeach
                                        <!-- single-product-wrap end -->
                                        {{-- </div> --}}
                                    </div>
                                </div>
                            </div>
                            <!-- Li's Section Area End Here -->
                        </div>
                    </div>
                @endif
            @endforeach
        </section>

        <!-- Begin Li's Static Home Area -->
        <div class="li-static-home">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <!-- Begin Li's Static Home Image Area -->
                        <div class="li-static-home-image"></div>
                        <!-- Li's Static Home Image Area End Here -->
                        <!-- Begin Li's Static Home Content Area -->
                        <div class="li-static-home-content">
                            <p>Sale Offer<span>-20% Off</span>This Week</p>
                            <h2>Best Seller Products</h2>
                            <h2>Resin Gift Sales 2022</h2>
                            <p class="schedule">
                                Starting at
                                <span> Rs 499.00</span>
                            </p>
                            <div class="default-btn">
                                <a href="/all-products?product_type=is_best_seller" class="links">Shopping Now</a>
                            </div>
                        </div>
                        <!-- Li's Static Home Content Area End Here -->
                    </div>
                </div>
            </div>
        </div>
        <!-- Li's Static Home Area End Here -->
        <!-- Begin Li's Trending Product Area -->
        <section class="product-area li-trending-product pt-60 pb-45">
            <div class="container">
                <div class="row">
                    <!-- Begin Li's Tab Menu Area -->
                    <div class="col-lg-12">
                        <div class="li-product-tab li-trending-product-tab">
                            <h2>
                                <span>Trendding Products</span>
                            </h2>
                            {{-- <ul class="nav li-product-menu li-trending-product-menu">
                            <li><a class="active" data-toggle="tab" href="#home1"><span>Sanai</span></a></li>
                            <li><a data-toggle="tab" href="#home2"><span>Camera Accessories</span></a></li>
                            <li><a data-toggle="tab" href="#home3"><span>XailStation</span></a></li>
                        </ul> --}}
                        </div>
                        <!-- Begin Li's Tab Menu Content Area -->
                        <div class="tab-content li-tab-content li-trending-product-content">
                            <div id="home1" class="tab-pane show fade in active">
                                <div class="row">
                                    <div class="product-active owl-carousel">
                                        <!-- single-product-wrap start -->
                                        @foreach ($trending_products as $product)
                                            <div class="single-product-wrap card-item-padding">
                                                <div class="product-image">
                                                    <a href="product-view?slug={{ $product->slug }}">
                                                        <img src="{{ asset('storage/products/' . $product->main_image) }}"
                                                            alt="{{ $product->main_image }}">
                                                    </a>
                                                    {{-- <span class="sticker">New</span> --}}
                                                </div>
                                                <div class="product_desc">
                                                    <div class="product_desc_info">
                                                        <div class="product-review">
                                                            <h5 class="manufacturer">
                                                                <a
                                                                    href="{{ url(
                                                                        'all-products/?' .
                                                                            http_build_query([
                                                                                'filter_categories' => [$product->category->id],
                                                                            ]),
                                                                    ) }}">{{ $product->category->name }}</a>
                                                            </h5>
                                                            <div class="rating-box">
                                                                <ul class="rating">
                                                                    <li><i class="fa fa-star-o"></i></li>
                                                                    <li><i class="fa fa-star-o"></i></li>
                                                                    <li><i class="fa fa-star-o"></i></li>
                                                                    <li class="no-star"><i class="fa fa-star-o"></i></li>
                                                                    <li class="no-star"><i class="fa fa-star-o"></i></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <h4><a class="product_name"
                                                                href="product-view?slug={{ $product->slug }}">{{ $product->name }}</a>
                                                        </h4>
                                                        <div class="price-box">
                                                            <span class="new-price">Rs.
                                                                {{ $product->price }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="add-actions">
                                                        <ul class="add-actions-link">
                                                            <li class="add-cart active">
                                                                @if(!isset($product->quotes))
                                                                <a href="javascript:void(0)" onclick="add_to_cart(this, {{ $product->id }})">Add to cart</a>
                                                                @else
                                                                <a href="javascript:void(0)" onclick="loadAddToCartModal({{ $product }})">Add to Cart</a>
                                                                @endif
                                                            </li>
                                                            <li><a class="links-details" href="wishlist.html"><i
                                                                        class="fa fa-heart-o"></i></a></li>
                                                            <li><a href="#" title="quick view"
                                                                    class="quick-view-btn" data-toggle="modal"
                                                                    data-target="#exampleModalCenter"><i
                                                                        class="fa fa-eye"></i></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                        <!-- single-product-wrap end -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Tab Menu Content Area End Here -->
                    </div>
                    <!-- Tab Menu Area End Here -->
                </div>
            </div>
        </section>
        <!-- Li's Trending Product Area End Here -->
        <!-- Begin Li's Trendding Products Area -->
        <section class="product-area li-laptop-product li-trendding-products best-sellers pb-45">
            <div class="container">
                <div class="row">
                    <!-- Begin Li's Section Area -->
                    <div class="col-lg-12">
                        <div class="li-section-title">
                            <h2>
                                <span>Bestsellers</span>
                            </h2>
                        </div>
                        <div class="row">
                            <div class="product-active owl-carousel">
                                <!-- single-product-wrap start -->
                                @foreach ($best_seller_products as $product)
                                    <div class="single-product-wrap card-item-padding">
                                        <div class="product-image">
                                            <a href="product-view?slug={{ $product->slug }}">
                                                <img src="{{ asset('storage/products/' . $product->main_image) }}"
                                                    alt="{{ $product->main_image }}">
                                            </a>
                                            {{-- <span class="sticker">New</span> --}}
                                        </div>
                                        <div class="product_desc">
                                            <div class="product_desc_info">
                                                <div class="product-review">
                                                    <h5 class="manufacturer">
                                                        <a
                                                            href="{{ url(
                                                                'all-products/?' .
                                                                    http_build_query([
                                                                        'filter_categories' => [$product->category->id],
                                                                    ]),
                                                            ) }}">{{ $product->category->name }}</a>
                                                    </h5>
                                                    <div class="rating-box">
                                                        <ul class="rating">
                                                            <li><i class="fa fa-star-o"></i></li>
                                                            <li><i class="fa fa-star-o"></i></li>
                                                            <li><i class="fa fa-star-o"></i></li>
                                                            <li class="no-star"><i class="fa fa-star-o"></i></li>
                                                            <li class="no-star"><i class="fa fa-star-o"></i></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <h4><a class="product_name"
                                                        href="product-view?slug={{ $product->slug }}">{{ $product->name }}</a>
                                                </h4>
                                                <div class="price-box">
                                                    <span class="new-price">Rs.
                                                        {{ $product->price }}</span>
                                                </div>
                                            </div>
                                            <div class="add-actions">
                                                <ul class="add-actions-link">
                                                    <li class="add-cart active">
                                                        @if(!isset($product->quotes))
                                                        <a href="javascript:void(0)" onclick="add_to_cart(this, {{ $product->id }})">Add to cart</a>
                                                        @else
                                                        <a href="javascript:void(0)" onclick="loadAddToCartModal({{ $product }})">Add to Cart</a>
                                                        @endif
                                                    </li>
                                                    <li><a class="links-details" href="wishlist.html"><i
                                                                class="fa fa-heart-o"></i></a></li>
                                                    <li><a href="#" title="quick view" class="quick-view-btn"
                                                            data-toggle="modal" data-target="#exampleModalCenter"><i
                                                                class="fa fa-eye"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                <!-- single-product-wrap end -->
                            </div>
                        </div>
                    </div>
                    <!-- Li's Section Area End Here -->
                </div>
            </div>
        </section>
        <!-- Li's Trendding Products Area End Here -->
        <!-- Begin Quick View | Modal Area -->
        <div class="modal fade modal-wrapper" id="exampleModalCenter">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <div class="modal-inner-area row">
                            <div class="col-lg-5 col-md-6 col-sm-6">
                                <!-- Product Details Left -->
                                <div class="product-details-left">
                                    <div class="product-details-images slider-navigation-1">
                                        <div class="lg-image">
                                            <img src="{{ asset('storage/images/product/large-size/1.jpg') }}"
                                                alt="product image">
                                        </div>
                                        <div class="lg-image">
                                            <img src="{{ asset('storage/images/product/large-size/2.jpg') }}"
                                                alt="product image">
                                        </div>
                                        <div class="lg-image">
                                            <img src="{{ asset('storage/images/product/large-size/3.jpg') }}"
                                                alt="product image">
                                        </div>
                                        <div class="lg-image">
                                            <img src="{{ asset('storage/images/product/large-size/4.jpg') }}"
                                                alt="product image">
                                        </div>
                                        <div class="lg-image">
                                            <img src="{{ asset('storage/images/product/large-size/5.jpg') }}"
                                                alt="product image">
                                        </div>
                                        <div class="lg-image">
                                            <img src="{{ asset('storage/images/product/large-size/6.jpg') }}"
                                                alt="product image">
                                        </div>
                                    </div>
                                    <div class="product-details-thumbs slider-thumbs-1">
                                        <div class="sm-image"><img
                                                src="{{ asset('storage/images/product/small-size/1.jpg') }}"
                                                alt="product image thumb"></div>
                                        <div class="sm-image"><img
                                                src="{{ asset('storage/images/product/small-size/2.jpg') }}"
                                                alt="product image thumb"></div>
                                        <div class="sm-image"><img
                                                src="{{ asset('storage/images/product/small-size/3.jpg') }}"
                                                alt="product image thumb"></div>
                                        <div class="sm-image"><img
                                                src="{{ asset('storage/images/product/small-size/4.jpg') }}"
                                                alt="product image thumb"></div>
                                        <div class="sm-image"><img
                                                src="{{ asset('storage/images/product/small-size/5.jpg') }}"
                                                alt="product image thumb"></div>
                                        <div class="sm-image"><img
                                                src="{{ asset('storage/images/product/small-size/6.jpg') }}"
                                                alt="product image thumb"></div>
                                    </div>
                                </div>
                                <!--// Product Details Left -->
                            </div>

                            <div class="col-lg-7 col-md-6 col-sm-6">
                                <div class="product-details-view-content pt-60">
                                    <div class="product-info">
                                        <h2>Today is a good day Framed poster</h2>
                                        <span class="product-details-ref">Reference: demo_15</span>
                                        <div class="rating-box pt-20">
                                            <ul class="rating rating-with-review-item">
                                                <li><i class="fa fa-star-o"></i></li>
                                                <li><i class="fa fa-star-o"></i></li>
                                                <li><i class="fa fa-star-o"></i></li>
                                                <li class="no-star"><i class="fa fa-star-o"></i></li>
                                                <li class="no-star"><i class="fa fa-star-o"></i></li>
                                                <li class="review-item"><a href="#">Read Review</a></li>
                                                <li class="review-item"><a href="#">Write Review</a></li>
                                            </ul>
                                        </div>
                                        <div class="price-box pt-20">
                                            <span class="new-price new-price-2">$57.98</span>
                                        </div>
                                        <div class="product-desc">
                                            <p>
                                                <span>100% cotton double printed dress. Black and white striped top and
                                                    orange high waisted skater skirt bottom. Lorem ipsum dolor sit amet,
                                                    consectetur adipisicing elit. quibusdam corporis, earum facilis et
                                                    nostrum dolorum accusamus similique eveniet quia pariatur.
                                                </span>
                                            </p>
                                        </div>
                                        <div class="product-variants">
                                            <div class="produt-variants-size">
                                                <label>Dimension</label>
                                                <select class="nice-select">
                                                    <option value="1" title="S" selected="selected">40x60cm
                                                    </option>
                                                    <option value="2" title="M">60x90cm</option>
                                                    <option value="3" title="L">80x120cm</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="single-add-to-cart">
                                            <form action="#" class="cart-quantity">
                                                <div class="quantity">
                                                    <label>Quantity</label>
                                                    <div class="cart-plus-minus">
                                                        <input class="cart-plus-minus-box" value="1" type="text">
                                                        <div class="dec qtybutton"><i class="fa fa-angle-down"></i>
                                                        </div>
                                                        <div class="inc qtybutton"><i class="fa fa-angle-up"></i></div>
                                                    </div>
                                                </div>
                                                <button class="add-to-cart" type="submit">Add to cart</button>
                                            </form>
                                        </div>
                                        <div class="product-additional-info pt-25">
                                            <a class="wishlist-btn" href="wishlist.html"><i class="fa fa-heart-o"></i>Add
                                                to wishlist</a>
                                            <div class="product-social-sharing pt-25">
                                                <ul>
                                                    <li class="facebook"><a href="#"><i
                                                                class="fa fa-facebook"></i>Facebook</a></li>
                                                    <li class="twitter"><a href="#"><i
                                                                class="fa fa-twitter"></i>Twitter</a></li>
                                                    <li class="google-plus"><a href="#"><i
                                                                class="fa fa-google-plus"></i>Google +</a></li>
                                                    <li class="instagram"><a href="#"><i
                                                                class="fa fa-instagram"></i>Instagram</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Quick View | Modal Area End Here -->
        <!-- Add to cart | Modal Area Start Here -->
        <div class="modal modal-wrapper" id="addToCartHome">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <div class="modal-header">
                        <h3 class="card-title">Add or Review Details</h3>
                    </div>
                    <div class="modal-body">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
