@extends('layouts.default')
@section('title', 'admins')
@section('admins', 'active')

@section('content')

<section class="content">
    <div class="container-fluid">
        <button onclick="history.back()" class="btn btn-success mb-3 mt-3">Go Back</button>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Update Admin</h3>
                    </div>    
                    <div class="card-body">
                        <form id="adminUpdateForm" class="form-horizontal" method="post" action='/admin/manage-admins/{{$admin->id}}' enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label class="control-label">First Name:</label>
                                    <input class="form-control" id="first_name" name="first_name" value="{{$admin->first_name}}" type="text">
                                </div>
                                @error('first_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <div class="col-md-6 form-group">
                                    <label class="control-label">Last Name:</label>
                                    <input class="form-control" id="last_name" name="last_name" value="{{$admin->last_name}}" type="text">
                                </div>
                                @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label class="control-label">Email:</label>
                                    <input class="form-control" id="email" name="email" value="{{$admin->email}}" type="text">
                                </div>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <div class="col-md-6 form-group">
                                    <label class="control-label">Password:</label>
                                    <input class="form-control" id="password" name="password" value="" placeholder="Admin can assign new Password" type="password">
                                </div>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label class="control-label">Address:</label>
                                    <input class="form-control" id="address" name="address" value="{{$admin->address}}" type="text">
                                </div>
                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <div class="col-md-6 form-group">
                                    <label class="control-label">Phone:</label>
                                    <input class="form-control" id="mobile" name="mobile" value="{{$admin->mobile}}" type="mobile">
                                </div>
                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label class="control-label">Country:</label>
                                    <select name="country" class="countries form-control" id="countryId" value="{{$admin->country}}" onchange="countryChange(this.value)">
                                        <option>--Select Country</option>
                                        @foreach($countries as $country)
                                        @if ($country['code'] == $admin->country)
                                            <option value="{{$country['code']}}" selected>{{$country['name']}}</option>
                                        @else
                                            <option value="{{$country['code']}}">{{$country['name']}}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                                @error('country')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <div class="col-md-6 form-group">
                                    <label class="control-label">State:</label>
                                    <select name="state" class="states form-control" id="selectState" value="{{$admin->state}}" onchange="stateChange(this.value)">
                                    <option>--Please Select Country First</option>
                                    </select>
                                </div>
                                @error('state')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label class="control-label">City:</label>
                                    <select name="city" class="cities form-control" value="{{$admin->city}}" id="selectCity">
                                    <option>--Please Select State First</option>
                                    </select>
                                </div>
                                @error('city')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <div class="col-md-6 form-group">
                                    <label class="control-label">Zip Code:</label>
                                    <input class="form-control" id="zip_code" name="zip_code" value="{{$admin->zip_code}}" type="text">
                                </div>
                                @error('zip_code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <input type="hidden" name="role" value="admin">
                            <button class="btn btn-primary text-center" type="submit">Save Changes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@stop