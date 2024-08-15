@section('css') 
	<link href="{{ URL::asset('assets/plugins/Drag-And-Drop/dist/imageuploadify.min.css')}}" rel="stylesheet" />
	<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/css/select2.min.css" rel="stylesheet" />
@endsection
<style>
	.parsley-required{    
        color: red;   
        font-size: 12px;
	}
	.select2-results__option--selectable {
  cursor: pointer;
  background-color: #132b39;
	}

  .select2-container--default .select2-selection--multiple .select2-selection__choice__display {
  cursor: default;
  padding-left: 2px;
  padding-right: 5px;
  color: black;
}
.required:after {
    content:" *";
    color: red;
  }

  .select2-container--default .select2-results__option--highlighted.select2-results__option--selectable {
  background-color: #6b717b;
  color: white;
  }
  .parsley-pattern {
  color: red;
  font-size: 12px;
}
.parsley-type {
  color: red;
  font-size: 12px;
}
.select2-search__field {
  color: white;
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
						<div class="row">
						<div class="col-md-6 mb-3">


						<!-- Employee Name -->
							<label for="inputemployee_name" class="form-label required">Name</label>
							<?php  $errorClass =  !empty($errors->has('employee_name')) ? 'is-invalid':''; ?>   
			                {!! Form::text('employee_name', null, array('id'=>'employee_name','placeholder' => 'Enter Name', 'required'=>'required', 'class' => 'form-control '.$errorClass )) !!}
			                {!! !empty($errors->has('employee_name')) ?'<div class="invalid-feedback"><span>'.$errors->first('employee_name').'</span></div>' :'' !!}
						</div>

						<!-- Employee Code -->
						<!-- <div class="col-md-6 mb-3">
							<label for="inputemployee_code" class="form-label required">Employee Code</label>
							<?php  $errorClass =  !empty($errors->has('employee_code')) ? 'is-invalid':''; ?>   
			                {!! Form::text('employee_code', null, array('id'=>'employee_code', 'value' => 'employee_code',  'placeholder' => 'Enter Code', 'required'=>'required', 'class' => 'form-control '.$errorClass )) !!}
			                {!! !empty($errors->has('employee_code')) ?'<div class="invalid-feedback"><span>'.$errors->first('employee_code').'</span></div>' :'' !!}
						</div> -->
           
			

						
						<!-- Employee Department -->

						<div class="col-md-6 mb-3">
							<label for="inputemployee_department" class="form-label required">Department</label>
							<?php  $errorClass =  !empty($errors->has('employee_department')) ? 'is-invalid':''; ?>   
			                {!! Form::select('employee_department',[ 'web' => 'Web', 'mobile' => 'Mobile','marketing'=>'Marketing','sales'=>'Sales','HR'=>'HR','admin'=>'Admin','design'=>'Design'], null, array('id'=>'employee_department','placeholder' => 'Select Department','required'=>'required','class' => 'form-control '.$errorClass )) !!}
			                {!! !empty($errors->has('employee_department')) ?'<div class="invalid-feedback"><span>'.$errors->first('employee_department').'</span></div>' :'' !!}
						</div>
						</div>


						<!-- Employee Skill -->


						<div class="mb-3">
						<div class="row">
							<div class="col-md-6 mb-3">
							<label for="inputprimarySkills" class="form-label required">Primary Skills(Technology)</label>
							<?php  $errorClass =  !empty($errors->has('primarySkills')) ? 'is-invalid':''; ?> 
							<select class ="form-control skills" name="primarySkills[]" multiple='multiple' required="required">
								@if(!empty($data['primarySkills']))
								@foreach($data['primarySkills'] as $value)
									<option value="{{ $value->primarySkills}}" <?php if (isset($data['selected_primarySkills']) && in_array($value->primarySkills, $data['selected_primarySkills'])) { echo "selected"; } ?>>{{ $value->primarySkills}}</option>
								@endforeach
								@endif
							</select>
						</div>

						<div class="col-md-6 mb-3">
							<label for="inputsecondarySkills" class="form-label required">Secondary Skills(Technology)</label>
							<?php  $errorClass =  !empty($errors->has('secondarySkills')) ? 'is-invalid':''; ?>  
							<select class ="form-control skills" name="secondarySkills[]" multiple='multiple'>
							@if(!empty($data['secondarySkills']))
							@foreach($data['secondarySkills'] as $value)
							<option value="{{ $value->secondarySkills}}" <?php if (isset($data['selected_secondarySkills']) && in_array($value->secondarySkills, $data['selected_secondarySkills'])) { echo "selected"; } ?>>{{ $value->secondarySkills}}</option>
							 @endforeach
							 @endif
							</select>
			
						</div>
						</div>
						</div>
						

						
						<!-- Employee Number -->
						<div class="row">
						<div class="col-md-6 mb-3">
							<label for="inputprimary_contact_number" class="form-label required">Primary Contact Number</label>
							<?php  $errorClass =  !empty($errors->has('primary_contact_number')) ? 'is-invalid':''; ?>   
			                {!! Form::text('primary_contact_number', null, array('id'=>'primary_contact_number', 'maxlength'=>'20','placeholder' => 'Enter Mobile Number', 'required'=>'required', 'class' => 'form-control primary_contact_number '.$errorClass )) !!}
			                {!! !empty($errors->has('primary_contact_number')) ?'<div class="invalid-feedback"><span>'.$errors->first('primary_contact_number').'</span></div>' :'' !!}
						</div>

						<div class="col-md-6 mb-3">
							<label for="inputemergency_contact_number" class="form-label">Emergency Contact Number</label>
							<?php  $errorClass =  !empty($errors->has('emergency_contact_number')) ? 'is-invalid':''; ?>   
			                {!! Form::text('emergency_contact_number', null, array('id'=>'emergency_contact_number','maxlength'=>'20','placeholder' => 'Enter Emergency Number', 'class' => 'form-control emergency_contact_number'.$errorClass )) !!}
							{!! !empty($errors->has('emergency_contact_number')) ?'<div class="invalid-feedback"><span>'.$errors->first('emergency_contact_number').'</span></div>' :'' !!}
						</div>
						</div>

						<div class="row">
						<div class="col-md-4 mb-3">
							<label for="inputdate_of_joining" class="form-label required">Date Of Joining</label>
							<?php  $errorClass =  !empty($errors->has('date_of_joining')) ? 'is-invalid':''; ?>   
			                {!! Form::date('date_of_joining', null, array('id'=>'date_of_joining','placeholder' => 'Enter Date Of Joining', 'required'=>'required', 'class' => 'form-control '.$errorClass )) !!}
			                {!! !empty($errors->has('date_of_joining')) ?'<div class="invalid-feedback"><span>'.$errors->first('date_of_joining').'</span></div>' :'' !!}
						</div>
                       
						<div class="col-md-4 mb-3">
							<label for="inputdate_of_birth" class="form-label required">Date Of Birth</label>
							<?php  $errorClass =  !empty($errors->has('date_of_birth')) ? 'is-invalid':''; ?>   
			                {!! Form::date('date_of_birth', null, array('id'=>'date_of_birth','placeholder' => 'Enter Date Of Birth', 'required'=>'required', 'class' => 'form-control '.$errorClass )) !!}
			                {!! !empty($errors->has('date_of_birth')) ?'<div class="invalid-feedback"><span>'.$errors->first('date_of_birth').'</span></div>' :'' !!}
						</div>

						<div class="col-md-4 mb-3">
							<label for="inputofficial_email_address" class="form-label required">Official Email Address</label>
							<?php $errorClass =  !empty($errors->has('official_email_address')) ? 'is-invalid':''; ?>
			                {!! Form::email('official_email_address', null, array('id'=>isset($data->official_email_address)?true:false,'placeholder' => 'Official Email Address', 'required'=>'required', 'class' => 'form-control '.$errorClass)) !!}
			                {!! !empty($errors->has('official_email_address')) ?'<div class="invalid-feedback"><span>'.$errors->first('official_email_address').'</span></div>' :'' !!}
						</div>
						<div class="col-md-4 mb-3">
							<label for="inputpersonal_email_address" class="form-label required">Personal Email Address</label>
							<?php $errorClass =  !empty($errors->has('personal_email_address')) ? 'is-invalid':''; ?>
			                {!! Form::email('personal_email_address', null, array('id'=>isset($data->personal_email_address)?true:false,'placeholder' => 'Personal Email Address', 'required'=>'required', 'class' => 'form-control '.$errorClass)) !!}
			                {!! !empty($errors->has('personal_email_address')) ?'<div class="invalid-feedback"><span>'.$errors->first('personal_email_address').'</span></div>' :'' !!}
						</div>



						<div class="col-md-4 mb-3">
							<label for="inputaadhar_number" class="form-label required">Aadhar Number</label>
							<?php $errorClass =  !empty($errors->has('aadhar_number')) ? 'is-invalid':''; ?>
			                {!! Form::text('aadhar_number', null, array('id'=>isset($data->aadhar_number)?true:false,'placeholder' => 'Enter Aadhar Number', 'required'=>'required', 'class' => 'form-control '.$errorClass)) !!}
			                {!! !empty($errors->has('aadhar_number')) ?'<div class="invalid-feedback"><span>'.$errors->first('aadhar_number').'</span></div>' :'' !!}
						</div>

<!-- import Document -->

		<a href="javascript:void(0)"  class="btn btn-primary import_btn" title="{{ __('Import') }}"
		onclick="importModal(this)"><i class="fa fa-upload"></i>Upload Document</a>
						


	


	<div class="modal fade" id="ownerImportModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Upload Documents</h5>
						<button type="button" class="close ownerModalClose" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form action="{{ route('admin.currentEmployee.upload') }}" method="POST" enctype="multipart/form-data" id="ownerFormSubmit" data-parsley-validate="false">
							<div class="form-body">
								<div class="row">
									<div class="col-lg-12">
										<div class="margin-cls border border-3 p-4 rounded row">
											<!-- <div class="col-md-12 mb-3">
												<label for="inputName" class="form-label">Name*</label>
												<?php 
												//  $errorClass =  !empty($errors->has('name')) ? 'is-invalid':''
												; ?>   
												{!! Form::text('name', null, array('id'=>'name','placeholder' => 'Enter Name*', 'required'=>'required', 'class' => 'form-control '.$errorClass )) !!}
												{!! !empty($errors->has('name')) ?'<div class="invalid-feedback"><span>'.$errors->first('name').'</span></div>' :'' !!}
											</div> -->
											<div class="col-md-8 mb-3">
												<label for="inputMobile" class="form-label">upload file</label>
												<div class="input-group">
													<!-- <div class="form-control" onclick="document.getElementById('file_build').click()"> -->
													<div class="form-control" >
														<label for="files">Select File</label>
														<input type="file" id="document" name="document" class="form-control">
													</div>
												</div>
											</div>
											<div class="col-md-4 mb-3">
												<div class="form-group mt-btn" style="padding-top: 22px;">
												<a href="{{url('public/uploads/Owners_import_sample.xls')}}" class="btn btn-success" title="Demo Download"><i class="fas fa-file-excel" aria-hidden="true"></i> Sample File</a>
												</div>
											</div>

											<a href="javascript:void(0)" class="btn btn-light ownerModalClose" data-dismiss="modal">Cancel</a>

										</div>
									</div>
								</div>
							</div>
						</form>
					</div>
					<div class="modal-footer">
					<!-- <button type="button" class="btn btn-secondary ownerModalClose" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary">Save</button> -->
					</div>
				</div>
			</div>
		</div>


						
		            </div>
			   	</div>
			</div>
	   </div><!--end row-->

	                                            </div>

	                                           <div class="col-md-12">
												<div class="d-flex-left my-4 mx-3" >
											
													<button type="submit" class="btn btn-light ms-auto">{{$data['button']}}</button>
												</div>		  
											</div>



</div>
<script src="{{ URL::asset('assets/plugins/Drag-And-Drop/dist/imageuploadify.min.js')}}"></script>
<script>

	const phone = document.getElementById('primary_contact_number');
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

<script>

	const phones = document.getElementById('emergency_contact_number');
	phones.addEventListener('input', function() {
	let start = this.selectionStart;
	let end = this.selectionEnd;
	
	const current = this.value
	const corrected = current.replace(/([^+0-9]+)/gi, '');
	this.value = corrected;
	
	if (corrected.length < current.length) --end;
	this.setSelectionRange(start, end);

});

</script> 

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
<script>
	$(document).ready(function(){
            $(".exp_date").datepicker({
                 minDate: "-1Y",
                 maxDate: "+0D",
                 numberOfMonths: 1,
                 dateFormat:'yy-mm',
             });
			});
	</script>
		<script>

$(".skills").select2({
  tags: true,
  placeholder: "Select a Skills",
  tokenSeparators: [',', ' ']
})






function importModal($this){
			$('#ownerImportModal').modal('show');
		}
		$(document).ready(function(){
			$(".ownerModalClose").click(function(){
				$("#ownerImportModal").modal('toggle');
			});
		});

		function importModalBulkImage($this){
			$('#ownerImportModalBulk').modal('show');
		}
		$(document).ready(function(){
			$(".ownerModalCloseBulk").click(function(){
				$("#ownerImportModalBulk").modal('toggle');
			});
		});
</script>
