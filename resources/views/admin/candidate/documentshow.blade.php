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
                            <tr><th>Aadhar Card</th><td>{!! ucwords($data->aadhar_card)!!}</td></tr>
                            <tr><th>Pan Card</th><td>{{$data->pan_card}}</td></tr>
                            <tr><th>Bank Account Number</th><td>{{$data->bank_account_number}}</td></tr>
                            <tr><th>Bank IFSC Code</th><td>{{$data->bank_IFSC_code}}</td></tr>
                            <tr><th>Bank Name</th><td>{{$data->bank_name}}</td></tr>
                            @if($data->image)
                            <tr><th>BrowserImage</th><td><img src="{{ URL::asset($data->image)}}" class="logo-icon" alt="logo icon"></td></tr>
                            @endif
                            @if($data->aadhar_card_image)
                            <tr><th>Aadhar Card Image</th><td><img src="{{ URL::asset($data->aadhar_card_image)}}" class="logo-icon" alt="logo icon"></td></tr>
                            @endif
                            @if($data->pan_card_image)
                            <tr><th>Pan Card Image</th><td><img src="{{ URL::asset($data->pan_card_image)}}" class="logo-icon" alt="logo icon"></td></tr>
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
