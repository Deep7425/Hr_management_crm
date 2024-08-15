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
                            <tr><th>Task Name</th><td>{!! ucwords($data->task_name)!!}</td></tr>
                            <tr><th>feature list one</th><td>{{$data->feature_list_one}}</td></tr>
                            <tr><th>feature list two</th><td>{{$data->feature_list_two}}</td></tr>
                            <tr><th>feature list three</th><td>{{$data->feature_list_three}}</td></tr>
                            <tr><th>feature list four</th><td>{{$data->feature_list_four}}</td></tr>
                            <tr><th>SRS</th><td>{{$data->srs}}</td></tr>
                            <tr><th>Test Cases</th><td>{{$data->test_cases}}</td></tr>
                          
                           
                            <tr><th>Upload Image</th><td><img src="{{ $data->image }}" class="logo-icon" alt="logo icon"></td></tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!--end page wrapper -->

@endsection
