@extends('layouts.master')

@section('content')
    <div class="page-wrapper">
        <div class="page-content">
            <!-- Breadcrumb -->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Employee Manager</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">View</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!-- End Breadcrumb -->
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Client Name</th>
                                    <td>{!! ucwords($data['client_name']) !!}</td>
                                </tr>
                                <tr>
                                    <th>Project Name</th>
                                    <td>{!! ucwords($data['project_name']) !!}</td>
                                </tr>
                                <tr>
                                    <th>Project Award Date</th>
                                    <td>{{ $data['project_award_date'] }}</td>
                                </tr>
                                <tr>
                                    <th>Total Amount</th>
                                    <td>{{ $data['total_amount'] }}</td>
                                </tr>
                                <!-- Add the rest of the rows here -->


								<tr>
                                    <th>Team Member</th>
                                    <td>{{ $data['team_member'] }}</td>
                                </tr>
                                <tr>
                                    <th>Document URL</th>
                                    <td>{{ $data['document_url'] }}</td>
                                </tr>

                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
	