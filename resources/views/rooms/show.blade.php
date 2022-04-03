@extends('layouts.default')
@section('title', 'Room View')
@section('rooms', 'active')

@section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
    @yield('content')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Room View</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{url('dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item active">Rooms</li>
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
                        <h3 class="card-title">Update Room Data</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form id="update_room_form" enctype="multipart/form-data">
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="room#">Room #</label>
                                    <input type="text" class="form-control" id="id" name="id" value={{$id}} placeholder="">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Select Room Type</label>
                                    <select class="form-control" id="room_type" name="room_type" value={{$room_type}}>
                                        <option value=""  @if($room_type == "") ? selected : null  @endif }}>choose option</option>
                                        <option value="1" @if($room_type == "1") ? selected : null @endif }}>Single (Basement)</option>
                                        <option value="2" @if($room_type == "2") ? selected : null @endif }}>2 Persons (Basement)</option>
                                        <option value="3" @if($room_type == "3") ? selected : null @endif }}>2+ persons (Basement)</option>
                                        <option value="4" @if($room_type == "4") ? selected : null @endif }}>Single</option>
                                        <option value="5" @if($room_type == "5") ? selected : null @endif }}>2 Persons</option>
                                        <option value="6" @if($room_type == "6") ? selected : null @endif }}>2+ persons</option>
                                        <option value="7" @if($room_type == "7") ? selected : null @endif }}>VIP Room</option>
                                        <option value="8" @if($room_type == "8") ? selected : null @endif }}>VIP Flat </option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="rent">Rent</label>
                                    <input type="text" class="form-control" id="rent" name="rent" placeholder="E.g 12000/-, 12,000/-" value={{$rent}}>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label>Select Floor</label>
                                    <select class="form-control" id="floor" name="floor">
                                        <option value=""  @if($floor == "") ? selected : null  @endif >choose option</option>
                                        <option value="basement"  @if($floor == "basement") ? selected : null  @endif >Basement</option>
                                        <option value="ground_floor"  @if($floor == "ground_floor") ? selected : null  @endif >Ground Floor</option>
                                        <option value="1"  @if($floor == "1") ? selected : null  @endif >1</option>
                                        <option value="2"  @if($floor == "2") ? selected : null  @endif >2</option>
                                        <option value="3"  @if($floor == "3") ? selected : null  @endif >3</option>
                                        <option value="4"  @if($floor == "4") ? selected : null  @endif >4</option>
                                        <option value="5"  @if($floor == "5") ? selected : null  @endif >5</option>
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
                                            <input type="file" name="images[]" multiple
                                                class="custom-file-input form-control" id="room_images">
                                            <label class="custom-file-label" for="room_images">Choose Images</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div style="padding-top:20px;" id="preview"></div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-8">
                                    @foreach ($images as $image)
                                        <img src="{{ public_path('storage/app/public/Room Images/'.$image)}}" alt="" width="50px" height="50px">
                                    @endforeach
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="one_person" name="one_person" @if($is_one_person == "1") ? checked : null @endif>
                                    <label class="form-check-label" for="one_person">
                                        One Person
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="two_person" name="two_person" @if($is_two_person == "1") ? checked : null @endif>
                                    <label class="form-check-label" for="two_person">
                                        Two Persons
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="multiple_person" name="multiple_person" @if($is_multiple_person == "1") ? checked : null @endif>
                                    <label class="form-check-label" for="multiple_person">
                                        Multiple Persons
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="vip" name="vip" @if($is_vip == "1") ? checked : null @endif>
                                    <label class="form-check-label" for="vip">
                                        VIP Room
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="one_bed" name="one_bed" @if($is_one_bed == "1") ? checked : null @endif>
                                    <label class="form-check-label" for="one_bed">
                                        One Single Bed
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="two_bed" name="two_bed" @if($is_two_bed == "1") ? checked : null @endif>
                                    <label class="form-check-label" for="two_bed">
                                        Two Single Beds
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="double_bed" name="double_bed" @if($is_double_bed == "1") ? checked : null @endif>
                                    <label class="form-check-label" for="double_bed">
                                        Double Bed
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="one_mattress" name="one_mattress" @if($is_one_mattress == "1") ? checked : null @endif>
                                    <label class="form-check-label" for="one_mattress">
                                        One Single Mattress
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="two_mattress" name="two_mattress" @if($is_two_mattress == "1") ? checked : null @endif>
                                    <label class="form-check-label" for="two_mattress">
                                        Two Single Mattress
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="double_mattress" name="double_mattress" @if($is_double_mattress == "1") ? checked : null @endif>
                                    <label class="form-check-label" for="double_mattress">
                                        Double Mattress
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="attach_washroom" name="attach_washroom" @if($is_attach_washroom == "1") ? checked : null @endif>
                                    <label class="form-check-label" for="attach_washroom">
                                        Attach Washroom
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="combine_washroom" name="combine_washroom" @if($is_combine_washroom == "1") ? checked : null @endif>
                                    <label class="form-check-label" for="combine_washroom">
                                        Combine Floor Washroom
                                    </label>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" id="btn_update_room" class="btn btn-primary">Save</button>
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
