@extends('layouts.frontend')

@section('content')
    <div class="body-wrapper">
        <!-- Begin Li's Breadcrumb Area -->
        <div class="breadcrumb-area">
            <div class="container">
                <div class="breadcrumb-content">
                    <ul>
                        <li><a href="{{ url('home') }}">Home</a></li>
                        <li class="active">Profile</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- Li's Breadcrumb Area End Here -->
        <!-- Begin Contact Main Page Area -->
        <div class="contact-main-page mt-60 mb-40 mb-md-40 mb-sm-40 mb-xs-40">
            {{-- <div class="container mb-60">
                <div id="google-map"></div>
            </div> --}}
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Update Profile</h3>
                            </div>
                            <div class="card-body">
                                <form id="userUpdateForm" class="form-horizontal" method="post" action='/admin/manage-customers/{{$customer->id}}' enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="col-md-6 form-group">
                                            <label class="control-label">First Name:</label>
                                            <input class="form-control" id="first_name" name="first_name" value="{{$customer->first_name}}" type="text">
                                        </div>
                                        @error('first_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <div class="col-md-6 form-group">
                                            <label class="control-label">Last Name:</label>
                                            <input class="form-control" id="last_name" name="last_name" value="{{$customer->last_name}}" type="text">
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
                                            <input class="form-control" id="email" name="email" value="{{$customer->email}}" type="text">
                                        </div>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <div class="col-md-6 form-group">
                                            <label class="control-label">Role:</label>
                                            <input class="form-control" id="role" name="role" value="{{$customer->role}}" type="text" disabled>
                                        </div>
                                        @error('role')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 form-group">
                                            <label class="control-label">Address:</label>
                                            <input class="form-control" id="address" name="address" value="{{$customer->address}}" type="text">
                                        </div>
                                        @error('address')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <div class="col-md-6 form-group">
                                            <label class="control-label">Phone:</label>
                                            <input class="form-control" id="mobile" name="mobile" value="{{$customer->mobile}}" type="mobile">
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
                                            <select name="country" class="countries form-control" id="selectCountry" onchange="countryChange(this.value)">
                                                <option>--Select Country</option>
                                                @foreach($countries as $country)
                                                @if ($country['code'] == $customer->country)
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
                                            <select name="state" class="states form-control" id="selectState" onchange="stateChange(this.value)">
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
                                            <select name="city" class="cities form-control" id="selectCity">
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
                                            <input class="form-control" id="zip_code" name="zip_code" value="{{$customer->zip_code}}" type="text">
                                        </div>
                                        @error('zip_code')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <input type="hidden" name="role" value="{{$customer->role}}">
                                    <input type="hidden" name="stateCode" id="stateCode" value="{{$customer->state}}">
                                    <input type="hidden" name="cityCode" id="cityCode" value="{{$customer->city}}">
                                    <button class="btn btn-primary text-center" type="submit" id="account_submit">Save Changes</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Contact Main Page Area End Here -->
    </div>
@endsection
