<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" id="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Resin Elysium') }}</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.png">
    <link rel="stylesheet" href="{{ asset('css/material-design-iconic-font.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fontawesome-stars.css') }}">
    <link rel="stylesheet" href="{{ asset('css/meanmenu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/venobox.css') }}">
    <link rel="stylesheet" href="{{ asset('css/nice-select.css') }}">
    <link rel="stylesheet" href="{{ asset('css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/helper.css') }}">
    <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->
    <!-- Favicon -->
    <link rel="stylesheet" href=" {{ asset('style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
    <!-- Modernizr js -->
    <script src="{{ asset('js/vendor/modernizr-2.8.3.min.js') }}"></script>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <!-- <script src="{{ asset('js/app.js') }}" defer></script> -->
    <script src="{{ asset('js/custom.js') }}" defer></script>

    <!-- font awesome  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/admin-custom.css') }}">

    @notifyCss
    @notifyJs

    <!-- Styles -->
    <!-- <link href="{{ URL::asset('css/custom.css') }}" rel="stylesheet" type="text/css"> -->
    <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->
</head>

<body>
    <x:notify-messages />
    <div id="app">
        <main>
            <div class="body-wrapper">
                <!-- Begin Header Area -->
                <header>
                    <!-- Begin Header Top Area -->
                    <div class="header-top">
                        <div class="container">
                            <div class="row">
                                <!-- Begin Header Top Left Area -->
                                <div class="col-lg-3 col-md-4">
                                    <div class="header-top-left">
                                        <ul class="phone-wrap">
                                            <!-- <li><span>Telephone Enquiry:</span><a href="#">(+123) 123 321 345</a></li> -->
                                        </ul>
                                    </div>
                                </div>
                                <!-- Header Top Left Area End Here -->
                                <!-- Begin Header Top Right Area -->
                                <div class="col-lg-9 col-md-8">
                                    <div class="header-top-right">
                                        <ul class="ht-menu">
                                            <!-- Begin Setting Area -->
                                            @auth
                                                <li><a href="/account">My Account</a></li>
                                                <li><a href="/my-orders">My Orders</a></li>
                                                <li><a href="/cart-view">Cart</a></li>
                                                <li><a href="/profile">Profile</a></li>
                                                <li><a href="/logout">Logout</a></li>
                                            @endauth
                                            @guest
                                                <li><a href="/cart-view">Cart</a></li>
                                                <li><a href="/login">Login</a></li>
                                            @endguest
                                            <!-- Setting Area End Here -->
                                        </ul>
                                    </div>
                                </div>
                                <!-- Header Top Right Area End Here -->
                            </div>
                        </div>
                    </div>
                    <!-- Header Top Area End Here -->
                    <!-- Begin Header Middle Area -->
                    <div class="header-middle pl-sm-0 pr-sm-0 pl-xs-0 pr-xs-0">
                        <div class="container">
                            <div class="row">
                                <!-- Begin Header Logo Area -->
                                <div class="col-lg-3">
                                    <div class="logo pb-sm-30 pb-xs-30">
                                        <a href="{{ url('/') }}">
                                            <img src="{{ asset('storage/images/menu/logo/9.png') }}" alt="">
                                        </a>
                                    </div>
                                </div>
                                <!-- Header Logo Area End Here -->
                                <!-- Begin Header Middle Right Area -->
                                <div class="col-lg-9 pl-0 ml-sm-15 ml-xs-15">
                                    <!-- Begin Header Middle Searchbox Area -->
                                    <form id="searchForm" class="hm-searchbox" action="{{ route('search') }}" method="POST" enctype="multipart/form">
                                        @csrf
                                        <select name="category" class="nice-select select-search-category">
                                            <option value="">All</option>
                                            @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @if (!empty($category->sub_categories))
                                                    @foreach ($category->sub_categories as $sub)
                                                    <option value="{{$sub->id}}">- - {{$sub->name}}</option>
                                                    @endforeach
                                                @endif
                                            @endforeach
                                        </select>
                                        <input type="text" id="search" name="search" placeholder="Enter your search key ...">
                                        <button class="li-btn" type="submit"><i class="fa fa-search"></i></button>
                                    </form>
                                    <!-- Header Middle Searchbox Area End Here -->
                                    <!-- Begin Header Middle Right Area -->
                                    <div class="header-middle-right">
                                        <ul class="hm-menu">
                                            <!-- Begin Header Middle Wishlist Area -->
                                            <!-- <li class="hm-wishlist">
                                                <a href="wishlist.html">
                                                    <span class="cart-item-count wishlist-item-count">0</span>
                                                    <i class="fa fa-heart-o"></i>
                                                </a>
                                            </li> -->
                                            <!-- Header Middle Wishlist Area End Here -->
                                            <!-- Begin Header Mini Cart Area -->
                                            <li class="hm-minicart">
                                                <div class="hm-minicart-trigger">
                                                    <span class="item-icon"></span>
                                                    @if (!empty($cart_items))
                                                        <span class="item-text">Rs. {{ $total }}
                                                            <span
                                                                class="cart-item-count">{{ count($cart_items) }}</span>
                                                        @else
                                                            <span class="item-text">Rs. 0.00
                                                                <span class="cart-item-count">0</span>
                                                    @endif
                                                    </span>
                                                </div>
                                                <span></span>
                                                <div class="minicart">
                                                    @if (isset($cart_items) && !empty($cart_items))
                                                        <ul class="minicart-product-list">
                                                            @foreach ($cart_items as $item)
                                                                <li>
                                                                    <a href="" class="minicart-product-image">
                                                                        <img class="minicart-image"
                                                                            src="{{ 'storage/products/' . $item->product->main_image }}"
                                                                            alt="cart products">
                                                                    </a>
                                                                    <div class="minicart-product-details">
                                                                        <h6><a
                                                                                href="single-product.html">{{ $item->product->name }}</a>
                                                                        </h6>
                                                                        <span>{{ $item->product->price }} x
                                                                            {{ $item->qty }}</span>
                                                                    </div>
                                                                    <button class="close" title="Remove">
                                                                        <i class="fa fa-close"></i>
                                                                    </button>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                        <p class="minicart-total">SUBTOTAL: <span>Rs.
                                                                {{ $total }}.00</span></p>
                                                        <div class="minicart-button">
                                                            <a href="{{ url('cart-view') }}"
                                                                class="li-button li-button-fullwidth li-button-dark">
                                                                <span>View Full Cart</span>
                                                            </a>
                                                            <a href="{{ url('checkout-view') }}"
                                                                class="li-button li-button-fullwidth">
                                                                <span>Checkout</span>
                                                            </a>
                                                        </div>
                                                    @else
                                                        <p class="text-center">Empty Cart</p>
                                                    @endif
                                                </div>
                                            </li>
                                            <!-- Header Mini Cart Area End Here -->
                                        </ul>
                                    </div>
                                    <!-- Header Middle Right Area End Here -->
                                </div>
                                <!-- Header Middle Right Area End Here -->
                            </div>
                        </div>
                    </div>
                    <!-- Header Middle Area End Here -->
                    <!-- Begin Header Bottom Area -->
                    <div class="header-bottom header-sticky d-none d-lg-block d-xl-block">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12">
                                    <!-- Begin Header Bottom Menu Area -->
                                    <div class="hb-menu">
                                        <nav>
                                            <ul>
                                                @foreach ($categories as $category)
                                                    <li class="dropdown-holder"><a
                                                            href="{{ url('categories/' . $category->slug) }}">{{ $category->name }}</a>
                                                        @if (count($category->sub_categories) > 0)
                                                            <ul class="hb-dropdown">
                                                                @foreach ($category->sub_categories as $sub_category)
                                                                    <li><a
                                                                            href="{{ url('categories/' . $sub_category->slug) }}">{{ $sub_category->name }}</a>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        @endif
                                                    </li>
                                                @endforeach
                                                <!-- <li class="megamenu-holder"><a href="shop-left-sidebar.html">Shop</a>
                                                    <ul class="megamenu hb-megamenu">
                                                        <li><a href="shop-left-sidebar.html">Shop Page Layout</a>
                                                            <ul>
                                                                <li><a href="shop-3-column.html">Shop 3 Column</a></li>
                                                                <li><a href="shop-4-column.html">Shop 4 Column</a></li>
                                                                <li><a href="shop-left-sidebar.html">Shop Left Sidebar</a></li>
                                                                <li><a href="shop-right-sidebar.html">Shop Right Sidebar</a>
                                                                </li>
                                                                <li><a href="shop-list.html">Shop List</a></li>
                                                                <li><a href="shop-list-left-sidebar.html">Shop List Left
                                                                        Sidebar</a></li>
                                                                <li><a href="shop-list-right-sidebar.html">Shop List Right
                                                                        Sidebar</a></li>
                                                            </ul>
                                                        </li>
                                                        <li><a href="single-product-gallery-left.html">Single Product Style</a>
                                                            <ul>
                                                                <li><a href="single-product-carousel.html">Single Product
                                                                        Carousel</a></li>
                                                                <li><a href="single-product-gallery-left.html">Single Product
                                                                        Gallery Left</a></li>
                                                                <li><a href="single-product-gallery-right.html">Single Product
                                                                        Gallery Right</a></li>
                                                                <li><a href="single-product-tab-style-top.html">Single Product
                                                                        Tab Style Top</a></li>
                                                                <li><a href="single-product-tab-style-left.html">Single Product
                                                                        Tab Style Left</a></li>
                                                                <li><a href="single-product-tab-style-right.html">Single Product
                                                                        Tab Style Right</a></li>
                                                            </ul>
                                                        </li>
                                                        <li><a href="single-product.html">Single Products</a>
                                                            <ul>
                                                                <li><a href="single-product.html">Single Product</a></li>
                                                                <li><a href="single-product-sale.html">Single Product Sale</a>
                                                                </li>
                                                                <li><a href="single-product-group.html">Single Product Group</a>
                                                                </li>
                                                                <li><a href="single-product-normal.html">Single Product
                                                                        Normal</a></li>
                                                                <li><a href="single-product-affiliate.html">Single Product
                                                                        Affiliate</a></li>
                                                            </ul>
                                                        </li>
                                                    </ul>
                                                </li>
                                                <li class="dropdown-holder"><a href="blog-left-sidebar.html">Blog</a>
                                                    <ul class="hb-dropdown">
                                                        <li class="sub-dropdown-holder"><a href="blog-left-sidebar.html">Blog
                                                                Grid View</a>
                                                            <ul class="hb-dropdown hb-sub-dropdown">
                                                                <li><a href="blog-2-column.html">Blog 2 Column</a></li>
                                                                <li><a href="blog-3-column.html">Blog 3 Column</a></li>
                                                                <li><a href="blog-left-sidebar.html">Grid Left Sidebar</a></li>
                                                                <li><a href="blog-right-sidebar.html">Grid Right Sidebar</a>
                                                                </li>
                                                            </ul>
                                                        </li>
                                                        <li class="sub-dropdown-holder"><a href="blog-list-left-sidebar.html">Blog List View</a>
                                                            <ul class="hb-dropdown hb-sub-dropdown">
                                                                <li><a href="blog-list.html">Blog List</a></li>
                                                                <li><a href="blog-list-left-sidebar.html">List Left Sidebar</a>
                                                                </li>
                                                                <li><a href="blog-list-right-sidebar.html">List Right
                                                                        Sidebar</a></li>
                                                            </ul>
                                                        </li>
                                                        <li class="sub-dropdown-holder"><a href="blog-details-left-sidebar.html">Blog Details</a>
                                                            <ul class="hb-dropdown hb-sub-dropdown">
                                                                <li><a href="blog-details-left-sidebar.html">Left Sidebar</a>
                                                                </li>
                                                                <li><a href="blog-details-right-sidebar.html">Right Sidebar</a>
                                                                </li>
                                                            </ul>
                                                        </li>
                                                        <li class="sub-dropdown-holder"><a href="blog-gallery-format.html">Blog
                                                                Format</a>
                                                            <ul class="hb-dropdown hb-sub-dropdown">
                                                                <li><a href="blog-audio-format.html">Blog Audio Format</a></li>
                                                                <li><a href="blog-video-format.html">Blog Video Format</a></li>
                                                                <li><a href="blog-gallery-format.html">Blog Gallery Format</a>
                                                                </li>
                                                            </ul>
                                                        </li>
                                                    </ul>
                                                </li>
                                                <li class="megamenu-static-holder"><a href="index.html">Pages</a>
                                                    <ul class="megamenu hb-megamenu">
                                                        <li><a href="blog-left-sidebar.html">Blog Layouts</a>
                                                            <ul>
                                                                <li><a href="blog-2-column.html">Blog 2 Column</a></li>
                                                                <li><a href="blog-3-column.html">Blog 3 Column</a></li>
                                                                <li><a href="blog-left-sidebar.html">Grid Left Sidebar</a></li>
                                                                <li><a href="blog-right-sidebar.html">Grid Right Sidebar</a>
                                                                </li>
                                                                <li><a href="blog-list.html">Blog List</a></li>
                                                                <li><a href="blog-list-left-sidebar.html">List Left Sidebar</a>
                                                                </li>
                                                                <li><a href="blog-list-right-sidebar.html">List Right
                                                                        Sidebar</a></li>
                                                            </ul>
                                                        </li>
                                                        <li><a href="blog-details-left-sidebar.html">Blog Details Pages</a>
                                                            <ul>
                                                                <li><a href="blog-details-left-sidebar.html">Left Sidebar</a>
                                                                </li>
                                                                <li><a href="blog-details-right-sidebar.html">Right Sidebar</a>
                                                                </li>
                                                                <li><a href="blog-audio-format.html">Blog Audio Format</a></li>
                                                                <li><a href="blog-video-format.html">Blog Video Format</a></li>
                                                                <li><a href="blog-gallery-format.html">Blog Gallery Format</a>
                                                                </li>
                                                            </ul>
                                                        </li>
                                                        <li><a href="index.html">Other Pages</a>
                                                            <ul>
                                                                <li><a href="login-register.html">My Account</a></li>
                                                                <li><a href="checkout.html">Checkout</a></li>
                                                                <li><a href="compare.html">Compare</a></li>
                                                                <li><a href="wishlist.html">Wishlist</a></li>
                                                                <li><a href="shopping-cart.html">Shopping Cart</a></li>
                                                            </ul>
                                                        </li>
                                                        <li><a href="index.html">Other Pages 2</a>
                                                            <ul>
                                                                <li><a href="contact.html">Contact</a></li>
                                                                <li><a href="about-us.html">About Us</a></li>
                                                                <li><a href="faq.html">FAQ</a></li>
                                                                <li><a href="404.html">404 Error</a></li>
                                                            </ul>
                                                        </li>
                                                    </ul>
                                                </li>
                                                <li><a href="about-us.html">About Us</a></li>
                                                <li><a href="contact.html">Contact</a></li>
                                                <li><a href="shop-left-sidebar.html">Smartwatch</a></li>
                                                <li><a href="shop-left-sidebar.html">Accessories</a></li> -->
                                            </ul>
                                        </nav>
                                    </div>
                                    <!-- Header Bottom Menu Area End Here -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Header Bottom Area End Here -->
                    <!-- Begin Mobile Menu Area -->
                    <div class="mobile-menu-area d-lg-none d-xl-none col-12">
                        <div class="container">
                            <div class="row">
                                <div class="mobile-menu">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Mobile Menu Area End Here -->
                </header>
            </div>

            <!-- Header Area End Here -->
            @yield('content')

            <!-- Begin Footer Area -->
            <div class="footer">
                <!-- Begin Footer Static Top Area -->
                <div class="footer-static-top">
                    <div class="container">
                        <!-- Begin Footer Shipping Area -->
                        <div class="footer-shipping pt-60 pb-55 pb-xs-25">
                            <div class="row">
                                <!-- Begin Li's Shipping Inner Box Area -->
                                <div class="col-lg-3 col-md-6 col-sm-6 pb-sm-55 pb-xs-55">
                                    <div class="li-shipping-inner-box">
                                        <div class="shipping-icon">
                                            <img src="{{ asset('storage/images/shipping-icon/1.png') }}"
                                                alt="Shipping Icon">
                                        </div>
                                        <div class="shipping-text">
                                            <h2>Free Delivery</h2>
                                            <p>And free returns. See checkout for delivery dates.</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- Li's Shipping Inner Box Area End Here -->
                                <!-- Begin Li's Shipping Inner Box Area -->
                                <div class="col-lg-3 col-md-6 col-sm-6 pb-sm-55 pb-xs-55">
                                    <div class="li-shipping-inner-box">
                                        <div class="shipping-icon">
                                            <img src="{{ asset('storage/images/shipping-icon/2.png') }}"
                                                alt="Shipping Icon">
                                        </div>
                                        <div class="shipping-text">
                                            <h2>Safe Payment</h2>
                                            <p>Pay with the world's most popular and secure payment methods.</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- Li's Shipping Inner Box Area End Here -->
                                <!-- Begin Li's Shipping Inner Box Area -->
                                <div class="col-lg-3 col-md-6 col-sm-6 pb-xs-30">
                                    <div class="li-shipping-inner-box">
                                        <div class="shipping-icon">
                                            <img src="{{ asset('storage/images/shipping-icon/3.png') }}"
                                                alt="Shipping Icon">
                                        </div>
                                        <div class="shipping-text">
                                            <h2>Shop with Confidence</h2>
                                            <p>Our Buyer Protection covers your purchasefrom click to delivery.</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- Li's Shipping Inner Box Area End Here -->
                                <!-- Begin Li's Shipping Inner Box Area -->
                                <div class="col-lg-3 col-md-6 col-sm-6 pb-xs-30">
                                    <div class="li-shipping-inner-box">
                                        <div class="shipping-icon">
                                            <img src="{{ asset('storage/images/shipping-icon/4.png') }}"
                                                alt="Shipping Icon">
                                        </div>
                                        <div class="shipping-text">
                                            <h2>24/7 Help Center</h2>
                                            <p>Have a question? Call a Specialist or chat online.</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- Li's Shipping Inner Box Area End Here -->
                            </div>
                        </div>
                        <!-- Footer Shipping Area End Here -->
                    </div>
                </div>
                <!-- Footer Static Top Area End Here -->
                <!-- Begin Footer Static Middle Area -->
                <div class="footer-static-middle">
                    <div class="container">
                        <div class="footer-logo-wrap pt-50 pb-35">
                            <div class="row">
                                <!-- Begin Footer Logo Area -->
                                <div class="col-lg-4 col-md-6">
                                    <div class="footer-logo">
                                        <img src="{{ asset('storage/images/menu/logo/10.png') }}" alt="Footer Logo">
                                        <p class="info">
                                            We provide facility to buy resin products and raw materials. Place order and recieve at products at your door step. 
                                        </p>
                                    </div>
                                    <ul class="des">
                                        <li>
                                            <span>Address: </span>
                                            GCU Lahore, PK
                                        </li>
                                        <li>
                                            <span>Phone: </span>
                                            <a href="javascript:void(0)">+92 324 4717137</a>
                                        </li>
                                        <li>
                                            <span>Email: </span>
                                            <a href="mailto://resinelysium@gmail.com">resinelysium@gmail.com</a>
                                        </li>
                                    </ul>
                                </div>
                                <!-- Footer Logo Area End Here -->
                                <!-- Begin Footer Block Area -->
                                <div class="col-lg-2 col-md-3 col-sm-6">
                                    <div class="footer-block">
                                        <h3 class="footer-block-title">Product</h3>
                                        <ul>
                                            <li><a href="#">Prices drop</a></li>
                                            <li><a href="#">New products</a></li>
                                            <li><a href="#">Best sales</a></li>
                                            <li><a href="{{ url('contact-us') }}">Contact us</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- Footer Block Area End Here -->
                                <!-- Begin Footer Block Area -->
                                <div class="col-lg-2 col-md-3 col-sm-6">
                                    <div class="footer-block">
                                        <h3 class="footer-block-title">Our company</h3>
                                        <ul>
                                            <li><a href="#">Delivery</a></li>
                                            <li><a href="#">Legal Notice</a></li>
                                            <li><a href="#">About us</a></li>
                                            <li><a href="{{ url('contact-us') }}">Contact us</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- Footer Block Area End Here -->
                                <!-- Begin Footer Block Area -->
                                <div class="col-lg-4">
                                    <div class="footer-block">
                                        <h3 class="footer-block-title">Follow Us</h3>
                                        <ul class="social-link">
                                            <li class="twitter">
                                                <a href="https://twitter.com/" data-toggle="tooltip" target="_blank"
                                                    title="Twitter">
                                                    <i class="fa fa-twitter"></i>
                                                </a>
                                            </li>
                                            <li class="rss">
                                                <a href="https://rss.com/" data-toggle="tooltip" target="_blank"
                                                    title="RSS">
                                                    <i class="fa fa-rss"></i>
                                                </a>
                                            </li>
                                            <li class="google-plus">
                                                <a href="https://www.plus.google.com/discover" data-toggle="tooltip"
                                                    target="_blank" title="Google Plus">
                                                    <i class="fa fa-google-plus"></i>
                                                </a>
                                            </li>
                                            <li class="facebook">
                                                <a href="https://www.facebook.com/" data-toggle="tooltip"
                                                    target="_blank" title="Facebook">
                                                    <i class="fa fa-facebook"></i>
                                                </a>
                                            </li>
                                            <li class="youtube">
                                                <a href="https://www.youtube.com/" data-toggle="tooltip" target="_blank"
                                                    title="Youtube">
                                                    <i class="fa fa-youtube"></i>
                                                </a>
                                            </li>
                                            <li class="instagram">
                                                <a href="https://www.instagram.com/" data-toggle="tooltip"
                                                    target="_blank" title="Instagram">
                                                    <i class="fa fa-instagram"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <!-- Begin Footer Newsletter Area -->
                                    <div class="footer-newsletter">
                                        <h4>Sign up to newsletter</h4>
                                        <form action="#" method="post" id="mc-embedded-subscribe-form"
                                            name="mc-embedded-subscribe-form" class="footer-subscribe-form validate"
                                            target="_blank" novalidate>
                                            <div id="mc_embed_signup_scroll">
                                                <div id="mc-form" class="mc-form subscribe-form form-group">
                                                    <input id="mc-email" type="email" autocomplete="off"
                                                        placeholder="Enter your email" />
                                                    <button class="btn" id="mc-submit">Subscribe</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- Footer Newsletter Area End Here -->
                                </div>
                                <!-- Footer Block Area End Here -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Footer Static Middle Area End Here -->
            </div>
            <!-- Footer Area End Here -->
        </main>
    </div>

    @notifyJs
    <!-- Body Wrapper End Here -->
    <script src="{{ asset('js/vendor/jquery-1.12.4.min.js') }}"></script>
    <script src="{{ asset('js/vendor/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/ajax-mail.js') }}"></script>
    <script src="{{ asset('js/jquery.meanmenu.min.js') }}"></script>
    <script src="{{ asset('js/wow.min.js') }}"></script>
    <script src="{{ asset('js/slick.min.js') }}"></script>
    <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('js/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('js/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('js/jquery.mixitup.min.js') }}"></script>
    <script src="{{ asset('js/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('js/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('js/waypoints.min.js') }}"></script>
    <script src="{{ asset('js/jquery.barrating.min.js') }}"></script>
    <script src="{{ asset('js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('js/venobox.min.js') }}"></script>
    <script src="{{ asset('js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('js/scrollUp.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
    <script type="text/javascript" src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>
    {{-- chatbot --}}
    <script src="//code.tidio.co/k6rsxlhnnrieqag12dvbkxymbzdqjbek.js" async></script>
</body>

</html>
