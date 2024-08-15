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
                            <tr><th>Project Name</th><td>{!! ucwords($data->project_name)!!}</td></tr>
                            <tr><th>Team Member</th><td>{{$data->team_member}}</td></tr>
                            <!-- <tr><th>password</th> <td><input type="password" value="{{$data->password}}" readonly></td></tr> -->
                            
                        </thead>
                    </table>
                    <a href="{{url('admin/employeeProjects/employeeTask/'.$data->id)}}" title="view" class="btn btn-primary btn-xs edit_btn" ><span class="fa fa-show">Task View</span></a>
                    <!-- <a href="{{url('admin/employeeProjects/taskproject/'.$data->id)}}"><button type="button" class="taskView">Task View</button></a> -->
                </div>
            </div>
        </div>
    </div>
</div>
<!--end page wrapper -->

@endsection
