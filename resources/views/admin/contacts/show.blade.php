@extends('layouts.master')
@section('content')
<!--start page wrapper -->
<style>
    img, svg {
  vertical-align: middle;
  width: 50px;
}
    </style>
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
                            @if(isset($data->name))
                            <tr><th>Name</th><td>{!! ucwords($data->name)!!}</td></tr>
                            @endif
                            @if(isset($data->project_title))
                            <tr><th>Project Title</th><td>{{$data->project_title}}</td></tr>
                            @endif
                            @if(isset($data->lead_source))
                            <tr><th>Lead Source</th><td>{{$data->lead_source}}</td></tr>
                            @endif
                            @if(isset($data->email))
                            <tr><th>Email</th><td><a href="mailto:{{$data->email}}" target="_blank" >{{$data->email}}</a></td></tr>
                            @endif
                            @if(isset($data->second_email))
                            <tr><th>Secondory Email</th><td><a href="mailto:{{$data->second_email}}" target="_blank" >{{$data->second_email}}</a></td></tr>
                            @endif
                            @if(isset($data->mobile_number))
                            <tr><th>Mobile Number</th><td><a href="https://wa.me/{{$data->mobile_number}}" target="_blank">{{$data->mobile_number}}</a></td></tr>
                            @endif
                            @if(isset($data->second_phone_number))
                            <tr><th>Secondory Mobile Number</th><td><a href="https://wa.me/{{$data->second_phone_number}}" target="_blank">{{$data->second_phone_number}}</a></td></tr>
                            @endif
                            @if(isset($data->primary_country))
                            <tr><th>Country</th><td>{{$data->primary_country}}</td></tr>
                            @endif
                            @if(isset($data->secondary_country) && !empty($data->secondary_country))
                            <tr><th>Secondary Location</th><td>{{$data->secondary_country}}</td></tr>
                            @endif
                            @if(isset($data->requirements))
                            <tr><th>Requirements</th><td>{{$data->requirements}}</td></tr>
                            @endif
                            @if(isset($data->source))
                            <tr><th>Source</th><td>{{ $data->source }}</td></tr>
                            @endif
                            @if(isset($data->up_link))
                            <tr><th>Link</th><td>{{ $data->up_link }}</td></tr>
                            @endif
                            @if(isset($data->ba_credit))
                            <tr><th>Credit</th><td>{{ $data->ba_credit }}</td></tr>
                            @endif
                            @if(isset($data->ba_screenshot))
                            <tr><th>Screenshot</th><td><img src="{{ $data->ba_screenshot }}" width="50" height="50"></td></tr>
                            @endif
                            @if(isset($data->other_name))
                            <tr><th>Name</th><td>{{ $data->other_name }}</td></tr>
                            @endif
                            @if(isset($data->new_project_title))
                            <tr><th>Project title</th><td>{{ $data->new_project_title }}</td></tr>
                            @endif
                            @if(isset($data->linkedIn_url))
                            <tr><th>LinkedIn URL</th><td><a href="{{ $data->linkedIn_url }}" target="_blank">{{ $data->linkedIn_url }}</a></td></tr>
                            @endif
                            <!-- @if(isset($data->linkedIn_url))
                            <tr><th>linkedIn URL</th><td><a href="{{$data->linkedIn_url}}" target="_blank">{{$data->linkedIn_url}}</a></td></tr>
                            @endif
                            @if(isset($data->up_url))
                            <tr><th>UP URL</th><td><a href="{{$data->up_url}}" target="_blank">{{$data->up_url}}</a></td></tr>
                            @endif
                            @if(isset($data->bark_url))
                            <tr><th>Bark URL </th><td><a href="{{$data->bark_url}}" target="_blank">{{$data->bark_url}}</a></td></tr>
                            @endif -->
                            @if(isset($data->image))
                            <tr><th>Upload File</th><td><a href="{{ $data->image }}" target="_blank"><img class="image" src="{{ url('images/download.jpg') }}"/></a></td></tr>
                            @endif
                            @if(isset($data->created_at))
                            <tr><th>created at</th><td>{{$data->created_at}}</td></tr>
                            @endif
                            
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!--end page wrapper -->

@endsection
