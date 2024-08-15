@extends('layouts.master')
@section('content')
<!--start page wrapper -->
<div class="page-wrapper">
    <div class="page-content">

        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Bank</div>
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
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr><th>Company Name</th><td>{!! ucwords($data->beneficiary_name)!!}</td></tr>
                            <tr><th>GST</th><td>{{$data->gst}}</td></tr>
                            <tr><th>Bank Name</th><td>{{$data->bank_name}}</td></tr>
                            <tr><th>Bank Accout Number</th><td>{{$data->bank_accout_number}}</td></tr>
                            <tr><th>IFSC</th><td>{{$data->ifsc}}</td></tr>
                            <tr><th>Swift Code</th><td>{{$data->swift_code}}</td></tr>
                            <tr><th>Branch</th><td>{{$data->branch}}</td></tr>
                            <tr><th>Company Email</th><td>{{ !empty($data->company_email) ? $data->company_email : '-' }}</td></tr>
                            <tr><th>Company Phone</th><td>{{ !empty($data->company_phone) ? $data->company_phone : '-' }}</td></tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!--end page wrapper -->

@endsection
