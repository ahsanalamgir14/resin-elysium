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
                        <h3 class="card-title">Add new Admin</h3>
                    </div>
                    <div class="card-body">
                        <form id="userRegForm" class="form-horizontal" method="post" action={{ route('user-registration')}} enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label class="control-label">First Name:</label>
                                    <input class="form-control" id="first_name" name="first_name" type="text" value="">
                                    @error('first_name')
                                        <span class="invalid-feed" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-6 form-group">
                                    <label class="control-label">Last Name:</label>
                                    <input class="form-control" id="last_name" name="last_name" type="text" value="">
                                    @error('last_name')
                                        <span class="invalid-feed" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label class="control-label">Email:</label>
                                    <input class="form-control" id="email" name="email" type="text" value="">
                                    @error('email')
                                        <span class="invalid-feed" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-6 form-group">
                                    <label class="control-label">Password:</label>
                                    <input class="form-control" id="password" name="password" type="password" value="">
                                    @error('password')
                                        <span class="invalid-feed" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label class="control-label">Address:</label>
                                    <input class="form-control" id="address" name="address" type="text" value="">
                                    @error('address')
                                        <span class="invalid-feed" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-6 form-group">
                                    <label class="control-label">Phone:</label>
                                    <input class="form-control" id="mobile" name="mobile" type="mobile" value="">
                                    @error('phone')
                                        <span class="invalid-feed" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label class="control-label">Country:</label>
                                    <select name="country" class="countries form-control" id="countryId" onchange="countryChange(this.value)">
                                        <option value="">--Select Country</option>
                                        @foreach($countries as $country)
                                        <option value="{{$country['code']}}">{{$country['name']}}</option>
                                        @endforeach
                                    </select>
                                    @error('country')
                                        <span class="invalid-feed" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                  </div>
                                <div class="col-md-6 form-group">
                                    <label class="control-label">State:</label>
                                    <select name="state" class="states form-control" id="selectState" onchange="stateChange(this.value)">
                                    <option value="">--Please Select Country First</option>
                                    </select>
                                    @error('state')
                                        <span class="invalid-feed" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label class="control-label">City:</label>
                                    <select name="city" class="cities form-control" id="selectCity">
                                      <option value="">--Please Select State First</option>
                                    </select>
                                    @error('city')
                                        <span class="invalid-feed" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-6 form-group">
                                    <label class="control-label">Zip Code:</label>
                                    <input class="form-control" id="zip_code" name="zip_code" type="text" value="">
                                    @error('zip_code')
                                        <span class="invalid-feed" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <input type="hidden" name="role" value="admin">
                            <button class="btn btn-primary text-center" type="submit" id="account_submit">Save Changes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@stop