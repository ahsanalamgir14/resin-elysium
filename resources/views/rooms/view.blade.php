@extends('layouts.default')
@section('title', 'Rooms')
@section('rooms', 'active')

@section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
    @yield('content')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Rooms</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{url('dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item active">Rooms</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
        <div class="row mb-2">
            <div class="col-md-4">
                <button class="btn btn-primary" data-toggle="modal" data-target="#newRoomModal">Add New Room</button>
            </div>
        </div>
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
                        <h3 class="card-title">Rooms Data</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Room#</th>
                                    <th>Room Type</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Rent</th>
                                    <!-- <th>Rent Status</th>
                                    <th>ID card Number</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $room)
                                <tr class='clickable-row' data-href='/rooms/{{$room->id}}' role="button">
                                    <td>{{$room->id}}</td>
                                    <td>{{$room->room_type}}</td>
                                    <td>{{$room->room_holder}}</td>
                                    <td>{{$room->room_owner}}</td>
                                    <td>{{$room->rent}}</td>
                                    <!-- <td>{{$room->id}}</td> -->
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

    </div>
</section>

<!--New Room Modal -->
<div class="modal fade" id="newRoomModal" tabindex="-1" role="dialog" aria-labelledby="newRoomModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New Room</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="save_room_form" enctype="multipart/form-data">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="room#">Room #</label>
                            <input type="text" class="form-control" id="id" name="id" placeholder="E.g B-1, 501">
                        </div>
                        <div class="form-group col-md-4">
                            <label>Select Room Type</label>
                            <select class="form-control" id="room_type" name="room_type">
                                <option value="">choose option</option>
                                <option value="1">Single (Basement)</option>
                                <option value="2">2 Persons (Basement)</option>
                                <option value="3">2+ persons (Basement)</option>
                                <option value="4">Single</option>
                                <option value="5">2 Persons</option>
                                <option value="6">2+ persons</option>
                                <option value="7">VIP Room</option>
                                <option value="8">VIP Flat </option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="rent">Rent</label>
                            <input type="text" class="form-control" id="rent" name="rent" placeholder="E.g 12000/-, 12,000/-">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>Select Floor</label>
                            <select class="form-control" id="floor" name="floor">
                                <option value="">choose option</option>
                                <option value="basement">Basement</option>
                                <option value="ground_floor">Ground Floor</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Room Holder</label>
                            <select class="form-control" id="room_holder" name="room_holder">
                                <option selected>---choose option</option>
                                <option>option 1</option>
                                <option>option 2</option>
                                <option>option 3</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Select Owner</label>
                            <select class="form-control" id="room_owner" name="room_owner">
                                <option selected>---choose option</option>
                                <option>option 1</option>
                                <option>option 2</option>
                                <option>option 3</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Upload Room Images</label>
                                <div class="custom-file">
                                    <input type="file" name="images[]" multiple class="custom-file-input form-control"
                                        id="room_images">
                                    <label class="custom-file-label" for="room_images">Choose Images</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div style="padding-top:20px;" id="preview"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="one_person" name="one_person">
                            <label class="form-check-label" for="one_person">
                                One Person
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="two_person" name="two_person">
                            <label class="form-check-label" for="two_person">
                                Two Persons
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="multiple_person" name="multiple_person">
                            <label class="form-check-label" for="multiple_person">
                                Multiple Persons
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="vip" name="vip">
                            <label class="form-check-label" for="vip">
                                VIP Room
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="one_bed" name="one_bed">
                            <label class="form-check-label" for="one_bed">
                                One Single Bed
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="two_bed" name="two_bed">
                            <label class="form-check-label" for="two_bed">
                                Two Single Beds
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="double_bed" name="double_bed">
                            <label class="form-check-label" for="double_bed">
                                Double Bed
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="one_mattress" name="one_mattress">
                            <label class="form-check-label" for="one_mattress">
                                One Single Mattress
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="two_mattress" name="two_mattress">
                            <label class="form-check-label" for="two_mattress">
                                Two Single Mattress
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="double_mattress" name="double_mattress">
                            <label class="form-check-label" for="double_mattress">
                                Double Mattress
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="attach_washroom" name="attach_washroom">
                            <label class="form-check-label" for="attach_washroom">
                                Attach Washroom
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="combine_washroom"
                                name="combine_washroom">
                            <label class="form-check-label" for="combine_washroom">
                                Combine Floor Washroom
                            </label>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" id="btn_save_room" class="btn btn-primary">Save</button>
            </div>
            </form>
        </div>
    </div>
</div>


@stop
