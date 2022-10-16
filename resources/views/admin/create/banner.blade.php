@extends('layouts.default')
@section('title', 'Add Banner')
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
                        <form action="{{url('admin/manage-banners')}}" method="post" enctype='multipart/form-data'>
                            @csrf
                            <div class="form-group has-success">
                                <label for="name" class="control-label">Banner Name</label>
                                <input id="name" value="" name="name" type="text" class="form-control">
                                @error('name')
                                <span class="invalid-feed" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="btn_text" class="control-label">Button Text</label>
                                <input id="btn_text" value="" name="btn_text" type="text" class="form-control" value="">
                                @error('btn_text')
                                <span class="invalid-feed" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="btn_link" class="control-label">Button Link</label>
                                <input id="btn_link" value="" name="btn_link" type="text" class="form-control" value="">
                                @error('btn_link')
                                <span class="invalid-feed" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="status" class="control-label">Status</label>
                                <select id="status" value="" name="status" type="text" class="form-control">
                                    <option value="1">Activate</option>
                                    <option value="0">Deactivate</option>
                                </select>
                                @error('status')
                                <span class="invalid-feed" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="image" class="control-label">Banner Image</label>
                                <input id="image" name="image" type="file" class="form-control" value="">
                                @error('image')
                                <span class="invalid-feed" role="alert">
                                    <strong>{{$message}}</strong>
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
</section>

@stop