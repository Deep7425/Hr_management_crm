@extends('layouts.master')
@section('content')
<!--start page wrapper -->
<div class="page-wrapper">
    <div class="page-content">

        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">View Contact Manager</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">View</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->
        <div class="card">
            <div class="card-body">
                <!-- <div class="card-title">
                    <h5 class="mb-0">Available breakpoints</h5>
                </div>
                <hr/> -->
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr><th>Name</th><td>{!! ucwords($data->name)!!}</td></tr>
                            <tr><th>Email</th><td>{{$data->email}}</td></tr>
                            <tr><th>Mobile Number</th><td>{{$data->telephone}}</td></tr>
                            <tr><th>IP Address</th><td>{{$data->ipaddress}}</td></tr>
                            <tr><th>Active Path</th><td>{{$data->activity_path}}</td></tr>
                            <tr><th>Country</th><td>{{$data->country}}</td></tr>
                            <tr><th>Region</th><td>{{$data->region}}</td></tr>
                            <tr><th>City</th><td>{{$data->city}}</td></tr>
                            <tr><th>URL</th><td>{{$data->url}}</td></tr>
                            <tr><th>Message</th><td>{{$data->message}}</td></tr>
                            <tr><th>Created at</th><td>{{$data->created_at}}</td></tr>

                           
                            <!-- <tr><th>Upload Resume</th><td><img src="{{ $data->image }}" class="logo-icon" alt="logo icon"></td></tr> -->
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!--end page wrapper -->

@endsection
