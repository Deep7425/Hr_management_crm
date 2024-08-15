@extends('layouts.master')
@section('css') 
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/vendor/datatables/dataTables.bootstrap4.min.css')}}">
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@endsection
@section('content')
		<!--start page wrapper -->
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
								<li class="breadcrumb-item active" aria-current="page">Contacts</li>
							</ol>
						</nav>
					</div>
					<!-- <div class="ms-auto">
						<div class="btn-group">
							<button type="button" class="btn btn-light">Settings</button>
							<button type="button" class="btn btn-light dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown">	<span class="visually-hidden">Toggle Dropdown</span>
							</button>
							<div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end">	<a class="dropdown-item" href="javascript:;">Action</a>
								<a class="dropdown-item" href="javascript:;">Another action</a>
								<a class="dropdown-item" href="javascript:;">Something else here</a>
								<div class="dropdown-divider"></div>	<a class="dropdown-item" href="javascript:;">Separated link</a>
							</div>
						</div>
					</div> -->
				</div>
				<!--end breadcrumb-->
			<?php  
			use App\Models\User;
			$login_user_data = auth()->user();
			?>
				<div class="card">
					<div class="card-header">
		                <div class="row">
						@if($login_user_data->user_type == 1) 
		                    <div class="col-md-3 mt-2">
		                        <select class="form-control status" name="status">
		                            <option value="">Select Status</option> 
		                            <option value="extract" <?php echo isset($status) && $status == 1 ? 'selected' :'' ?>>Extract</option> 
		                            <option value="ajaysir" <?php echo isset($status) && $status == 0 ? 'selected' :'' ?>>Ajay Sir</option> 
		                        </select>
		                    </div>
		                   @endif
		                     <!-- <div class="col-md-2 mt-2"><input type="text" class="form-control min" placeholder="min salary range"></div>
		                    <div class="col-md-2 mt-2"><input type="text" class="form-control max"  placeholder="max salary range"></div> -->
		                    <div class="col-md-6 d-inline-flex mt-2">
							@if($login_user_data->user_type == 1) 
		                        <button type="button" class="btn btn-primary filter me-3"><i class='bx bx-filter-alt' ></i>Filter</button>
								@endif
		                        <!-- <button type="button" class="btn btn-light refresh me-3 ms-2"><i class='bx bx-refresh'></i>Reload</button> -->
		                        <!-- <a href="{{url('admin/users/create')}}" class="btn btn-primary d-none d-lg-block m-l-15" title="{{ __('Add User') }}" data-toggle="modal" data-target="#add_modal" ><i class="fa fa-plus"></i> {{ __('Add User') }}</a>  -->
                                <a href="{{customeRoute($page.'.create')}}" class="btn btn-primary me-3"><i class="bx bx-plus"></i> Add New Contact</a>
                                
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
										<th>Name</th>
										<th>Project Title</th>
										<th>Email Address</th>
										<th>Mobile Number</th>
										<th>Country Location</th>
										<th>Extra Link</th>
										<th>Created</th>
										
										<th>Actions</th>
									</tr>
								</thead>
                                <tbody>

                                </tbody>
                
							</table>
						</div>
					</div>
				</div>

			
			</div>
		</div>
		<!--end page wrapper -->
		<!--start overlay-->
		<div class="overlay toggle-icon"></div>
		<!--end overlay-->
		<!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
		<!--End Back To Top Button-->
	</div>
	<!--end wrapper-->
	<script src="{{ URL::asset('assets/vendor/datatables/jquery.dataTables.min.js')}}"></script>
	<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
	<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
	<script type="text/javascript">


		var tables = $('#datatable').DataTable({
            "bProcessing": true,
            "serverSide": true,
            "pageLength": 10,
            retrieve: true,
            "ajax": {
                url: "{{ customeRoute($page.'.index') }}",
                data: function (d) {
                    return $.extend({}, d, {
                        'status':$('.status').val(),
                    });
                },
            }, 
			
            "aoColumns": [
                //{mData: 'id'},
                {mData: 'name'},
				{mData: 'project_title'},
                {mData: 'email'},
				{mData: 'mobile_number'},
				{mData: 'country_location'},
				{mData: 'extraLink'},
				{mData: 'created_at'},
				
                {mData: 'actions'}
            ],
             "aoColumnDefs": [
				{"bSortable": false, "aTargets": ['action']},
                { "orderable": false, "targets": [7] }
            ],
            "order": [[6, "desc"]],
            
            language: {
                searchPlaceholder: "Search"
            }, 
        });
        $('.refresh').click(function (e){
            $('.status').val('');
            tables.ajax.reload();
        });
        $('.filter').click(function (e) {
            tables.ajax.reload();
        });

        // $(document).ready(function(){
        //     $( "#min" ).slider({
        //     range: true,
        //     min: 100,
        //     values: [ 75, 300 ],
        //     slide: function( event, ui ) {
        //         $( "#filter" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
        //     }
        // });
       
		// $( "#max" ).slider({
        //     range: true,
        //     max: 999999,
        //     values: [ 75, 300 ],
        //     slide: function( event, ui ) {
        //         $( "#filter" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
        //     }
        //  });
		// });
		
		
	</script>
	<script>
	  $(document).on('click','.delete_content',function(e){
      e.preventDefault();
      var response = confirm('Are you sure want to delete this Contact?');
      if(response){
        id = $(this).data('id');
        $.ajax({
          type: "post",
          data: {_method: 'delete', _token: "{{ csrf_token() }}", 'id':id},
          dataType:'json',
        //   url: "{{url('admin/delete1')}}" + "/" + id,
          url: "{{url('admin/delete1')}}",
          success:function(){
            toastr.success('{{ __('Contact is deleted successfully') }}');
			window.setTimeout(function() {
              window.location.href = "{{url('/admin/contacts')}}";
            }, 2000);
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