@extends('layouts.master')
@section('content')
<?php 
use App\Models\Task;
// $data['task'] = Task::all();
?>
<!--start page wrapper -->
<div class="page-wrapper">
    <div class="page-content">

        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Employee Task</div>
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
                            @foreach($task as $data)
                            <tr><th>Task Name</th><td>{!! ucwords($data->task_name)!!}</td></tr>
                            <tr><td><a href="{{url('admin/employeeProjects/taskView/'.$data->id)}}" title="view" class="btn btn-primary btn-xs edit_btn" ><span class="fa fa-show">Task View</span></a></td></tr>
                            @endforeach
                        </thead>
                    </table>
                    
                </div>
            </div>
        </div>
    </div>
</div>
<!--end page wrapper -->

@endsection
