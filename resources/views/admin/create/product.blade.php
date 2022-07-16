@extends('layouts.default')
@section('title', 'products')
@section('products', 'active')

@section('content')

<section class="content">
    <div class="container-fluid">
        <button onclick="history.back()" class="btn btn-success mb-3 mt-3">Go Back</button>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Add New Product</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{url('admin/manage-products')}}" method="post" enctype='multipart/form-data'>
                            @csrf
                            <div class="">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group has-success">
                                            <label for="name" class="control-label">Product Name</label>
                                            <input id="name" value="" name="name" type="text" class="form-control">
                                            @error('name')
                                            <span class="invalid-feedback d-inline" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="main_image" class="control-label">Main Image</label>
                                            <input id="main_image" value="" name="main_image" type="file" class="form-control">
                                            @error('main_image')
                                            <span class="invalid-feedback d-inline" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label for="category_id" class="control-label">Category</label>
                                        <select id="category_id" name="category_id" type="text" class="form-control">
                                            <option value="">Select Category</option>
                                            @foreach($categories as $category)
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                        <span class="invalid-feedback d-inline" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="slug" class="control-label">Product Slug</label>
                                        <input id="slug" value="" name="slug" type="text" class="form-control" value="">
                                        @error('slug')
                                        <span class="invalid-feedback d-inline" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label for="type" class="control-label">Product Type </label>
                                        <input id="type" value="" name="type" type="text" class="form-control" value="">
                                        @error('type')
                                        <span class="invalid-feedback d-inline" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="SKU" class="control-label">Product SKU</label>
                                        <input id="SKU" value="" name="SKU" type="text" class="form-control">
                                        @error('SKU')
                                        <span class="invalid-feedback d-inline" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label for="price" class="control-label">Product Price</label>
                                        <input id="price" value="" name="price" type="text" class="form-control" value="">
                                        @error('price')
                                        <span class="invalid-feedback d-inline" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="qty" class="control-label">Available Quantity</label>
                                        <input id="qty" value="" name="qty" type="text" class="form-control" value="">
                                        @error('qty')
                                        <span class="invalid-feedback d-inline" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label for="3d_model" class="control-label">3d Image Link</label>
                                        <input id="3d_model" value="" name="3d_model" type="text" class="form-control" value="">
                                        @error('3d_model')
                                        <span class="invalid-feedback d-inline" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="status" class="control-label">Status</label>
                                        <select id="status" value="" name="status" type="text" class="form-control">
                                            <option value="1">Activate</option>
                                            <option value="0">Deactivate</option>
                                        </select>
                                        @error('status')
                                        <span class="invalid-feedback d-inline" role="alert">
                                            <strong>{{$message}}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label for="is_trending" class="control-label">Is Trending?</label>
                                        <select id="is_trending" value="" name="is_trending" type="text" class="form-control">
                                            <option value="0">No</option>
                                            <option value="1">Yes</option>
                                        </select>
                                        @error('is_trending')
                                        <span class="invalid-feedback d-inline" role="alert">
                                            <strong>{{$message}}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="is_best_seller" class="control-label">Is Best Seller?</label>
                                        <select id="is_best_seller" value="" name="is_best_seller" type="text" class="form-control">
                                            <option value="0">No</option>
                                            <option value="1">Yes</option>
                                        </select>
                                        @error('is_best_seller')
                                        <span class="invalid-feedback d-inline" role="alert">
                                            <strong>{{$message}}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        <label for="desc" class="control-label">Description</label>
                                        <textarea id="summernote" value="" name="desc" type="text" class="form-control"></textarea>
                                        @error('desc')
                                        <span class="invalid-feedback d-inline" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <h2>Add More Product Images</h2>
                                    <small class="mt-3 ml-2">You can add more product images by selecting the images from following button.</small>
                                </div>
                                <div class="images_class" id="main_images">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="input-group form-group increment">
                                                <input id="images" name="images[]" type="file" class="form-control" value="" multiple>
                                            </div>
                                            @error('images')
                                            <div class="alert alert-danger">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="image-container d-flex justify-content-center position-relative">
                                            <div class="input-images">

                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <button id="submit" type="submit" class="btn btn-success btn-block">
                                Submit
                            </button>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@stop