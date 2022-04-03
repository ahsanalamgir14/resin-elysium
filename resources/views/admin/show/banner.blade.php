@extends('layouts.default')
@section('title', 'Banners')
@section('banners', 'active')

@section('content')

<section class="content">
    <div class="container-fluid">
        <button onclick="history.back()" class="btn btn-success mb-3 mt-3">Go Back</button>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Add New Banner</h3>
                    </div>
                    <div class="card-body">
                        <form action="/admin/manage-banners/{{$id}}" method="POST" enctype='multipart/form-data'>
                            @csrf
                            @method('PUT')
                            <div class="form-group has-success">
                                <label for="name" class="control-label mb-1">Banner Name</label>
                                <input id="name" value="{{$name}}" name="name" type="text" class="form-control">
                                @error('name')
                                <span class="invalid-feedback d-inline" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="btn_text" class="control-label mb-1">Button Text</label>
                                <input id="btn_text" value="{{$btn_text}}" name="btn_text" type="text" class="form-control" value="">
                                @error('btn_text')
                                <span class="invalid-feedback d-inline" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="btn_link" class="control-label mb-1">Button Link</label>
                                <input id="btn_link" value="{{$btn_link}}" name="btn_link" type="text" class="form-control" value="">
                                @error('btn_link')
                                <span class="invalid-feedback d-inline" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="status" class="control-label mb-1">Status</label>
                                <select id="status" value="{{$status}}" name="status" type="text" class="form-control">
                                    <option value="">Select Option</option>
                                    @if($status=='1')
                                    <option selected value="1">Yes</option>
                                    <option value="0">No</option>
                                    @elseif($status=='0')
                                    <option value="1">Yes</option>
                                    <option selected value="0">No</option>
                                    @else
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                    @endif
                                </select>
                                @error('status')
                                <span class="invalid-feedback d-inline" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="image" class="control-label mb-1">Banner Image</label>
                                <input id="image" name="image" type="file" class="form-control" value="">
                                @error('image')
                                <span class="invalid-feedback d-inline" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div>
                            <div>
                                <button id="submit" type="submit" class="btn btn-lg btn-info btn-block">
                                    Submit
                                </button>
                            </div>
                            <input type="hidden" name="id" value="{{$id}}">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@stop