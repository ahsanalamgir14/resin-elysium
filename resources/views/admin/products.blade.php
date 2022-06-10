@extends('layouts.default')
@section('title', 'Products')
@section('products', 'active')

@section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
    @yield('content')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Products</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{url('dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item active">Products</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<section class="content">
    <div class="container-fluid">
        <a href="{{url('admin/manage-products/create')}}">
            <button class="btn btn-success mb-3">Add New Product</button>
        </a>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Products Data</h3>
                    </div>
                    <div class="card-body">
                        <table id="example1" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>SKU</th>
                                    <th>Main Image</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $product)
                                <tr class='clickable-row' data-href='/admin/manage-products/{{$product->id}}' role="button">
                                    <td>{{$product->id}}</td>
                                    <td>{{$product->name}}</td>
                                    <td>{{$product->SKU}}</td>
                                    <td class="text-center"> <img src="{{asset('storage/products/'.$product->main_image)}}" alt="{{$product->main_image}}" height="100" width="150px"></td>
                                    <td>{{$product->status}}</td>
                                    <td>
                                        <a href="/admin/manage-products/{{$product->id}}">Edit</a>
                                        <form id="submit_delete" action="{{ route('manage-products.destroy',$product->id)}}" method="POST">
                                            @csrf
                                            @method("DELETE")
                                            <button type="submit" class="btn btn-primary">Delete</button>
                                        </form>
                                    </td>
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