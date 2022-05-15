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
                                <h3 class="card-title mb-0">Change Account Settings: <span>{{$customer->email}}</span></h3>
                            </div>
                            <div class="card-body">
                                <form id="userUpdateForm" class="form-horizontal" method="post" action={{route('change-password')}} enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                       <div class="col-md-6 form-group">
                                            <label class="control-label">Enter New Password:</label>
                                            <input class="form-control" id="password" name="password" value="" type="password">
                                        </div>
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <div class="col-md-6 form-group">
                                            <label class="control-label">Confirm New Password:</label>
                                            <input class="form-control" id="confirm_password" name="confirm_password" value="" type="password">
                                        </div>
                                        @error('confirm_password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <input type="hidden" name="id" value="{{ $customer->id }}"</input>
                                    <button class="btn btn-primary text-center" type="submit">Reset Password</button>
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
