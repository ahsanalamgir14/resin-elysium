@extends('layouts.default')
@section('title', 'banners')
@section('banners', 'active')

@section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
    @yield('content')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Home Banners</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{url('dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item active">Home Banners</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<section class="content">
    <div class="container-fluid">
        <a href="{{url('admin/manage-banners/create')}}">
            <button class="btn btn-success mb-4">Add New Banner</button>
        </a>
        <div class="row">
            <div class="col-12">
                {{-- <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Banners Data</h3>
                    </div>
                    <div class="card-body"> --}}
                        <table id="example1" class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#ID</th>
                                    <th>Name</th>
                                    <th>Text</th>
                                    <th>Link</th>
                                    <th>Image</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $banner)
                                <tr class='clickable-row' data-href='manage-banners/{{$banner->id}}' role="button">
                                    <td>{{$banner->id}}</td>
                                    <td>{{$banner->name}}</td>
                                    <td>{{$banner->btn_text}}</td>
                                    <td>{{$banner->btn_link}}</td>
                                    <td class="text-center"> <img src="{{asset('storage/banners/'.$banner->image)}}" alt="{{$banner->image}}" height="150" width="200px"></td>
                                    <td>{{$banner->status}}</td>
                                    <td class="actions">
                                        <a class="button" href="/admin/manage-banners/{{ $banner->id }}"><i class="fas fa-edit"></i></a>
                                        <form id="submit_delete"
                                            action="{{ route('manage-banners.destroy', $banner->id) }}"
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