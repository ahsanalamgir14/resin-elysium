@extends('layouts.default')
@section('title', 'Categories')
@section('categories', 'active')

@section('content')

<section class="content">
    <div class="container-fluid">
        <button onclick="history.back()" class="btn btn-success mb-3 mt-3">Go Back</button>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Add New Category</h3>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Add New Category</h3>
                                </div>
                                <div class="card-body">
                                    <form action="/admin/manage-categories/{{$id}}" method="post" enctype='multipart/form-data'>
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group has-success">
                                            <label for="cat_name" class="control-label mb-1">Category Name</label>
                                            <input id="name" value="{{$name}}" name="name" type="text" class="form-control">
                                            @error('name')
                                            <span class="invalid-feedback d-inline" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="cat_slug" class="control-label mb-1">Category Slug</label>
                                            <input id="slug" value="{{$slug}}" name="slug" type="text" class="form-control">
                                            @error('slug')
                                            <span class="invalid-feedback d-inline" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="parent_id" class="control-label mb-1">Parent Category</label>
                                            <select id="parent_id" value="{{$parent_id}}" name="parent_id" type="text" class="form-control">
                                                <option value="">Select Category</option>
                                                @foreach($categories as $category)
                                                    @if($category->id == $parent_id)
                                                        <option selected value="{{$category->id}}">{{$category->name}}</option>
                                                    @else
                                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="image" class="control-label mb-1">Category Image</label>
                                            <input id="image" value="{{$image}}" name="image" type="file" class="form-control">
                                            @error('image')
                                            <span class="invalid-feedback d-inline" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="is_home" class="control-label mb-1">Is Home</label>
                                            <select id="is_home" name="is_home" type="text" class="form-control">
                                                @if($is_home == '1')
                                                    <option selected value="1">Yes</option>
                                                    <option value="0">No</option>
                                                @else
                                                    <option selected value="0">No</option>
                                                    <option value="1">Yes</option>
                                                @endif
                                            </select>
                                            @error('is_home')
                                            <span class="invalid-feedback d-inline" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="status" class="control-label mb-1">Status</label>
                                            <select id="status" value="{{$status}}" name="status" type="text" class="form-control">
                                                <option value="1">Activate</option>
                                                <option value="0">Deactivate</option>
                                            </select>
                                            @error('status')
                                            <span class="invalid-feedback d-inline" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div>
                                            <button id="submit" type="submit" class="btn btn-success btn-block">
                                                Submit
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@stop