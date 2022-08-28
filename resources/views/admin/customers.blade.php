@extends('layouts.default')
@section('title', 'customers')
@section('customers', 'active')

@section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
    @yield('content')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Customers</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{url('dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item active">Customers</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<section class="content">
    <div class="container-fluid">
        <a href="{{url('admin/manage-customers/create')}}">
            <button class="btn btn-success mb-4">Add New Customer</button>
        </a>
        <div class="row">
            <div class="col-12">
                {{-- <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Customers Data</h3>
                    </div>
                    <div class="card-body"> --}}
                        <table id="example1" class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#ID</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $customer)
                                <tr class='clickable-row' data-href='/admin/manage-customers/{{$customer->id}}' role="button">
                                    <td>{{$customer->id}}</td>
                                    <td>{{$customer->first_name}}</td>
                                    <td>{{$customer->last_name}}</td>
                                    <td>{{$customer->email}}</td>
                                    <td class="actions order-actions">
                                        <a class="button" href="/admin/manage-customers/{{ $customer->id }}"><i class="fas fa-edit"></i></a>
                                        <form id="submit_delete"
                                            action="{{ route('manage-customers.destroy', $customer->id) }}"
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