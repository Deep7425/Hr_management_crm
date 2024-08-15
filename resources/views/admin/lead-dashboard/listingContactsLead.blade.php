@extends('layouts.master')
@section('css') 
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/vendor/datatables/dataTables.bootstrap4.min.css')}}">
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="assets/css/bootstrap-extended.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&amp;display=swap" rel="stylesheet">
	<link href="assets/css/app.css" rel="stylesheet">
	<link href="assets/css/icons.css" rel="stylesheet">
      
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
								<li class="breadcrumb-item active" aria-current="page">Contacts leads</li>
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
		                    <div class="col-md-2 mt-2"><input type="text" class="form-control start_date" placeholder="From Date"></div>
		                    <div class="col-md-2 mt-2"><input type="text" class="form-control end_date"  placeholder="To Date"></div>
		                    <div class="col-md-4 d-inline-flex mt-2">
		                         <button type="button" class="btn btn-primary filter me-3"><i class='bx bx-filter-alt' ></i>Filter</button>
                             <button type="button" class="btn btn-light refresh me-3 ms-2"><i class='bx bx-refresh'></i>Reload</button>
		                    </div>                   
		                </div>
		            </div>         
                <div class="card-body">
                     <div id="lead_data_graph"></div>
                  </div>
						<ul class="nav nav-pills mb-3" role="tablist">
                <?php $login_user_data = auth()->user(); ?>
                @if($login_user_data->user_type == 1)
            <li class="nav-item" role="presentation">
   <a href="{{url('admin/lead-dashboard')}}"> <button class="nav-link " type="button" role="tab">Archive Leads</button></a>
  </li>
  @endif
  <li class="nav-item" role="presentation">
   <a href="{{url('admin/lead-dashboard/contacts-lead')}}"> <button class="nav-link active" type="button" role="tab">Contacts Leads</button></a>
  </li>
  
  
  <li class="nav-item" role="presentation">
   <a href="{{url('admin/lead-dashboard/qualified-lead')}}"> <button class="nav-link" type="button" role="tab">Qualified Leads</button></a>
  </li>
  <li class="nav-item" role="presentation">
   <a href="{{url('admin/lead-dashboard/business-lead')}}"> <button class="nav-link" type="button" role="tab">Business Proposal Submitted</button></a>
  </li>
  <li class="nav-item" role="presentation">
   <a href="{{url('admin/lead-dashboard/won-lead')}}"> <button class="nav-link" type="button" role="tab">Won Leads</button></a>
  </li>
  <li class="nav-item" role="presentation">
   <a href="{{url('admin/lead-dashboard/cold-lead')}}"> <button class="nav-link" type="button" role="tab">Cold Leads</button></a>
  </li>
  
  <li class="nav-item" role="presentation">
   <a href="{{url('admin/lead-dashboard/lost-lead')}}"> <button class="nav-link" type="button" role="tab">Lost Leads</button></a>
  </li>

</ul>



	                  
		               
                  
					<div class="card-body">
						<div class="table-responsive">
								<table id="datatable" class="table mb-0 table-striped table-bordered dt-responsive nowrap exampledata" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
								<thead class="table-light">
									<tr>
									    
                    <th>Name</th>
										<th>Project Title</th>
										<th>Email Address</th>
										<th>Mobile Number</th>
										<th>Country Location</th>
                    <th>Amount</th>
                    <th>Comment</th>
										<th>Created</th>
										<th>Status</th>
                    <th>Action</th>
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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
 
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<script src="{{ URL::asset('assets/vendor/datatables/jquery.dataTables.min.js')}}"></script>
	<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
	<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

  <script src="{{ asset('plugins/simplebar/js/simplebar.min.js')}}"></script>
	<script src="{{ asset('assets/plugins/metismenu/js/metisMenu.min.js')}}"></script>
	<script src="{{ asset('assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js')}}"></script>
	<script src="{{ asset('assets/plugins/apexcharts-bundle/js/apexcharts.min.js')}}"></script>
	<script type="text/javascript">


		var tables = $('#datatable').DataTable({
            "bProcessing": true,
            "serverSide": true,
            "pageLength": 10,
            retrieve: true,
            "ajax": {
                url: "{{ customeRoute($page.'.contactsLeadIndex') }}",
                data: function (d) {
                    return $.extend({}, d, {
                      'start_date':$('.start_date').val(),
                        'end_date':$('.end_date').val(),
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
                {mData: 'business_amount'},
                {mData: 'qualified_comment'},
                {mData: 'created_at'},
                {mData: 'type'},
                {mData: 'actions'}
            ],
			"aoColumnDefs": [
                {"bSortable": false, "aTargets": ['action']},
                { "orderable": false, "targets": [8] }
            ],
            "order": [[7, "desc"]],
            
            language: {
                searchPlaceholder: "Search"
            }, 
        });
        $('.refresh').click(function (e){
           $('.start_date').val("");
            $('.end_date').val("");
            $('.status').val('');
            tables.ajax.reload();
        });
        $('.filter').click(function (e) {
            tables.ajax.reload();
        });

        $(document).ready(function(){
            $(".start_date").datepicker({
                 minDate: "-1Y",
                 maxDate: "+0D",
                 numberOfMonths: 1,
                 dateFormat:'yy-mm-dd',
                 onSelect: function(selected) {
                   $(".end_date").datepicker("option","minDate", selected)
                 }
             });
             $(".end_date").datepicker({
                 minDate:"-1Y",
                 maxDate:"+0D",
                 numberOfMonths: 1,
                 dateFormat:'yy-mm-dd',
                 onSelect: function(selected) {
                    $(".start_date").datepicker("option","maxDate", selected)
                 }
             });
         });
		
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
    <script>
	  $(document).on('click','.delete_record',function(e){
      e.preventDefault();
      var response = confirm('Are you sure want to delete this Lead?');
      if(response){
        id = $(this).data('id');
        $.ajax({
          type: "post",
          data: {_method: 'delete', _token: "{{ csrf_token() }}", 'id':id},
          dataType:'json',
         //url: "{{url('admin/delete_leads')}}" + "/" + id,
          url: "{{url('admin/delete_leads')}}",
          success:function(){
            toastr.success('{{ __('Lead deleted successfully') }}');
			window.setTimeout(function() {
              window.location.href = "{{url('/admin/lead-dashboard')}}";
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
   <script>
     $(function () {
     	var amount = "{{$last_12_months_amount}}";
     	var monthQualifiedEarning = "{{$monthQualifiedEarning}}";
		 var monthBusinessEarning = "{{$monthBusinessEarning}}";
		 var monthWonEarning = "{{$monthWonEarning}}";
		 var monthColdEarning = "{{$monthColdEarning}}";
		 var monthLostEarning = "{{$monthLostEarning}}";

		
     	var date = "{{$last_12_months_list}}";
	"use strict";
	
	var optionsLine = {
		chart: {
			foreColor: 'rgba(255, 255, 255, 0.65)',
			height: 420,
			type: 'line',
			zoom: {
				enabled: false
			},
			dropShadow: {
				enabled: true,
				top: 3,
				left: 2,
				blur: 4,
				opacity: 0.1,
			}
		},
		stroke: {
			
			curve: 'smooth',
			width: 3
		},
		colors: ["red", 'green', 'yellow','orange','blue','white'],
    // series: [{
		// 	name: "Contact Lead",
		// 	data: [1, 15, 26]
		// }, {
		// 	name: "Qualified Lead",
		// 	data: [3, 33, 21, 42, ]
		// }, {
		// 	name: "Business proposal lead",
		// 	data: [0, 39]
		// }],
		series: [{
			name: "Contact Lead",
			data: amount.split(",")
		}, {
			name: "Qualified Leads",
			data: monthQualifiedEarning.split(",")
		}, {
			name: "Business Leads",
			data: monthBusinessEarning.split(",")
		}, {
		
			name: "Won Leads",
			data: monthWonEarning.split(",")
		}, {
		
			name: "Cold Leads",
			data: monthColdEarning.split(",")
		}, {
		
			name: "Lost Leads",
			data: monthLostEarning.split(",")
		
		}],
		title: {
			text: 'Leads Chart',
			align: 'left',
			offsetY: 25,
			offsetX: 20
		},
		subtitle: {
			text: 'Statistics',
			offsetY: 55,
			offsetX: 20
		},
		markers: {
			size: 4,
			strokeWidth: 0,
			hover: {
				size: 7
			}
		},
		grid: {
			show: true,
			borderColor: 'rgba(255, 255, 255, 0.12)',
			strokeDashArray: 4,
		},
		tooltip: {
			theme: 'dark',
		},
		labels: date.split(","),
		xaxis: {
			tooltip: {
				enabled: false
			}
		},
		legend: {
			position: 'top',
			horizontalAlign: 'right',
			offsetY: -20
		}
	}
	var chartLine = new ApexCharts(document.querySelector('#lead_data_graph'), optionsLine);
	chartLine.render();
	
});
     </script>
    
@endsection