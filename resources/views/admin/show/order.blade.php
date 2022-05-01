@extends('layouts.default')
@section('title', 'orders')
@section('orders', 'active')

@section('content')

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4">
                    <button onclick="history.back()" class="btn btn-success mb-3 mt-3">Go Back</button>
                </div>
                <div class="col-md-8">
                    <div class="mt-3 text-right">
                        <button class="btn btn-default" onclick="printDiv('print-order')">
                            <i class="fas fa-print"></i>
                            Print Invoice
                        </button>
                        <button class="btn btn-default ml-2 " onclick="CreatePDFfromHTML({{$id}})">
                            <i class="fas fa-file-download"></i>
                            Download Invoice
                        </button>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Order Details</h3>
                        </div>
                        <div id="print-order" class="card-body pdf-content">
                            <form action="/admin/manage-orders/{{ $id }}" method="post"
                                enctype='multipart/form-data'>
                                @csrf
                                @method('PUT')
                                <div class="">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div>
                                                <label for="id" class="control-label">Order # </label>
                                                <label id="id" class="control-label">{{ $id }}
                                                    [{{ $created_at }}]</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6 text-right">
                                            <label for="id" class="control-label">Order Staus: </label>
                                            <label id="id" class="control-label">{{ $order_status['status'] }}</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="card card-timeline px-2 border-none">
                                            <ul class="bs4-order-tracking">
                                                <li class="step active">
                                                    <div><i class="fas fa-user"></i></div> Order Placed
                                                </li>
                                                <li class="step active">
                                                    <div><i class="fas fa-bread-slice"></i></div> In transit
                                                </li>
                                                <li class="step">
                                                    <div><i class="fas fa-truck"></i></div> Out for delivery
                                                </li>
                                                <li class="step ">
                                                    <div><i class="fas fa-birthday-cake"></i></div> Delivered
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="info-btn pl-0">
                                            <button class="btn disabled-btn">General</button>
                                            <hr>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-12 mb-4">
                                            <h2 class="" style="font-weight: bold">Delivery Information:</h2>
                                        </div>
                                        <div class="row order-details">
                                            <div class="row mb-3">
                                                <div class="col pl-0">
                                                    <h2 style="font-weight: bold">Customer Details</h2>
                                                </div>
                                                <div class="col">
                                                    <h2 style="font-weight: bold">Shipping Details</h2>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <label for="">{{ $user['first_name'] ?? '-' }}</label>
                                                </div>
                                                <div>
                                                    <label for="">{{ $user['last_name'] ?? '-' }}</label>
                                                </div>
                                                <div>
                                                    <label for="">{{ $user['email'] ?? '-' }}</label>
                                                </div>
                                                <div>
                                                    <label for="">{{ $user['mobile'] ?? '-' }}</label>
                                                </div>
                                                <div>
                                                    <label for="">{{ $user['address'] ?? '-' }}</label>
                                                </div>
                                                <div>
                                                    <label for="">{{ $user['city'] ?? '-' }}</label>
                                                </div>
                                                <div>
                                                    <label for="">{{ $user['state'] ?? '-' }}</label>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <label for="">{{ $first_name }}</label>
                                                </div>
                                                <div>
                                                    <label for="">{{ $last_name }}</label>
                                                </div>
                                                <div>
                                                    <label for="">{{ $email }}</label>
                                                </div>
                                                <div>
                                                    <label for="">{{ $mobile }}</label>
                                                </div>
                                                <div>
                                                    <label for="">{{ $address }}</label>
                                                </div>
                                                <div>
                                                    <label for="">{{ $city }}</label>
                                                </div>
                                                <div>
                                                    <label for="">{{ $state }}</label>
                                                </div>
                                                <div>
                                                    <label for="">{{ $payment_type }}</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-4">
                                            <h2 class="" style="font-weight: bold">Products Information:</h2>
                                        </div>
                                        <div class="row">
                                            <table id="example1" class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>Product Name</th>
                                                        <th>SKU</th>
                                                        <th>Price</th>
                                                        <th>Quantity</th>
                                                        <th>Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($order_items as $item)
                                                        <tr class='clickable-row'
                                                            data-href='/admin/manage-orders/{{ $item->id }}'
                                                            role="button">
                                                            <td>{{ $item['product']->name }}</td>
                                                            <td>{{ $item['product']->SKU }}</td>
                                                            <td>Rs. {{ $item->price }}</td>
                                                            <td>{{ $item->qty }}</td>
                                                            <td>Rs. {{ $item->price * $item->qty }}/-</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-4">
                                        <h2 class="" style="font-weight: bold">Summary:</h2>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-8">

                                        <table id="example1" class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Sub Total Name</th>
                                                    <th>Rs. {{ $total_amount }}/-</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Total</td>
                                                    <th>Rs. {{ $total_amount }}/-</th>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-4 text-center">
                                        Barcode space
                                    </div>
                                </div>
                                {{-- <button id="submit" type="submit" class="btn btn-success btn-block">
                                    Submit
                                </button> --}}
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@stop
