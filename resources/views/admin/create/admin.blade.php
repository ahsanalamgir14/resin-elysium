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
                        <p>form will appear here</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@stop