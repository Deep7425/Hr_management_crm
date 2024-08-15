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
								<li class="breadcrumb-item active" aria-current="page">Employees Manager</li>
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
			  
				 <div class="card">
					<div class="card-header">
		                <div class="row">
		                    <div class="col-md-2 mt-2">
		                        <select class="form-control status" name="status">
		                            <option value=""  class = "status">Select Status</option> 
		                            <option value="1"  class = "status" <?php echo isset($status) && $status == 1 ? 'selected' :'' ?>>Working</option> 
		                            <option value="2"  class = "status" >left</option> 
		                            <option value="3" class = "status">Will Join</option>
									<option value="4"  class = "status" >Absent</option>  
		                            <option value="5"  class = "status"  >Under Discussion</option> 
		                        </select>
		                    </div> 
		                
		

							<div class="col-md-3 col-xl-3 mt-2"><input type="text" class="form-control employee_name" placeholder="Enter Name"></div>

		                    <div class="col-md-4 d-inline-flex mt-2">
		                        <button type="button" class="btn btn-primary filter me-3"><i class='bx bx-filter-alt' ></i>Filter</button>
								<button type="button" class="btn btn-primary refresh me-3"><i class="bx bx-refresh"></i></button>
		    
                                <a href="{{customeRoute($page.'.create')}}" class="btn btn-primary me-3"><i class="bx bx-plus"></i>Add Employee </a>
                                
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
									    <th>Code</th>
										<th>Name</th>
										<th>Official Email Address</th>
										<th>Department</th>
										<th>Primary Skills</th>
										<th>Secondary Skills</th>
										<th>Primary Contact Number</th>
										<th>Date Of Joining</th>
										<!-- <th>Date Of birth</th> -->
										<th>Status</th>
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
                        'employee_name':$('.employee_name').val(),
                    });
                },
            }, 
			
            "aoColumns": [
                //{mData: 'id'},
				{mData: 'employee_code'},
                {mData: 'employee_name'},
				{mData: 'official_email_address'},
                {mData: 'employee_department'},
				{mData: 'primarySkills'},
				{mData: 'secondarySkills'},
				{mData: 'primary_contact_number'},
				{mData: 'date_of_joining'},
				// {mData: 'date_of_birth'},
				
				{mData: 'status'},
                {mData: 'actions'}
            ],
             "aoColumnDefs": [
                {"bSortable": false, "aTargets": ['action']},
                { "orderable": false, "targets": [7] }
            ],
            "order": [[7, "desc"]],
            
            language: {
                searchPlaceholder: "Search"
            }, 
        });
        $('.refresh').click(function (e){
            $('.status').val('');
            $('.employee_name').val('');
            tables.ajax.reload();
        });
        $('.filter').click(function (e) {
            tables.ajax.reload();
        });


	
$('.status').on('click', function() {

	// Get the status value from data attribute
    var status = $(this).data('status'); 
    // AJAX request
    $.ajax({
      url: "{{ customeRoute($page.'.index') }}", 
      method: 'POST',
      data: {
        status: status
      },
      success: function(response) {
        
        console.log('Status updated successfully');
        
      },
      error: function(xhr, status, error) {
        // Handle the error response
        console.log('Error updating status: ' + error);
        // Display an error message or perform any other necessary actions
      }
    });
  });
  
	</script>

@endsection