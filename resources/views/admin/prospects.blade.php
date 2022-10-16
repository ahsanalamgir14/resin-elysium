@extends('layouts.default')
@section('title', 'Prospects')
@section('prospects', 'active')

@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
        @yield('content')
        <div class="container-fluid">
            <div class="row">
                {{-- <div class="col-sm-6">
                    <a href="{{ url('admin/manage-categories/create') }}">
                        <button class="btn btn-success mb-4">Add New prospect</button>
                    </a>
                </div> --}}
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Prospects</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Prospects Data</h3>
                        </div>
                        <div class="card-body">
                            <table id="example1" class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>#ID</th>
                                        <th>UID</th>
                                        <th>FName</th>
                                        <th>Email</th>
                                        <th>Mobile</th>
                                        <th>LV</th>
                                        <th>#Pr</th>
                                        <th>IP</th>
                                        <th>City</th>
                                        <th>Country</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $prospect)
                                    {{-- class='clickable-row' data-href='/admin/manage-prospects/{{ $prospect->id }}'
                                            role="button" --}}
                                        <tr>
                                            <td>{{ $prospect->id }}</td>
                                            <td>{{ $prospect->user_id }}</td>
                                            <td>{{ $prospect->first_name }}</td>
                                            <td>{{ $prospect->email }}</td>
                                            <td>{{ $prospect->mobile }}</td>
                                            <td>{{ $prospect->last_visited }}</td>
                                            <td>{{ count($prospect->products) }}</td>
                                            <td>{{ $prospect->ip }}</td>
                                            <td class="text-center"> {{ $prospect->ip_details['city'] }}</td>
                                            <td class="text-center"> {{ $prospect->ip_details['country'] }}</td>
                                            <td class="actions">
                                                <a class="button" href="/admin/manage-prospects/{{ $prospect->id }}"><i
                                                        class="fas fa-edit"></i></a>
                                                <form id="submit_delete"
                                                    action="{{ route('manage-prospects.destroy', $prospect->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-primary" type="submit"><i
                                                            class="fas fa-trash"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@stop
