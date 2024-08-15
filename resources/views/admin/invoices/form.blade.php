<style>
	.required:after {
    content:" *";
    color: red;
  }
  .parsley-required{    
        color: red;   
        font-size: 12px;
	}
	</style>
	
<div class="card">
  	<div class="card-body p-4">
	  	<!-- <h5 class="card-title">Add New</h5>
	  	<hr/> -->
       	<div class="form-body mt-4">
		    <div class="row">
			   	<div class="col-lg-12">
				
		           	<div class="border border-3 p-4 rounded">
						   <input type="hidden" name="client_id" value="<?php echo $client['client_name'][0]->id;?>">
						<div class="mb-3">
							<label for="inputclient_name" class="form-label required">Client Name</label>
							<select class ="form-control" name="client_name"  id="client_name" required="required">
							<option value="">Select Client</option>
								@if(!empty($client['client_name']))
								@foreach($client['client_name'] as $value)
									<option value="{{ $value->id}}" @if(isset($data->client_name) && $data->client_name == $value->id) selected @endif>{{ $value->client_name}}</option>
								@endforeach
								@endif
							</select>
						</div>
						
						<div class="mb-3 subCategoriesOptions ">
							<label for="inputproject_name" class="form-label required">Project Name</label>
							<select class ="form-control project_div" name="project_name" id="add_invoice" required="required">
								<option value="">Select Project</option>
							</select>
						</div>


						<div class="mb-3">
							<label for="inputcurrentCompany" class="form-label required">Select Company</label>
							<select class ="form-control currentCompany" name="currentCompany" required="required">
							<option value="">Select Company</option>
								@if(!empty($data['beneficiaryList']))
								@foreach($data['beneficiaryList'] as $value)															    
									<option value="{{ $value->beneficiary_name}}"  @if(isset($data->currentCompany) &&  $data->currentCompany == $value->beneficiary_name) selected @endif>{{$value->beneficiary_name}}</option>
								@endforeach
								@endif
							</select>
						</div>

						<div class="mb-3">
							<label for="inputcurrentCompany" class="form-label required">Select Bank</label>
							<select class ="form-control currentBank" name="bank" required="required">
							<option value="">Select Bank</option>
								@if(!empty($data['bankList']))
								@foreach($data['bankList'] as $value)								    
									<option value="{{ $value->id}}"  @if(isset($data->bank) &&  $data->bank == $value->id) selected @endif >{{ ucwords($value->bank_name)}}</option>
								@endforeach
								@endif
							</select>
							<!-- <?php  $errorClass =  !empty($errors->has('bank')) ? 'is-invalid':''; ?>   
			                {!! Form::text('client_address',null, array('id'=>'client_address','class' => 'form-control ckeditor'.$errorClass )) !!}
			                {!! !empty($errors->has('client_address')) ?'<div class="invalid-feedback"><span>'.$errors->first('client_address').'</span></div>' :'' !!} -->
						</div>						

						<div class="mb-3 mt-3">
							<label for="inputinvoice_number" class="form-label required">Invoice Number</label>
							<?php  $errorClass =  !empty($errors->has('invoice_number')) ? 'is-invalid':''; ?>   
			                {!! Form::text('invoice_number',null, array('id'=>'invoice_number','readonly'=>'readonly','class' => 'form-control'.$errorClass )) !!}
			                {!! !empty($errors->has('invoice_number')) ?'<div class="invalid-feedback"><span>'.$errors->first('invoice_number').'</span></div>' :'' !!}
						</div>
					


    <!-- Job  reference and memo removed-->



<!-- milestone -->

  



						<div class="mb-3">

                            <div class="row">
                                <div id='TextBoxesGroup'>
                                    <div id="TextBoxDiv1">


                                        <div class="row">
                                            <!-- <div class="col-sm-5 mb-3">


                                                <input type="text" class="form-control milestone_name" name="milestone_name" id="milestone_name" placeholder="Milestone name" value="" required="required">

                                                {{-- <input type="text" class="form-control  milestone_name" name="milestone_name" id="milestone_name" placeholder="Please enter milestone name" value="{{$new_milestone_name_number}}" required="required" readonly> --}}

                                            </div> -->

                              
		
                           

							<div class="milstone_div">
                               </div>


						
			            <div class="mb-3 mt-4">
						    <div class="d-grid">
	                           <button type="submit" class="btn btn-light">save</button>
						    </div>		  
			            </div>
			   	</div>
			</div>
	   </div><!--end row-->
	</div>
</div>




<!------------------------------------------------------------------------- Script ---------------------------------------------------------------------------------->


<script>
	$(document).on('change','.currentCompany',function(){
		$('.currentBank').load("{{url('admin/getBankList')}}?value="+$(this).val().replaceAll(' ','+'));

		/* $('.setInvoice').load("{{url('admin/getInvoice')}}?value="+$(this).val().replaceAll(' ','+'))

		$('#invoice_number').val($('.setInvoice').text()); */
	});

	$(document).on('change','.currentCompany',function(){
        $.ajax({
            url:"{!! url('admin/getInvoice') !!}?value="+$(this).val().replaceAll(' ','+'),
            method: 'get',
            success: function(result){
				$('#invoice_number').val(result);
            }
        });  
    })
</script>
<script>

  $('#client_name').on('change', function () {
    $("#add_invoice").attr('disabled', false); 
    $("#add_invoice").val("");
    $(".project_name").attr('disabled', true);
    $(".project_name").hide(); 
    $(".parent-" + $(this).val()).attr('disabled', false); 
    $(".parent-" + $(this).val()).show(); 
});

$( document ).ready(function() {
	var invoice_id = "{{ isset($data) && !empty($data->id) ? $data->id : '' }}";
	var client_id = "{{ isset($data) && !empty($data->client_name) ? $data->client_name : '' }}";
	
	$.ajax({
		url:"{{ route('admin.invoices.show-project')}}",
		dataType: 'html',
		data: {'client_id':client_id,'invoice_id':invoice_id},
		success:function(result){
			$('.project_div').html(result);
		}
	});

	$("#client_name").change(function(){
		var id  = $(this).val();
		$.ajax({
			url:"{{ route('admin.invoices.show-project')}}",
			dataType: 'html',
			data: {'client_id':id,'invoice_id':invoice_id},
			success:function(result){
				$('.project_div').html(result);
			}
		});
	});

	

//  Milestone Ajax
	
	$("#add_invoice").on("change", function(){
		var project_name  = $(this).val();
		$.ajax({
			url:"{{ route('admin.invoices.show-milstone')}}",
			dataType: 'html',
			data: {'project_name':project_name,'invoice_id':invoice_id},
			success:function(result){
				$('.milstone_div').html(result);
			}
		});
	});
	// var project_name = "{{ isset($data) && !empty($data->project_name) ? $data->project_name : '' }}";
	// $.ajax({
	// 	url:"{{ route('admin.invoices.show-milstone')}}",
	// 	dataType: 'html',
	// 	data: {'project_name':project_name,'invoice_id':invoice_id},
	// 	success:function(result){
	// 		console.log(result)
	// 		$('.milstone_div').html(result);
			
	// 	}
	// });


	// $("#add_invoice").on("change", function(){
	// 	var project_name  = $(this).val();

		
	// 	$.ajax({
	// 		url:"{{ route('admin.invoices.show-currency')}}",
	// 		dataType: 'html',
	// 		data: {'project_name':project_name,'invoice_id':invoice_id},
	// 		success:function(result){
	// 			$('.currency_div').html(result);
	// 		}
	// 	});
	// });
	// var project_name = "{{ isset($data) && !empty($data->project_name) ? $data->project_name : '' }}";
	// $.ajax({
	// 	url:"{{ route('admin.invoices.show-currency')}}",
	// 	dataType: 'html',
	// 	data: {'project_name':project_name,'invoice_id':invoice_id},
	// 	success:function(result){
	// 		$('.currency_div').html(result);
	// 	}
	// });



	// $("#add_invoice").on("change", function(){
	// 	var project_name  = $(this).val();
		
	// 	$.ajax({
	// 		url:"{{ route('admin.invoices.show-total_amount')}}",
	// 		dataType: 'html',
	// 		data: {'project_name':project_name,'invoice_id':invoice_id},
	// 		success:function(result){
	// 			$('.amount_div').html(result);
	// 		}
	// 	});
	// });
	// var project_name = "{{ isset($data) && !empty($data->project_name) ? $data->project_name : '' }}";
	// $.ajax({
	// 	url:"{{ route('admin.invoices.show-total_amount')}}",
	// 	dataType: 'html',
	// 	data: {'project_name':project_name,'invoice_id':invoice_id},
	// 	success:function(result){
	// 		$('.amount_div').html(result);
	// 	}
	// });


});
</script>