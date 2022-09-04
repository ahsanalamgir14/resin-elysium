@extends('layouts.default')
@section('title', 'Categories')
@section('categories', 'active')

@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
        @yield('content')
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <a href="{{ url('admin/manage-categories/create') }}">
                        <button class="btn btn-success mb-4">Add New Category</button>
                    </a>
                    {{-- <h1 class="m-0">Categories</h1> --}}
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Categories</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Categories Data</h3>
                    </div>
                    <div class="card-body">
                    <table id="example1" class="table table-hover">
                        <thead>
                            <tr>
                                <th>#ID</th>
                                <th>Parent Id</th>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Image</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $category)
                                <tr class='clickable-row' data-href='/admin/manage-categories/{{ $category->id }}'
                                    role="button">
                                    <td>{{ $category->id }}</td>
                                    <td>{{ $category->parent_id }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->slug }}</td>
                                    <td class="text-center"> <img
                                            src="{{ asset('storage/categories/' . $category->image) }}"
                                            alt="{{ $category->image }}" height="150" width="200px"></td>
                                    <td>{{ $category->status }}</td>
                                    <td class="actions">
                                        <a class="button" href="/admin/manage-categories/{{ $category->id }}"><i class="fas fa-edit"></i></a>
                                        <form id="submit_delete"
                                            action="{{ route('manage-categories.destroy', $category->id) }}"
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
                    </div>
                </div>
                </div>
            </div>
        </div>
    </section>

@stop
