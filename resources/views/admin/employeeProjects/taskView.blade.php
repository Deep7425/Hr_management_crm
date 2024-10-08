@extends('layouts.master')
@section('content')

        <!--start page wrapper -->
        <div class="page-wrapper">
            <div class="page-content">

                <!--breadcrumb-->
                <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                    <div class="breadcrumb-title pe-3">View Employee projects</div>
                    <div class="ps-3">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0 p-0">
                                <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">view</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <!--end breadcrumb-->
                @include('admin.employeeProjects.form')
            </div>
        </div>
@endsection

