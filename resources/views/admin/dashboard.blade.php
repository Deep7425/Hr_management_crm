@extends('layouts.master')

@section('content')
<?php
  $login_user_data = auth()->user();
  $userType = $login_user_data->type;
  // dd($userType);
?>
<!-- Content Header (Page header) -->
<div class="page-wrapper">
			<div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<!-- <div class="breadcrumb-title pe-3">eCommerce</div> -->
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Dashboard</li>
							</ol>
						</nav>
					</div>
					

					</div>

					                  <div class="row">

														<div class="col-md-3">
												<div class="card card-body bg-primary text-white mb-3 py-3 mx-3 px-3">
												<label for="">Total Projects</label>
												<h1>{{$totalProject}}</h1>
												<a href="{{ url('/admin/projects') }}" class="text-white">View</a>
											</div>
										</div>

                                   
														<div class="col-md-3">
												<div class="card card-body bg-info text-white mb-3 py-3 mx-3 px-3">
												<label for="">Total Client</label>
												<h1>{{$totalClient}}</h1>
												<a href="{{ url('/admin/clients') }}" class="text-white">View</a>
											</div>
										</div>


										<div class="col-md-3">
												<div class="card card-body bg-dark bg-gradient	text-white mb-3 py-3 mx-3 px-3">
												<label for="">Total Employees</label>
												<h1>{{$totalEmployee}}</h1>
												<a href="{{ url('/admin/currentEmployee') }}" class="text-white">View</a>
											</div>
										</div>
										</div>


                                     <div class="row">
				                             <div class="col-md-3">
												<div class="card card-body bg-secondary text-white mb-3 py-3 mx-3 px-3">
												<label for="">Total Value of the Project</label>
												<h1>{{$totalProjectAmount}}</h1>
												<a href="{{ url('/admin/projects') }}" class="text-white">View</a>
											</div>
										</div>


										<div class="col-md-3">
												<div class="card card-body bg-success text-white mb-3 py-3 mx-3 px-3">
												<label for="">Received Amount</label>
												<h1>{{$totalRecieved}}</h1>
												<a href="{{ url('/admin/invoices') }}" class="text-white">View</a>
											</div>
										</div>


										<div class="col-md-3">
												<div class="card card-body bg-danger text-white mb-3 py-3 mx-3 px-3">
												<label for="">Pending Amount</label>
												<h1>{{$totalPending}}</h1>
												<a href="{{ url('/admin/currentEmployee') }}" class="text-white">View</a>
											</div>
										</div>

					                        </div>
 


				<!--end breadcrumb-->
				@if($login_user_data->user_type == 7) 
				<div class="card">
					<div class="card-header">
		                <div class="row">
						
                        <button type="button" class="btn btn-primary login_btn" data-id=""><i class='' ></i>Login</button>
                        <button type="button" class="btn btn-light logout_btn"><i class=''></i>Logout</button>
                        
		                    <div class="col-md-4 d-inline-flex mt-2">
							
		                        <!-- <button type="button" class="btn btn-light refresh me-3 ms-2"><i class='bx bx-refresh'></i>Reload</button> -->
		                        <!-- <a href="{{url('admin/users/create')}}" class="btn btn-primary d-none d-lg-block m-l-15" title="{{ __('Add User') }}" data-toggle="modal" data-target="#add_modal" ><i class="fa fa-plus"></i> {{ __('Add User') }}</a>  -->
                                
                                
		                    </div>
		                    <!-- <div class="col-md-3 d-inline-flex mt-2 float-left">
		                        <a href="javaScript:void(0)" class="btn btn-primary filter me-3"><i class='bx bx-plus'></i>Add Subadmin</a>
		                    </div>   -->                    
		                </div>
		            </div>   
					     
				<div class="card-body">
					<!-- 	<div class="d-lg-flex align-items-center mb-4 gap-3">
							<div class="position-relative">
								<input type="text" class="form-control ps-5 radius-30" placeholder="Search Admin"> <span class="position-absolute top-50 product-show translate-middle-y"><i class="bx bx-search"></i></span>
							</div>
						  <div class="ms-auto"><a href="javascript:;" class="btn btn-light radius-30 mt-2 mt-lg-0"><i class="bx bxs-plus-square"></i>Add New Admin</a></div>
						</div> -->
						<div class="table-responsive">
								<table id="datatable" class="table mb-0 table-striped table-bordered dt-responsive nowrap exampledata" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
								<thead class="table-light">
									<tr>
										<th>Date</th>
										<th>Login Time</th>
										<th>Logout Time</th>
										
									</tr>
								</thead>
							
                                <tbody>
								 
                                </tbody>
                
							</table>
						</div>
					
				</div>
			

				@endif
			</div>
		</div>
		
   <script>
    $(document).on('click','.login_btn',function(e){
      e.preventDefault();
      var response = confirm('Are you sure want to Login?');
      if(response){
		user_id = $(this).data('user_id');
        $.ajax({
          type: "post",
          data: {
                "_token": "{{ csrf_token() }}",
                "date": "{{ Auth::user()->date }}",
				"login_time": "{{ Auth::user()->login_time }}",
				"logout_time": "{{ Auth::user()->logout_time }}"
            }, 
          data: { _token: "{{ csrf_token() }}", 'user_id':user_id},
          dataType:'json',
        //   url: "{{url('admin/delete1')}}" + "/" + id,
          url: "{{url('admin/login_time')}}",
          success:function(){
            toastr.success('{{ __('Ajay sir login successfully') }}');
		
          },   
          error:function(jqXHR,textStatus,textStatus){
            console.log(jqXHR);
            toastr.error(jqXHR.statusText)
          }
      });
      }
      return false;
    }); 
       </script>
@endsection

