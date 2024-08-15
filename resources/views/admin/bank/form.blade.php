<div class="card">
  	<div class="card-body p-4">
	  	<!-- <h5 class="card-title">Add New</h5>
	  	<hr/> -->
       	<div class="form-body mt-4">
		    <div class="row">
			   	<div class="col-lg-12">
		           	<div class="border border-3 p-4 rounded">



						<div class="mb-3">
							<div class="row">
								<div class="col-md-4">
									<label for="inputName" class="form-label">Company Name</label>
									<?php  $errorClass =  !empty($errors->has('beneficiary_name')) ? 'is-invalid':''; ?>   
									{!! Form::text('beneficiary_name', null, array('id'=>'beneficiary_name','placeholder' => 'Enter Company name', 'required'=>'required', 'class' => 'form-control '.$errorClass )) !!}
									{!! !empty($errors->has('beneficiary_name')) ?'<div class="invalid-feedback"><span>'.$errors->first('beneficiary_name').'</span></div>' :'' !!}
								</div>
								<div class="col-md-4">
									<label for="inputcompany_email" class="form-label">Company Email Address</label>
									<?php  $errorClass =  !empty($errors->has('company_email')) ? 'is-invalid':''; ?>   
									{!! Form::text('company_email',null, array('id'=>'company_email','placeholder' => 'Enter Email Address','class' => 'form-control '.$errorClass )) !!}
									{!! !empty($errors->has('company_email')) ?'<div class="invalid-feedback"><span>'.$errors->first('company_email').'</span></div>' :'' !!}
								</div>

								<div class="col-md-4">
									<label for="inputcompany_phone" class="form-label">Company Phone Number</label>
									<?php  $errorClass =  !empty($errors->has('company_phone')) ? 'is-invalid':''; ?>   
									{!! Form::text('company_phone',null, array('maxlength'=>'30','id'=>'company_phone','placeholder' => 'Enter Phone Number','class' => 'form-control '.$errorClass )) !!}
									{!! !empty($errors->has('company_phone')) ?'<div class="invalid-feedback"><span>'.$errors->first('company_phone').'</span></div>' :'' !!}
								</div>
							</div>
						</div>


						<div class="mb-3">
							<label for="inputName" class="form-label">GST</label>
							<?php  $errorClass =  !empty($errors->has('gst')) ? 'is-invalid':''; ?>   
			                {!! Form::text('gst', null, array('id'=>'gst','placeholder' => 'Enter GST', 'required'=>'required', 'class' => 'form-control '.$errorClass )) !!}
			                {!! !empty($errors->has('gst')) ?'<div class="invalid-feedback"><span>'.$errors->first('gst').'</span></div>' :'' !!}
						</div>

						<div class="mb-3">
							<label for="inputName" class="form-label">Bank Name</label>
							<?php  $errorClass =  !empty($errors->has('bank_name')) ? 'is-invalid':''; ?>   
			                {!! Form::text('bank_name', null, array('id'=>'bank_name','placeholder' => 'Enter bank name', 'required'=>'required', 'class' => 'form-control '.$errorClass )) !!}
			                {!! !empty($errors->has('bank_name')) ?'<div class="invalid-feedback"><span>'.$errors->first('bank_name').'</span></div>' :'' !!}
						</div>

						<div class="mb-3">
							<label for="inputName" class="form-label">Bank Account Number</label>
							<?php  $errorClass =  !empty($errors->has('bank_accout_number')) ? 'is-invalid':''; ?>   
			                {!! Form::text('bank_accout_number', null, array('id'=>'bank_accout_number','placeholder' => 'Enter bank accout number', 'required'=>'required', 'class' => 'form-control '.$errorClass )) !!}
			                {!! !empty($errors->has('bank_accout_number')) ?'<div class="invalid-feedback"><span>'.$errors->first('bank_accout_number').'</span></div>' :'' !!}
						</div>

						<div class="mb-3">
							<label for="inputName" class="form-label">Bank IFSC</label>
							<?php  $errorClass =  !empty($errors->has('ifsc')) ? 'is-invalid':''; ?>   
			                {!! Form::text('ifsc', null, array('id'=>'ifsc','placeholder' => 'Enter ifsc', 'required'=>'required', 'class' => 'form-control '.$errorClass )) !!}
			                {!! !empty($errors->has('ifsc')) ?'<div class="invalid-feedback"><span>'.$errors->first('ifsc').'</span></div>' :'' !!}
						</div>

						<div class="mb-3">
							<label for="inputName" class="form-label">Bank Swift Code</label>
							<?php  $errorClass =  !empty($errors->has('swift_code')) ? 'is-invalid':''; ?>   
			                {!! Form::text('swift_code', null, array('id'=>'swift_code','placeholder' => 'Enter swift code', 'required'=>'required', 'class' => 'form-control '.$errorClass )) !!}
			                {!! !empty($errors->has('swift_code')) ?'<div class="invalid-feedback"><span>'.$errors->first('swift_code').'</span></div>' :'' !!}
						</div>


						<div class="mb-3">
							<label for="inputName" class="form-label">Bank Branch</label>
							<?php  $errorClass =  !empty($errors->has('branch')) ? 'is-invalid':''; ?>   
			                {!! Form::text('branch', null, array('id'=>'branch','placeholder' => 'Enter branch', 'required'=>'required', 'class' => 'form-control '.$errorClass )) !!}
			                {!! !empty($errors->has('branch')) ?'<div class="invalid-feedback"><span>'.$errors->first('branch').'</span></div>' :'' !!}
						</div>

						
			


						<div class="mb-3 mt-3">
						    <div class="d-grid">
	                           <button type="submit" class="btn btn-light">Save</button>
						    </div>		  
			            </div>
		            </div>
			   	</div>
			</div>
	   </div><!--end row-->
	</div>
</div>
<script>

	const phone = document.getElementById('company_phone');
	phone.addEventListener('input', function() {
	let start = this.selectionStart;
	let end = this.selectionEnd;
	
	const current = this.value
	const corrected = current.replace(/([^+0-9]+)/gi, '');
	this.value = corrected;
	
	if (corrected.length < current.length) --end;
	this.setSelectionRange(start, end);
});
</script>