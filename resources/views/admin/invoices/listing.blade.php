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
								<li class="breadcrumb-item active" aria-current="page">Invoice Manager</li>
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
		                    
		                
		                    
						<div class="col-md-3 col-xl-2 mt-2">
                        <select class="form-control status"  name="status">
                            <option value="">Status</option> 
                            <option value="0">Pending</option> 
                            <option value="1" <?php echo isset($status) && $status == 1 ? 'selected' :'' ?>>Active</option> 
                            <option value="2">Received</option> 
                        </select>
                    </div>

					<div class="col-md-3 col-xl-2 mt-2">
                        <select class="form-control company" id="company" name="company" >
                            <option value="">Select Company</option> 
                            @if(!empty($beneficiaryList))
                                @foreach($beneficiaryList as $key => $company)
                                    <option value="{{$company->beneficiary_name}}">{{$company->beneficiary_name}}</option>
                                @endforeach
                            @else
                            @endif
                        </select>
                    </div>

					<div class="col-md-3 col-xl-2 mt-2">
                        <select class="form-control project" id="project" name="project" >
                            <option value="">Select Project</option> 
                            @if(!empty($projects))
                                @foreach($projects as $key => $project)
                                    <option value="{{$project->project_name}}">{{$project->project_name}}</option>
                                @endforeach
                            @else
                            @endif
                        </select>
                    </div>

							<div class="col-md-3 col-xl-3 mt-2"><input type="text" class="form-control start_date" placeholder="From Date"></div>
		                    <div class="col-md-3 col-xl-3 mt-2"><input type="text" class="form-control end_date"  placeholder="To Date"></div>

		                    <div class="col-md-5 col-xl-6 d-inline-flex mt-2">
		                        <button type="button" class="btn btn-primary filter me-3"><i class='bx bx-filter-alt' ></i>Filter</button>
								<button type="button" class="btn btn-primary refresh me-3"><i class="bx bx-refresh"></i></button>
		                        
                                <a href="{{customeRoute($page.'.create')}}" class="btn btn-primary me-3"><i class="bx bx-plus"></i>Create New Invoice</a>
                                
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
										
										<th>Project Name</th>
										<th>Company</th>
										<th>Invoice Number</th>
					
										<th>Original Amount</th>
										<th>Currency</th>
										<th>Total Received</th>
										

										<th>Status</th>
										
										<th>Create at</th>
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


		<div class="modal fade" id="receivedAmountModal" tabindex="-1" role="dialog" aria-labelledby="receivedAmountModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
						<button type="button" class="btn btn-primary closeModal" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="mb-3">
							<label for="inputamount_type" class="form-label required">Amount Type</label>
							<select class ="form-control" name="amount_type" id="amount_type">
							<option value="">Select Amount</option>
							<option value="INR">INR</option>
							<option value="USD">USD</option>
							</select>
						</div>		
						<div class="mb-3">
							<label for="inputamount" class="form-label required">Amount</label>
							<?php  $errorClass =  !empty($errors->has('project_name')) ? 'is-invalid':''; ?>   
							<input type="hidden" id="invoice_id" name="invoice_id">
							{!! Form::text('amount', null, array('required'=>'required','onkeypress'=>'return event.charCode >= 48 && event.charCode <= 57', 'id'=>'amount','placeholder' => 'Enter amount', 'class' => 'form-control '.$errorClass )) !!}
							{!! !empty($errors->has('amount')) ?'<div class="invalid-feedback"><span>'.$errors->first('amount').'</span></div>' :'' !!}
						</div>	
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-primary saveReceivedAmount">Submit</button>
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


		var tables = $('#datatable').DataTable({
            "bProcessing": true,
            "serverSide": true,
            "pageLength": 10,
            retrieve: true,
            "ajax": {
                url: "{{ customeRoute($page.'.index') }}",
                data: function (d) {
                    return $.extend({}, d, {
						'start_date':$('.start_date').val(),
						'end_date':$('.end_date').val(),
						'status':$('.status').val(),
						'company':$('.company').val(),
						'project':$('.project').val(),
                    });
                },
            }, 
            
            "aoColumns": [
                //{mData: 'id'},
                {mData: 'project_name'},
				{mData: 'currentCompany'},
				{mData: 'invoice_number'},
				{mData: 'total_amount'},

				{mData: 'currency'},
				{mData: 'received_amount'},

				{mData: 'status'},
                {mData: 'created_at'},
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
			$('.start_date').val(""),
			$('.end_date').val(""),			
			$('.status').val(""),
			$('.company').val(""),
			$('.project').val(""),
            tables.ajax.reload();
        });
        $('.filter').click(function (e) {
            tables.ajax.reload();
        });
        

		$(document).on('change','.statusAction',function(){
			var id	=	$(this).val();
			if(id == 2){
				$('#receivedAmountModal').show('modal');
				$('#receivedAmountModal').addClass('show');
				$('#invoice_id').val($(this).attr('id'))
			}else{
				$('#receivedAmountModal').show('hide');
				$('#receivedAmountModal').removeClass('show');
			}
		});

		$(".saveReceivedAmount").click(function(){
			$.ajax({
				url:'{{route('admin.invoices.receivedAmount')}}',
				method: 'POST',
				data: {
					"_token": "{{ csrf_token() }}",
					"amount_type" : $('#amount_type').val(),
					"invoice_id" : $('#invoice_id').val(),
					"amount" : $('#amount').val()
				},
				success: function(result){
					if(result.status == true){
						tables.ajax.reload();
						toastr.success(result.message);
						$('#receivedAmountModal').hide('modal');
					}else{
						toastr.error(result.message);
					}
				}
			});        
		});

		$(".closeModal").click(function(){
			tables.ajax.reload();
			$('#receivedAmountModal').hide('modal');
		});

	</script>

@endsection