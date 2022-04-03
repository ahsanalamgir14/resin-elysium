@extends('layouts.default')
@section('title', 'admins')
@section('admins', 'active')

@section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
    @yield('content')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Admins</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{url('dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item active">Admins</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<section class="content">
    <div class="container-fluid">
        <a href="{{url('admin/manage-admins/create')}}">
            <button class="btn btn-success mb-3">Add New Admin</button>
        </a>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Admins Data</h3>
                    </div>
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                    <!-- <th>Rent</th> -->
                                    <!-- <th>Rent Status</th>
                                    <th>ID card Number</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $customer)
                                <tr class='clickable-row' data-href='/rooms/{{$customer->id}}' role="button">
                                    <td>{{$customer->id}}</td>
                                    <td>{{$customer->first_name}}</td>
                                    <td>{{$customer->last_name}}</td>
                                    <td>{{$customer->email}}</td>
                                    <!-- <td>{{$customer->rent}}</td> -->
                                    <!-- <td>{{$customer->id}}</td> -->
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