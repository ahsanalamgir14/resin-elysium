@extends('layouts.frontend')

@section('content')
<div class="body-wrapper">
     <!-- Begin Li's Breadcrumb Area -->
     <div class="breadcrumb-area">
        <div class="container">
            <div class="breadcrumb-content">
                <ul>
                    <li><a href="index.html">Home</a></li>
                    <li class="active">Search</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Li's Breadcrumb Area End Here -->
    <!-- Begin Li's Content Wraper Area -->
    <div class="content-wraper pt-60 pb-60 pt-sm-30">
        <div class="container">
            <form id="filterForm" name="filterForm" action="{{ route('search') }}" method="POST" enctype="multipart/form">
            @csrf
            </form>
            <div class="row">
                <div class="col-lg-9 order-1 order-lg-2">
                    <!-- Begin Li's Banner Area -->
                    <div class="single-banner shop-page-banner">
                        <a href="#">
                            <img src="{{asset('storage/images/bg-banner/5.jpg')}}" alt="Li's Static Banner">
                        </a>
                    </div>
                    <!-- Li's Banner Area End Here -->
                    <!-- shop-top-bar start -->
                    <div class="shop-top-bar mt-30">
                        <div class="shop-bar-inner">
                            <div class="product-view-mode">
                                <!-- shop-item-filter-list start -->
                                <ul class="nav shop-item-filter-list" role="tablist">
                                    <li class="active" role="presentation"><a aria-selected="true" class="active show" data-toggle="tab" role="tab" aria-controls="grid-view" href="#grid-view"><i class="fa fa-th"></i></a></li>
                                    <li role="presentation"><a data-toggle="tab" role="tab" aria-controls="list-view" href="#list-view"><i class="fa fa-th-list"></i></a></li>
                                </ul>
                                <!-- shop-item-filter-list end -->
                            </div>
                            <div class="toolbar-amount">
                                {{-- <span>Showing {{$products}}</span> --}}
                            </div>
                        </div>
                        <!-- product-select-box start -->
                        <div class="product-select-box">
                            <div class="product-short">
                                <p>Sort By:</p>
                                <select form="filterForm" class="nice-select"  id="sort" name="sort" onchange="applySortBy()">
                                    {{-- <option value="trending">Relevance</option> --}}
                                    <option value="name_asc">Name (A - Z)</option>
                                    <option value="name_desc">Name (Z - A)</option>
                                    <option value="price_asc">Price (Low &gt; High)</option>
                                    <option value="price_desc">Price (High &gt; Low)</option>
                                </select>
                            </div>
                        </div>
                        <!-- product-select-box end -->
                    </div>
                    <!-- shop-top-bar end -->
                    <!-- shop-products-wrapper start -->
                    <div class="shop-products-wrapper">
                        <div class="tab-content">
                            <div id="grid-view" class="tab-pane fade active show" role="tabpanel">
                                <div class="product-area shop-product-area">
                                    <div class="row">
                                        <!-- single-product-wrap start -->
                                        @foreach ($products as $product)
                                        <div class="col-lg-4 col-md-4 col-sm-6 mt-40">
                                            <div class="single-product-wrap">
                                                <div class="product-image">
                                                    <a href="product-view?slug={{$product->slug}}">
                                                        {{-- style="width:100%; height:150px;" --}}
                                                        <img src="{{ asset('storage/products/' . $product->main_image) }}" alt="{{$product->main_image}}">
                                                    </a>
                                                    <span class="sticker">New</span>
                                                </div>
                                                <div class="product_desc">
                                                    <div class="product_desc_info">
                                                        <div class="product-review">
                                                            <h5 class="manufacturer">
                                                                <a href="/categories/{{$product->category->name}}">{{$product->category->name}}</a>
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
                                                        <h4><a class="product_name" href="product-view?slug={{$product->slug}}">{{$product->name}}</a></h4>
                                                        <div class="price-box">
                                                            <span class="new-price">Rs. {{$product->price}}</span>
                                                        </div>
                                                    </div>
                                                    <div class="add-actions">
                                                        <ul class="add-actions-link">
                                                            <li class="add-cart active"><a href="#">Add to cart</a></li>
                                                            <li><a class="links-details" href="wishlist.html"><i class="fa fa-heart-o"></i></a></li>
                                                            <li><a href="#" title="quick view" class="quick-view-btn" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-eye"></i></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                        <!-- single-product-wrap end -->
                                    </div>
                                </div>
                            </div>
                            <div id="list-view" class="tab-pane fade product-list-view" role="tabpanel">
                                <div class="row">
                                    <div class="col">
                                        @foreach ($products as $product)
                                        <div class="row product-layout-list">
                                            <div class="col-lg-3 col-md-5">
                                                <div class="product-image">
                                                    <a href="single-product.html">
                                                        <img src="{{ asset('storage/products/' . $product->main_image) }}" alt="{{$product->main_image}}">
                                                    </a>
                                                    <span class="sticker">New</span>
                                                </div>
                                            </div>
                                            <div class="col-lg-5 col-md-7">
                                                <div class="product_desc">
                                                    <div class="product_desc_info">
                                                        <div class="product-review">
                                                            <h5 class="manufacturer">
                                                                <a href="/categories/{{$product->category->name}}">{{$product->category->name}}</a>
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
                                                        <h4><a class="product_name" href="product-view?slug={{$product->slug}}">{{$product->name}}</a></h4>
                                                        <div class="price-box">
                                                            <span class="new-price">Rs. {{$product->price}}</span>
                                                        </div>
                                                        <p>{{$product->desc}}</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="shop-add-action mb-xs-30">
                                                    <ul class="add-actions-link">
                                                        <li class="add-cart"><a href="#">Add to cart</a></li>
                                                        {{-- <li class="wishlist"><a href="wishlist.html"><i class="fa fa-heart-o"></i>Add to wishlist</a></li> --}}
                                                        <li><a class="quick-view" data-toggle="modal" data-target="#exampleModalCenter" href="#"><i class="fa fa-eye"></i>Quick view</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="paginatoin-area">
                                <div class="row">
                                    <div class="col-md-8 col-md-6 pt-xs-15">
                                        <p>Showing {{$products->firstItem()}}-{{$products->lastItem()}} of {{$products->total()}} product(s)</p>
                                    </div>
                                    <div class="col-md-4 pt-xs-15">
                                        <div class="pagination-box pt-xs-20 pb-xs-15">
                                            {{ $products->render("pagination::bootstrap-4") }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- shop-products-wrapper end -->
                </div>
                <div class="col-lg-3 order-2 order-lg-1">
                    <!--sidebar-categores-box start  -->
                    <div class="sidebar-categores-box mt-sm-30 mt-xs-30">
                        <div class="sidebar-title">
                            <h2>Categories</h2>
                        </div>
                        <!-- category-sub-menu start -->
                        <div class="category-sub-menu">
                            <ul>
                                @foreach ($categories as $category)
                                <li class="has-sub"><a href="javascript:void(0)">{{$category->name}}</a>
                                    <ul>
                                        @foreach ($category->sub_categories as $sub_category)
                                        <li><a href="#">{{$sub_category->name}}</a></li>
                                        @endforeach
                                    </ul>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        <!-- category-sub-menu end -->
                    </div>
                    <!--sidebar-categores-box end  -->
                    <!--sidebar-categores-box start  -->
                    <div class="sidebar-categores-box">
                        <div class="sidebar-title">
                            <h2>Filter By</h2>
                        </div>
                        <!-- btn-clear-all start -->
                        <button class="btn-clear-all mb-sm-30 mb-xs-30">Clear all</button>
                        <!-- btn-clear-all end -->
                        <!-- filter-sub-area start -->
                        {{-- <div class="filter-sub-area">
                            <h5 class="filter-sub-titel">Brand</h5>
                            <div class="categori-checkbox">
                                <form action="#">
                                    <ul>
                                        <li><input type="checkbox" name="product-categori"><a href="#">Prime Video (13)</a></li>
                                        <li><input type="checkbox" name="product-categori"><a href="#">Computers (12)</a></li>
                                        <li><input type="checkbox" name="product-categori"><a href="#">Electronics (11)</a></li>
                                    </ul>
                                </form>
                            </div>
                         </div> --}}
                        <!-- filter-sub-area end -->
                        <!-- filter-sub-area start -->
                        <div class="filter-sub-area pt-sm-10 pt-xs-10">
                            <h5 class="filter-sub-titel">Categories</h5>
                            <div class="categori-checkbox">
                                <form action="#">
                                    <ul>
                                        @foreach ($categories as $category)
                                        <li><input type="checkbox" name="product-categori"><a href="javasvript:void(0)">{{$category->name}}</a></li>
                                        @endforeach
                                    </ul>
                                </form>
                            </div>
                         </div>
                        <!-- filter-sub-area end -->
                        <!-- filter-sub-area start -->
                        {{-- <div class="filter-sub-area pt-sm-10 pt-xs-10">
                            <h5 class="filter-sub-titel">Size</h5>
                            <div class="size-checkbox">
                                <form action="#">
                                    <ul>
                                        <li><input type="checkbox" name="product-size"><a href="#">S (3)</a></li>
                                        <li><input type="checkbox" name="product-size"><a href="#">M (3)</a></li>
                                        <li><input type="checkbox" name="product-size"><a href="#">L (3)</a></li>
                                        <li><input type="checkbox" name="product-size"><a href="#">XL (3)</a></li>
                                    </ul>
                                </form>
                            </div>
                        </div> --}}
                        <!-- filter-sub-area end -->
                        <!-- filter-sub-area start -->
                        {{-- <div class="filter-sub-area pt-sm-10 pt-xs-10">
                            <h5 class="filter-sub-titel">Color</h5>
                            <div class="color-categoriy">
                                <form action="#">
                                    <ul>
                                        <li><span class="white"></span><a href="#">White (1)</a></li>
                                        <li><span class="black"></span><a href="#">Black (1)</a></li>
                                        <li><span class="Orange"></span><a href="#">Orange (3) </a></li>
                                        <li><span class="Blue"></span><a href="#">Blue  (2) </a></li>
                                    </ul>
                                </form>
                            </div>
                        </div> --}}
                        <!-- filter-sub-area end -->
                        <!-- filter-sub-area start -->
                        {{-- <div class="filter-sub-area pt-sm-10 pb-sm-15 pb-xs-15">
                            <h5 class="filter-sub-titel">Dimension</h5>
                            <div class="categori-checkbox">
                                <form action="#">
                                    <ul>
                                        <li><input type="checkbox" name="product-categori"><a href="#">40x60cm (6)</a></li>
                                        <li><input type="checkbox" name="product-categori"><a href="#">60x90cm (6)</a></li>
                                        <li><input type="checkbox" name="product-categori"><a href="#">80x120cm (6)</a></li>
                                    </ul>
                                </form>
                            </div>
                         </div> --}}
                        <!-- filter-sub-area end -->
                        <div class="filter-sub-area pt-sm-10 pt-xs-10 text-right">
                            <a class="links-primary" onclick="applyFilter()">Apply</a>
                        </div>

                    </div>
                    <!--sidebar-categores-box end  -->
                    <!-- category-sub-menu start -->
                    {{-- <div class="sidebar-categores-box mb-sm-0 mb-xs-0">
                        <div class="sidebar-title">
                            <h2>Laptop</h2>
                        </div>
                        <div class="category-tags">
                            <ul>
                                <li><a href="# ">Devita</a></li>
                                <li><a href="# ">Cameras</a></li>
                                <li><a href="# ">Sony</a></li>
                                <li><a href="# ">Computer</a></li>
                                <li><a href="# ">Big Sale</a></li>
                                <li><a href="# ">Accessories</a></li>
                            </ul>
                        </div>
                        <!-- category-sub-menu end -->
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection