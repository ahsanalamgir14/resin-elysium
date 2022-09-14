@extends('layouts.frontend')

@section('content')
<div class="body-wrapper">
    <!-- Begin Li's Breadcrumb Area -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="breadcrumb-content">
                <ul>
                    <li><a href="{{url('home')}}">Home</a></li>
                    <li class="active">My Orders</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Li's Breadcrumb Area End Here -->
    <!--Shopping Cart Area Start-->
    @if(empty($cart_items))
    <div class="Shopping-cart-area pt-60 pb-60">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    @if(count($orders) > 0)
                    <form action="#">
                        <div class="table-content table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="">Order #</th>
                                        {{-- <th class="li-product-thumbnail">Main Image</th> --}}
                                        <th class="li-product-thumbnail">Date</th>
                                        <th class="cart-product-name">Delivery City</th>
                                        <th class="cart-product-name">Delivery To</th>
                                        <th class="">Order Total</th>
                                        <th class="">Status</th>
                                        <th class="">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($orders as $key=>$order)
                                    <tr>
                                        {{-- <td class="li-product-name"><a href="#">{{$order->id}}</a></td> --}}
                                        <td class="li-product-thumbnail cart-image"><a href="#"><img src="{{'storage/products/'.$order['order_items'][$key]->main_image}}" alt="{{$order['order_items'][$key]->main_image}}"></a></td>
                                        <td class=""><span class="amount">{{$order->created_at}}</span></td>
                                        <td class=""><span class="amount">{{$order->city}}</span></td>
                                        <td class=""><span class="" style="font-size:10px;">{{$order->address}}</span></td>
                                        <td class=""><span class="amount">Rs.{{number_format($order->total_amount)}}/-</span></td>
                                        <td class=""><span class="amount">{{$order->payment_status}}</span></td>
                                        <td>
                                            <a href="/order/{{$order->id}}">View Details</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </form>
                    @else
                    <div class="text-center">
                        <h1>You have not placed any order yet. <a href="{{url('home')}}">Go to home</a> to see some exciting deal. </h1>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @else
    <div class="hopping-cart-area pt-60 pb-60">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <p class="text-center">You have placed no order yet. <a href="/">Browse latest products here.</a></p>
                </div>
            </div>
        </div>
    </div>
    @endif
    <!--Shopping Cart Area End-->
</div>

@endsection