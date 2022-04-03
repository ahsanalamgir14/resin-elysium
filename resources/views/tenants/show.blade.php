@extends('layouts.default')
@section('title', 'Tenants View')
@section('tenants', 'active')

@section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
    @yield('content')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Tenants View</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{url('dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item active">Tenants</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Update Tenants Data</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form id="update_tenant_form" enctype="multipart/form-data">
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="room#">Room#</label>
                                    <select class="form-control" id="room_id" name="room_id">
                                        <option value="">choose option</option>
                                    @foreach ($rooms as $room)
                                        <option value="{{$room_id}}">{{$room_id}}</option>
                                    @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="room#">First Name</label>
                                    <input type="text" class="form-control" id="first_name" name="first_name" value="{{$user['first_name']}}" placeholder="E.g Ahsan">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="room#">Last Name</label>
                                    <input type="text" class="form-control" id="last_name" name="last_name" value="{{$user['last_name']}}" placeholder="E.g Alamgir">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="room#">CNIC</label>
                                    <input type="text" class="form-control" id="cnic" name="cnic" value="{{$user['cnic']}}" placeholder="E.g 35202-5968523-2">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="room#">Email</label>
                                    <input type="text" class="form-control" id="email" name="email" value="{{$user['email']}}" placeholder="E.g someone@gmail.com">
                                </div>    
                                <div class="form-group col-md-4">
                                    <label for="room#">City</label>
                                    <input type="text" class="form-control" id="city" name="city" value="{{$user['city']}}" placeholder="E.g Lahore">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="room#">State</label>
                                    <input type="text" class="form-control" id="state" name="state" value="{{$user['state']}}" placeholder="E.g Punjab">
                                </div>
                                <div class="form-group col-md-8">
                                    <label for="room#">Address</label>
                                    <input type="text" class="form-control" id="address" name="address" value="{{$user['address']}}" placeholder="E.g House # ..., Street # ...">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="">Shared With</label>
                                    <input type="text" class="form-control" id="shared_with" value="{{$shared_with}}" name="shared_with" placeholder="">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="">Old Room</label>
                                    <input type="text" class="form-control" id="old_room" value="{{$old_room}}" name="old_room" placeholder="E.g 405, B-2" disabled>
                                </div>
                                @if(isset($shifting_date))
                                <div class="form-group col-md-4">
                                    <label for="">Shifting Date</label>
                                    <div class="input-group date" id="shifting_date" value="{{$shifting_date}}" data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input" data-target="#shifting_date" name="shifting_date" id="shifting_date">
                                        <div class="input-group-append" data-target="#shifting_date" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                <div class="form-group col-md-4">
                                    <label for="">Joining Date</label>
                                    <div class="input-group date" id="joining_date" value="{{$joining_date}}" data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input" data-target="#joining_date" name="joining_date" id="joining_date">
                                        <div class="input-group-append" data-target="#joining_date" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="has_noticed" name="has_noticed" @if($has_noticed == "1") ? checked : null @endif>
                                    <label class="form-check-label" for="has_noticed">
                                        Noticed to leave
                                    </label>
                                </div>
                            </div>
                            <input type="hidden" id="id" name="id" value={{$id}}>
                            <div class="modal-footer">
                                <button type="submit" id="btn_update_tenant" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</section>

@stop
