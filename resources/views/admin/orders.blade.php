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
                        <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Home</a></li>
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
                    {{-- <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Orders Data</h3>
                        </div>
                        <div class="card-body"> --}}
                            <table id="example1" class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>#Order ID</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Email</th>
                                        <th>Order Total</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $order)
                                        <tr class='clickable-row' data-href='/admin/manage-orders/{{ $order->id }}'
                                            role="button">
                                            <td>{{ $order->id }}</td>
                                            <td>{{ $order->first_name }}</td>
                                            <td>{{ $order->last_name }}</td>
                                            <td>{{ $order->email }}</td>
                                            <td>Rs.{{ number_format($order->total_amount, 2) }}/-</td>
                                            <td id="admin-status" class="admin-status">
                                                <select class="form-select admin-status" name="admin-status" id="admin-status-{{$order->id}}"
                                                    onchange="changeOrderStatus({{ $order->id }})">
                                                    @foreach ($order_status as $status)
                                                        @if ($status->id == $order->order_status->id)
                                                            <option selected value={{ $order->order_status->id }}>{{ $order->order_status->status }}</option>
                                                        @else
                                                            <option value={{ $status->id }}>{{ $status->status }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td class="actions order-actions">
                                                <a class="button" href="/admin/manage-orders/{{ $order->id }}"><i class="fas fa-eye"></i></a>
                                                <form id="submit_delete"
                                                    action="{{ route('manage-orders.destroy', $order->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-primary" type="submit"><i class="fas fa-trash"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        {{-- </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </section>

@stop
