@extends('layouts.frontend')

@section('content')
<div class="body-wrapper">
    <!-- Begin Li's Breadcrumb Area -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="breadcrumb-content">
                <ul>
                    <li><a href="{{url('home')}}">Home</a></li>
                    <li><a href="{{url('products')}}">Product</a></li>
                    <li class="active">{{$product->name}}</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Li's Breadcrumb Area End Here -->
    <!-- content-wraper start -->
    <div class="content-wraper">
        <div class="container">
            <div class="row single-product-area">
                <div class="col-lg-5 col-md-6" style="padding-top: 60px;">
                    <!-- Product Details Left -->
                    <div class="product-details-left">
                        <div class="product-details-images slider-navigation-1">
                            <div class="lg-image">
                                <a class="popup-img venobox vbox-item" href="{{ asset('storage/products/' . $product->main_image) }}" data-gall="myGallery">
                                    <img src="{{ asset('storage/products/' . $product->main_image) }}" alt="product image">
                                </a>
                            </div>
                            @foreach ($product->images as $image)
                            <div class="lg-image">
                                <a class="popup-img venobox vbox-item" href="{{ asset('storage/product_images/' . $image) }}" data-gall="myGallery">
                                    <img src="{{ asset('storage/product_images/' . $image) }}" alt="product image">
                                </a>
                            </div>
                            @endforeach
                        </div>
                        <div class="product-details-thumbs slider-thumbs-1">
                            <div class="sm-image"><img src="{{ asset('storage/products/' . $product->main_image)}}" alt="product image thumb"></div>
                            @foreach ($product->images as $image)
                            <div class="sm-image"><img src="{{ asset('storage/product_images/' . $image)}}" alt="product image thumb"></div>

                            @endforeach
                            <!-- <div class="sm-image"><img src="{{ asset('storage/images/product/small-size/1.jpg')}}" alt="product image thumb"></div>
                            <div class="sm-image"><img src="{{ asset('storage/images/product/small-size/2.jpg')}}" alt="product image thumb"></div>
                            <div class="sm-image"><img src="{{ asset('storage/images/product/small-size/3.jpg')}}" alt="product image thumb"></div>
                            <div class="sm-image"><img src="{{ asset('storage/images/product/small-size/4.jpg')}}" alt="product image thumb"></div>
                            <div class="sm-image"><img src="{{ asset('storage/images/product/small-size/5.jpg')}}" alt="product image thumb"></div>
                            <div class="sm-image"><img src="{{ asset('storage/images/product/small-size/6.jpg')}}" alt="product image thumb"></div> -->
                        </div>
                    </div>
                    <!--// Product Details Left -->
                </div>

                <div class="col-lg-7 col-md-6">
                    <div class="product-details-view-content pt-60">
                        <div class="product-info">
                            <h2>{{$product->name}}</h2>
                            <span class="product-details-ref">SKU: product {{$product->SKU}}</span>
                            <div class="rating-box pt-20">
                                <ul class="rating rating-with-review-item">
                                    <li><i class="fa fa-star-o"></i></li>
                                    <li><i class="fa fa-star-o"></i></li>
                                    <li><i class="fa fa-star-o"></i></li>
                                    <li><i class="fa fa-star-o"></i></li>
                                    <li class="no-star"><i class="fa fa-star-o"></i></li>
                                    <!-- <li class="review-item"><a href="#">Read Review</a></li> -->
                                    <!-- <li class="review-item"><a href="#">Write Review</a></li> -->
                                </ul>
                            </div>
                            <div class="price-box pt-20">
                                <span class="new-price new-price-2">Rs. {{$product->price}}</span>
                            </div>
                            <div class="product-desc">
                                <p>
                                    <span>{!! $product->desc !!}</span>
                                    {{-- <span>{!! Str::limit($product->desc, 300, '...') !!}</span> --}}
                                </p>
                            </div>
                            {{-- <div class="product-variants">
                                <div class="produt-variants-size">
                                    <label>Dimension</label>
                                    <select class="nice-select">
                                        <option value="1" title="S" selected="selected">40x60cm</option>
                                        <option value="2" title="M">60x90cm</option>
                                        <option value="3" title="L">80x120cm</option>
                                    </select>
                                </div>
                            </div> --}}
                            <div class="single-add-to-cart">
                                <form id="add-to-cart-form" class="cart-quantity">
                                    <div class="quantity">
                                        <label>Quantity</label>
                                        <div class="cart-plus-minus">
                                            <input class="cart-plus-minus-box" value="1" type="text">
                                            <div class="dec qtybutton product-qtybutton"><i class="fa fa-angle-down"></i></div>
                                            <div class="inc qtybutton product-qtybutton"><i class="fa fa-angle-up"></i></div>
                                        </div>
                                    </div>
                                    @if(!isset($product->quotes))
                                    <button class="add-to-cart" type="button" onclick="add_to_cart(this, {{$product->id}})">Add to cart</button>
                                    @else
                                    <button class="add-to-cart" type="button" onclick="$('#addToCartDetails').modal('show');">Add to Part</button>
                                    @endif
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- content-wraper end -->
    <!-- Begin Product Area -->
    <div class="product-area pt-35">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="li-product-tab">
                        <ul class="nav li-product-menu">
                            <li><a class="active" data-toggle="tab" href="#description"><span>Description</span></a></li>
                            <li><a data-toggle="tab" href="#product-details"><span>Product Details</span></a></li>
                            <li><a data-toggle="tab" href="#reviews"><span>Reviews</span></a></li>
                        </ul>
                    </div>
                    <!-- Begin Li's Tab Menu Content Area -->
                </div>
            </div>
            <div class="tab-content">
                <div id="description" class="tab-pane active show" role="tabpanel">
                    <div class="product-description">
                        <span>{!! $product->desc !!}</span>
                    </div>
                </div>
                <div id="product-details" class="tab-pane" role="tabpanel">
                    <div class="product-details-manufacturer">
                        <a href="#">
                            <img src="{{ asset('storage/images/product-details/1.jpg') }}" alt="Product Manufacturer Image">
                        </a>
                        <p><span>Reference</span> demo_7</p>
                        <p><span>Reference</span> demo_7</p>
                    </div>
                </div>
                <div id="reviews" class="tab-pane" role="tabpanel">
                    <div class="product-reviews">
                        <div class="product-details-comment-block">
                            <div class="comment-review">
                                <span>Grade</span>
                                <ul class="rating">
                                    <li><i class="fa fa-star-o"></i></li>
                                    <li><i class="fa fa-star-o"></i></li>
                                    <li><i class="fa fa-star-o"></i></li>
                                    <li class="no-star"><i class="fa fa-star-o"></i></li>
                                    <li class="no-star"><i class="fa fa-star-o"></i></li>
                                </ul>
                            </div>
                            <div class="comment-author-infos pt-25">
                                <span>HTML 5</span>
                                <em>01-12-18</em>
                            </div>
                            <div class="comment-details">
                                <h4 class="title-block">Demo</h4>
                                <p>Plaza</p>
                            </div>
                            <div class="review-btn">
                                <a class="review-links" href="#" data-toggle="modal" data-target="#mymodal">Write Your Review!</a>
                            </div>
                            <!-- Begin Quick View | Modal Area -->
                            <div class="modal fade modal-wrapper" id="mymodal">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <h3 class="review-page-title">Write Your Review</h3>
                                            <div class="modal-inner-area row">
                                                <div class="col-lg-6">
                                                    <div class="li-review-product">
                                                        <img src="images/product/large-size/3.jpg" alt="Li's Product">
                                                        <div class="li-review-product-desc">
                                                            <p class="li-product-name">Today is a good day Framed poster</p>
                                                            <p>
                                                                <span>Beach Camera Exclusive Bundle - Includes Two Samsung Radiant 360 R3 Wi-Fi Bluetooth Speakers. Fill The Entire Room With Exquisite Sound via Ring Radiator Technology. Stream And Control R3 Speakers Wirelessly With Your Smartphone. Sophisticated, Modern Design </span>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="li-review-content">
                                                        <!-- Begin Feedback Area -->
                                                        <div class="feedback-area">
                                                            <div class="feedback">
                                                                <h3 class="feedback-title">Our Feedback</h3>
                                                                <form action="#">
                                                                    <p class="your-opinion">
                                                                        <label>Your Rating</label>
                                                                        <span>
                                                                            <select class="star-rating">
                                                                                <option value="1">1</option>
                                                                                <option value="2">2</option>
                                                                                <option value="3">3</option>
                                                                                <option value="4">4</option>
                                                                                <option value="5">5</option>
                                                                            </select>
                                                                        </span>
                                                                    </p>
                                                                    <p class="feedback-form">
                                                                        <label for="feedback">Your Review</label>
                                                                        <textarea id="feedback" name="comment" cols="45" rows="8" aria-required="true"></textarea>
                                                                    </p>
                                                                    <div class="feedback-input">
                                                                        <p class="feedback-form-author">
                                                                            <label for="author">Name<span class="required">*</span>
                                                                            </label>
                                                                            <input id="author" name="author" value="" size="30" aria-required="true" type="text">
                                                                        </p>
                                                                        <p class="feedback-form-author feedback-form-email">
                                                                            <label for="email">Email<span class="required">*</span>
                                                                            </label>
                                                                            <input id="email" name="email" value="" size="30" aria-required="true" type="text">
                                                                            <span class="required"><sub>*</sub> Required fields</span>
                                                                        </p>
                                                                        <div class="feedback-btn pb-15">
                                                                            <a href="#" class="close" data-dismiss="modal" aria-label="Close">Close</a>
                                                                            <a href="#">Submit</a>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                        <!-- Feedback Area End Here -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Quick View | Modal Area End Here -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Product Area End Here -->
    <!-- Begin Li's Laptop Product Area -->
    @if(empty($related_products))
    <section class="product-area li-laptop-product pt-30 pb-50">
        <div class="container">
            <div class="row">
                <!-- Begin Li's Section Area -->
                <div class="col-lg-12">
                    <div class="li-section-title">
                        <h2>
                            <span>Other products in the same category:</span>
                        </h2>
                    </div>
                    <div class="row">
                        <div class="product-active owl-carousel">
                            <!-- <div class="col-lg-12"> -->
                            <!-- <div class="card-item-padding"> -->
                            @foreach($related_products as $related_product)
                            <!-- single-product-wrap start -->
                            <div class="single-product-wrap card-item-padding">
                                <div class="product-image">
                                    <a href="product-view?slug={{$product->slug}}">
                                        <img src="{{ asset('storage/products/' . $related_product->main_image) }}" alt="{{$related_product->main_image}}">
                                    </a>
                                    <!-- <span class="sticker">New</span> -->
                                </div>
                                <div class="product_desc">
                                    <div class="product_desc_info">
                                        <div class="product-review">
                                            <h5 class="manufacturer">
                                                <a href="/categories/{{$related_product->category->name}}">{{$related_product->category->name}}</a>
                                            </h5>
                                            <div class="rating-box">
                                                <ul class="rating">
                                                    <li><i class="fa fa-star-o"></i></li>
                                                    <li><i class="fa fa-star-o"></i></li>
                                                    <li><i class="fa fa-star-o"></i></li>
                                                    <li><i class="fa fa-star-o"></i></li>
                                                    <li class="no-star"><i class="fa fa-star-o"></i></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <h4><a class="product_name" href="product-view?slug={{$related_product->slug}}">{{$related_product->name}}</a></h4>
                                        <div class="price-box">
                                            <span class="new-price">Rs. {{$related_product->price}}</span>
                                        </div>
                                    </div>
                                    <div class="add-actions">
                                        <ul class="add-actions-link">
                                            <li class="add-cart active"><a href="#">Add to cart</a></li>
                                            <li><a href="#" title="quick view" class="quick-view-btn" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-eye"></i></a></li>
                                            <li><a class="links-details" href="wishlist.html"><i class="fa fa-heart-o"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            <!-- single-product-wrap end -->
                            <!-- </div> -->
                        </div>
                    </div>
                </div>
                <!-- Li's Section Area End Here -->
            </div>
        </div>
    </section>
    @endif
    <!-- Li's Laptop Product Area End Here -->
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
                                        <img src="images/product/large-size/1.jpg" alt="product image">
                                    </div>
                                    <div class="lg-image">
                                        <img src="images/product/large-size/2.jpg" alt="product image">
                                    </div>
                                    <div class="lg-image">
                                        <img src="images/product/large-size/3.jpg" alt="product image">
                                    </div>
                                    <div class="lg-image">
                                        <img src="images/product/large-size/4.jpg" alt="product image">
                                    </div>
                                    <div class="lg-image">
                                        <img src="images/product/large-size/5.jpg" alt="product image">
                                    </div>
                                    <div class="lg-image">
                                        <img src="images/product/large-size/6.jpg" alt="product image">
                                    </div>
                                </div>
                                <div class="product-details-thumbs slider-thumbs-1">
                                    <div class="sm-image"><img src="images/product/small-size/1.jpg" alt="product image thumb"></div>
                                    <div class="sm-image"><img src="images/product/small-size/2.jpg" alt="product image thumb"></div>
                                    <div class="sm-image"><img src="images/product/small-size/3.jpg" alt="product image thumb"></div>
                                    <div class="sm-image"><img src="images/product/small-size/4.jpg" alt="product image thumb"></div>
                                    <div class="sm-image"><img src="images/product/small-size/5.jpg" alt="product image thumb"></div>
                                    <div class="sm-image"><img src="images/product/small-size/6.jpg" alt="product image thumb"></div>
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
                                            <li><i class="fa fa-star-o"></i></li>
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
                                            <span>100% cotton double printed dress. Black and white striped top and orange high waisted skater skirt bottom. Lorem ipsum dolor sit amet, consectetur adipisicing elit. quibusdam corporis, earum facilis et nostrum dolorum accusamus similique eveniet quia pariatur.
                                            </span>
                                        </p>
                                    </div>
                                    <div class="product-variants">
                                        <div class="produt-variants-size">
                                            <label>Dimension</label>
                                            <select class="nice-select">
                                                <option value="1" title="S" selected="selected">40x60cm</option>
                                                <option value="2" title="M">60x90cm</option>
                                                <option value="3" title="L">80x120cm</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="single-add-to-cart">
                                        <form id="add-to-cart-form" class="cart-quantity">
                                            <div class="quantity">
                                                <label>Quantity</label>
                                                <div class="cart-plus-minus">
                                                    <input id="qty" class="cart-plus-minus-box" value="1" type="text">
                                                    <div class="dec qtybutton"><i class="fa fa-angle-down"></i></div>
                                                    <div class="inc qtybutton"><i class="fa fa-angle-up"></i></div>
                                                </div>
                                            </div>
                                            @if(isset($product->quotes))
                                            <button class="add-to-cart" type="button" onclick="add_to_cart($id)">Add to cart</button>
                                            @else
                                            <button class="add-to-cart" type="button" onclick="$('#addToCartDetails').modal('show');">Add to Phart</button>
                                            @endif
                                        </form>
                                    </div>
                                    <div class="product-additional-info pt-25">
                                        <a class="wishlist-btn" href="wishlist.html"><i class="fa fa-heart-o"></i>Add to wishlist</a>
                                        <div class="product-social-sharing pt-25">
                                            <ul>
                                                <li class="facebook"><a href="#"><i class="fa fa-facebook"></i>Facebook</a></li>
                                                <li class="twitter"><a href="#"><i class="fa fa-twitter"></i>Twitter</a></li>
                                                <li class="google-plus"><a href="#"><i class="fa fa-google-plus"></i>Google +</a></li>
                                                <li class="instagram"><a href="#"><i class="fa fa-instagram"></i>Instagram</a></li>
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
</div>

<div class="modal modal-wrapper" id="addToCartDetails">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="card-title">Add or Review Details</h3>
            </div>
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <div class="row">
                    <div class="col-lg-12">
                        <p>This Product require {{$product->no_of_quotes}} Fields to insert or review. Following quotes will be printed on your Art work.</p>
                    </div>
                </div>
                <div class="row">
                    <input id="no_of_quotes" value="{{$product->no_of_quotes}}" name="no_of_quotes[]" type="hidden">
                    <div class="col-md-12">
                        @if(isset($product->quotes))
                            @foreach ($product->quotes as $key => $quote)
                            <div class="row" id="dynamic-quotes">
                                <div class="col-md-12 form-group">
                                    <label for="quote-{{$key+1}}" class="control-label">Quote {{$key+1}}</label>
                                    <input id="quote" value="{{$quote}}" name="quotes[]" type="text"
                                        class="form-control" >
                                    @error('quote-{{$key+1}}')
                                        <span class="invalid-feedback d-inline" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            @endforeach
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 float-right">
                        <div class="feedback-btn pb-15">
                            <a href="javascript:void(0)" class="add-to-cart" type="button" onclick="add_to_cart(this, {{$product->id}})">Add to cart</a>
                            <a href="#" class="close" data-dismiss="modal" aria-label="Close">Close</a>
                            {{-- <a href="#">Submit</a> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection