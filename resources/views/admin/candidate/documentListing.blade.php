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
								<li class="breadcrumb-item active" aria-current="page">Document List</li>
							</ol>
						</nav>
					</div>
				</div>
				<!--end breadcrumb-->
			  
				<div class="card">
					<div class="card-header">
		                <div class="row">
		                    <!-- <div class="col-md-2 mt-2">
		                        <select class="form-control status" name="status">
		                            <option value="">Select Status</option> 
		                            <option value="1" <?php echo isset($status) && $status == 1 ? 'selected' :'' ?>>Active</option> 
		                            <option value="0">Inactive</option> 
		                        </select>
		                    </div> -->
		                
		                    
		                    <!-- <div class="col-md-2 mt-2"><input type="text" class="form-control start_date" placeholder="From Date"></div>
		                    <div class="col-md-2 mt-2"><input type="text" class="form-control end_date"  placeholder="To Date"></div> -->
		                    <div class="col-md-4 d-inline-flex mt-2">
                                <a href="{{customeRoute($page.'.documentcreate',['candidate_id'=>$candidate_id])}}" class="btn btn-primary me-3"><i class="bx bx-plus"></i>Add Document</a> 
                                </div>
		                    <!-- <div class="col-md-3 d-inline-flex mt-2 float-left">
		                        <a href="javaScript:void(0)" class="btn btn-primary filter me-3"><i class='bx bx-plus'></i>Add Subadmin</a>
		                    </div>   -->                    
		                </div>
		            </div>         
					<div class="card-body">
        <div class="table-responsive">
								<table id="datatable" class="table mb-0 table-striped table-bordered dt-responsive nowrap exampledata" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
								<thead class="table-light">
									<tr>
										<th>aadhar card</th>
										<th>bank account number</th>
                                        <th>bank name</th>
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
                url: "{{ customeRoute($page.'.documentListing') }}",
                data: function (d) {
                    //console.log('dasda--'+d.project_id);
                    return $.extend({}, d, {
                        'candidate_id':"{{$candidate_id}}",
                        'start_date':$('.start_date').val(),
                        'end_date':$('.end_date').val(),
                        'status':$('.status').val(),
                    });
                },
            }, 
			
            "aoColumns": [
                //{mData: 'id'},
                {mData: 'aadhar_card'},
                {mData: 'bank_account_number'},
                {mData: 'bank_name'},
                {mData: 'created_at'},
                {mData: 'actions'}
            ],
             "aoColumnDefs": [
                {"bSortable": false, "aTargets": ['action']},
                { "orderable": false, "targets": [4] }
            ],
            "order": [[3, "desc"]],
            
            language: {
                searchPlaceholder: "Search"
            }, 
        });
        $('.refresh').click(function (e){
            //$('.start_date').val("");
            //$('.end_date').val("");
            $('.status').val('');
            tables.ajax.reload();
        });
        $('.filter').click(function (e) {
            tables.ajax.reload();
        });

        // $(document).ready(function(){
        //     $(".start_date").datepicker({
        //          minDate: "-1Y",
        //          maxDate: "+0D",
        //          numberOfMonths: 1,
        //          dateFormat:'yy-mm-dd',
        //          onSelect: function(selected) {
        //            $(".end_date").datepicker("option","minDate", selected)
        //          }
        //      });
        //      $(".end_date").datepicker({
        //          minDate:"-1Y",
        //          maxDate:"+0D",
        //          numberOfMonths: 1,
        //          dateFormat:'yy-mm-dd',
        //          onSelect: function(selected) {
        //             $(".start_date").datepicker("option","maxDate", selected)
        //          }
        //      });
        //  });
	</script>

@endsection