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
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                        <li class="breadcrumb-item active" aria-current="page">Client Manager</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-3 mt-2">
                        <select class="form-control status" name="status">
                            <option value="">Select Status</option>
                            <option value="1" {{ isset($status) && $status==1 ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ isset($status) && $status==0 ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>

<!--===============================================================================================================================================================================  --> 


                    <div class="col-md-3 col-xl-3 mt-2"><input type="text" class="form-control primary_country" name="primary_country" placeholder="Enter Country"></div>


                    <div class="col-md-6 d-inline-flex mt-2">
                        <button type="button" class="btn btn-primary filter me-3"><i
                                class="bx bx-filter-alt"></i>Filter</button>
                        <a href="{{ customeRoute($page.'.create') }}" class="btn btn-primary me-3"><i
                                class="bx bx-plus"></i>Add Client</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="datatable"
                        class="table mb-0 table-striped table-bordered dt-responsive nowrap exampledata"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead class="table-light">
                            <tr>
                                <th>Name</th>
                                <th>Email Address</th>
                                <th>Mobile Number</th>
                                <th>GST Number</th>
                                <th>Country</th>
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
</div>
<!--end page wrapper -->

<!--start overlay-->
<div class="overlay toggle-icon"></div>
<!--end overlay-->

<!--Start Back To Top Button-->
<a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
<!--End Back To Top Button-->
</div>
<!--end wrapper-->

<!-- Scripts -->
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
                            'primary_country':$('.primary_country').val(),
                        });
                    },
                }, 
			

        "aoColumns": [
            //{mData: 'id'},
            { mData: 'client_name' },
            { mData: 'email' },
            { mData: 'client_mobile_number' },
            { mData: 'client_GST_number' },
            { mData: 'primary_country' },
            { mData: 'status' },
            { mData: 'created_at' },
            { mData: 'actions' }
        ],
        "aoColumnDefs": [
            { "bSortable": false, "aTargets": ['action'] },
            { "orderable": false, "targets": [6] }
        ],
        "order": [[5, "desc"]],

        language: {
            searchPlaceholder: "Search"
        },
    });

    $('.refresh').click(function (e) {
        //$('.start_date').val("");
        //$('.end_date').val("");
        $('.status').val('');
        $('.primary_country').val('');
        tables.ajax.reload();
    });

    $('.filter').click(function (e) {
        tables.ajax.reload();
    });
//     $('.primary_country').change(function() {
//     tables.ajax.reload();
// });
</script>

@endsection