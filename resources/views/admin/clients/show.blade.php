@extends('layouts.master')
@section('content')
<!--start page wrapper -->
<div class="page-wrapper">
    <div class="page-content">

        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Customer</div>
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
                            <tr><th>Customer Name</th><td>{!! ucwords($data->client_name)!!}</td></tr>
                            <tr><th>Project Name</th><td>{{$data->project_name}}</td></tr>
                            <tr><th>Team Member</th><td>{{$data->team_member}}</td></tr>
                            <tr><th>Project Award Date</th><td>{{$data->project_award_date}}</td></tr>
                            <tr><th>Total Amount</th><td>{{$data->total_amount}}</td></tr>
                            <tr><th>Project Milestones</th><td>{{$data->project_milestones}}</td></tr>
                            <tr><th>Email Address</th><td>{{$data->email}}</td></tr>
                            <tr><th>Phone Number</th><td>{{$data->client_mobile_number}}</td></tr>
                            <tr><th>Address</th><td>{{$data->client_address}}</td></tr>
                            <!-- <tr><th>password</th> <td><input type="password" value="{{$data->password}}" readonly></td></tr> -->
                            
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!--end page wrapper -->

@endsection
