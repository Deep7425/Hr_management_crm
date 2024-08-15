@extends('layouts.master')
@section('content')
<!--start page wrapper -->
<div class="page-wrapper">
    <div class="page-content">

        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Employee Manager</div>
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
                    
                                
                        <tr><th>Code</th><td>{!! ucwords($data->employee_code)!!}</td></tr>
                           <tr> <th>Name</th><td>{!! ucwords($data->employee_name)!!}</td></tr>
                            <tr><th> Department</th><td>{{$data->employee_department}}</td></tr>
                            <tr><th>Technology</th><td>{{$data->employee_technology}}</td></tr>
                            <!-- @if(isset($secondary_mobile_number))
                            <tr><th>Secondary Mobile Number</th><td>{{$data->secondary_mobile_number}}</td></tr>
                            @endif -->
                            <tr><th>Primary Contact Number</th><td>{{$data->primary_contact_number}}</td></tr>
                            <tr><th>Date Of Joining</th><td>{{$data->date_of_joining}}</td></tr>
                            <tr><th>Official Email Address</th><td>{{$data->official_email_address}}</td></tr>
                            <tr><th>Personal Email Address</th><td>{{$data->personal_email_address}}</td></tr>
                            <tr><th>Emergency Contact Number</th><td>{{$data->emergency_contact_number}}</td>
                            <tr><th>Date of Birth</th><td>{{$data->date_of_birth}}</td>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!--end page wrapper -->

@endsection
