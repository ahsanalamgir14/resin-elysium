@extends('layouts.default')
@section('title', 'Orders')
@section('orders', 'active')

@section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
    @yield('content')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Orders</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{url('dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item active">Orders</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<section class="content">
    <div class="container-fluid">
        <!-- <button class="btn btn-success mb-3">Add New Order</button> -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Orders Data</h3>
                    </div>
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Order #</th>
                                    <th>User Id</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                    <th>Order Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $order)
                                <tr class='clickable-row' data-href='/admin/manage-orders/{{$order->id}}' role="button">
                                <td>{{$order->id}}</td>
                                <td>{{$order->user_id}}</td>
                                <td>{{$order->first_name}}</td>
                                <td>{{$order->last_name}}</td>
                                <td>{{$order->email}}</td>
                                <td>{{$order->total_amount}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@stop