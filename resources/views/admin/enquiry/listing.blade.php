@extends('layouts.master')
@section('css') 
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/vendor/datatables/dataTables.bootstrap4.min.css')}}">
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@endsection
@section('content')
<style>
	table.dataTable.nowrap td {
  white-space: unset; 
}

	</style>
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
								<li class="breadcrumb-item active" aria-current="page">Enquiries</li>
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
		            
						<ul class="nav nav-pills mb-3" role="tablist">
  <li class="nav-item" role="presentation">
   <a href="{{url('admin/enquiry')}}"> <button class="nav-link active" type="button" role="tab">Inbox</button></a>
  </li>
  <li class="nav-item" role="presentation">
   <a href="{{url('admin/enquiry/archive')}}"> <button class="nav-link" type="button" role="tab">Archive</button></a>
  </li>
</ul>



	                  
		                </div>
		            </div>         
					<div class="card-body">
						<div class="table-responsive">
								<table id="datatable" class="table mb-0 table-striped table-bordered dt-responsive nowrap exampledata" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
								<thead class="table-light">
									<tr>
									    
										<th>Name</th>
										<th>Email Address</th>
										<th>telephone</th>
                    <th>ip address</th>
										<th>country</th>
										<th>city</th>
										<th>message</th>
										<th>created</th>
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

                    });
                },
            }, 
			
            "aoColumns": [
                //{mData: 'id'},
                {mData: 'name'},
                {mData: 'email'},
				{mData: 'telephone'},
        {mData: 'ipaddress'},
				{mData: 'country'},
				{mData: 'city'},
				{mData: 'message'},
				{mData: 'created_at'},
        {mData: 'type'},
        {mData: 'actions'}
            ],
			"aoColumnDefs": [
                {"bSortable": false, "aTargets": ['action']},
                { "orderable": false, "targets": [9] }
                
            ],
            "order": [[8, "desc"]],
            
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
	  $(document).on('click','.move_archive',function(e){
      e.preventDefault();
      var response = confirm('Are you sure want to Archive this deatils?');
      if(response){
        id = $(this).data('id');
		$.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
        $.ajax({
          type: "post",
          data: {'id':id},
          dataType:'json',
          url: "{{url('admin/move')}}",
          success:function(){
            toastr.success('{{ __('Move to archive successfully') }}');
			window.setTimeout(function() {
              window.location.href = "{{url('/admin/enquiry')}}";
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