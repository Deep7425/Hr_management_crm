@extends('layouts.master')
@section('content')
<!--start page wrapper -->
<div class="page-wrapper">
    <div class="page-content">

        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">View Profile</div>
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
                            <tr><th>Primary Mobile Number</th><td>{{$data->primary_mobile_number}}</td></tr>
                            @if(isset($secondary_mobile_number))
                            <tr><th>Secondary Mobile Number</th><td>{{$data->secondary_mobile_number}}</td></tr>
                            @endif
                            <tr><th>Years Of Experience</th><td>{{$data->years_of_experience}}</td></tr>
                            <tr><th>Primary Skills</th><td>{{$data->primarySkills}}</td></tr>
                            <tr><th>Secondary Skills</th><td>{{$data->secondarySkills}}</td></tr>
                            <tr><th>Current Company</th><td>{{$data->currentCompany}}</td></tr>
                            <tr><th>CTC</th><td>{{$data->ctc}}</td></tr>

                            <tr><th>ECTC</th><td>{{$data->ectc}}</td></tr>
                            <tr><th>LinkedIn URL</th><td>{{$data->linkedIn_URL}}</td></tr>
                            <tr><th>Notice Period</th><td>{{$data->notice_period}}</td></tr>
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
