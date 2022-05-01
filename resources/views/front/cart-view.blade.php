@extends('layouts.frontend')

@section('content')
<div class="body-wrapper">
    <!-- Begin Li's Breadcrumb Area -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="breadcrumb-content">
                <ul>
                    <li><a href="{{url('home')}}">Home</a></li>
                    <li class="active">Shopping Cart</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Li's Breadcrumb Area End Here -->
    <!--Shopping Cart Area Start-->
    @if(!empty($cart_items))
    <div class="Shopping-cart-area pt-60 pb-60">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <form action="#">
                        <div class="table-content table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="li-product-remove">remove</th>
                                        <th class="li-product-thumbnail">images</th>
                                        <th class="cart-product-name">Product</th>
                                        <th class="li-product-price">Unit Price</th>
                                        <th class="li-product-quantity">Quantity</th>
                                        <th class="li-product-subtotal">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($cart_items as $item)
                                    <tr>
                                        <td class="li-product-remove"><a href="#"><i class="fa fa-times"></i></a></td>
                                        <td class="li-product-thumbnail cart-image"><a href="#"><img src="{{'storage/products/'.$item->product->main_image}}" alt="{{$item->product->main_image}}"></a></td>
                                        <td class="li-product-name"><a href="#">{{$item->product->name}}</a></td>
                                        <td class="li-product-price"><span class="amount">Rs. {{$item->product->price}}</span></td>
                                        <td class="quantity">
                                            <!-- <label>Quantity</label> -->
                                            <div class="cart-plus-minus">
                                                <input class="cart-plus-minus-box" value="{{$item->qty}}" type="text">
                                                <div class="dec qtybutton"><i class="fa fa-angle-down"></i></div>
                                                <div class="inc qtybutton"><i class="fa fa-angle-up"></i></div>
                                            </div>
                                        </td>
                                        <td class="product-subtotal"><span class="amount">Rs. {{number_format($item->qty * $item->product->price)}}/-</span></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- <div class="row">
                            <div class="col-12">
                                <div class="coupon-all">
                                    <div class="coupon">
                                        <input id="coupon_code" class="input-text" name="coupon_code" value="" placeholder="Coupon code" type="text">
                                        <input class="button" name="apply_coupon" value="Apply coupon" type="submit">
                                    </div>
                                    <div class="coupon2">
                                        <input class="button" name="update_cart" value="Update cart" type="submit">
                                    </div>
                                </div>
                            </div>
                        </div> -->
                        <div class="row">
                            <div class="col-md-5 ml-auto">
                                <div class="cart-page-total">
                                    <h2>Cart totals</h2>
                                    <ul>
                                        <li>Subtotal <span>Rs. {{number_format($total)}}/-</span></li>
                                        <li>Total <span>Rs. {{number_format($total)}}/-</span></li>
                                    </ul>
                                    <a href="{{url('checkout-view')}}">Proceed to checkout</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @else
    <div class="hopping-cart-area pt-60 pb-60">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <p class="text-center">Your Cart is Empty. <a href="/">Browse latest products here.</a></p>
                </div>
            </div>
        </div>
    </div>
    @endif
    <!--Shopping Cart Area End-->
</div>

@endsection