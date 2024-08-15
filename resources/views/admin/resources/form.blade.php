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
						<div class="mb-3">
							<label for="inputName" class="form-label required">Full Name</label>
							<?php  $errorClass =  !empty($errors->has('name')) ? 'is-invalid':''; ?>   
			                {!! Form::text('name', null, array('id'=>'name','placeholder' => 'Enter Full Name', 'required'=>'required', 'class' => 'form-control '.$errorClass )) !!}
			                {!! !empty($errors->has('name')) ?'<div class="invalid-feedback"><span>'.$errors->first('name').'</span></div>' :'' !!}
						</div>
						<div class="mb-3">
							<label for="inputEmail" class="form-label required">Email</label>
							<?php $errorClass =  !empty($errors->has('email')) ? 'is-invalid':''; ?>
			                {!! Form::email('email', null, array('id'=>isset($data->email)?true:false,'placeholder' => 'Email', 'required'=>'required', 'class' => 'form-control '.$errorClass)) !!}
			                {!! !empty($errors->has('email')) ?'<div class="invalid-feedback"><span>'.$errors->first('email').'</span></div>' :'' !!}
						</div>
						<div class="mb-3">
							<label for="inputprimary_mobile_number" class="form-label required">Primary Mobile Number</label>
							<?php  $errorClass =  !empty($errors->has('primary_mobile_number')) ? 'is-invalid':''; ?>   
			                {!! Form::text('primary_mobile_number', null, array('id'=>'primary_mobile_number', 'maxlength'=>'20','placeholder' => 'Enter Mobile Number', 'required'=>'required', 'class' => 'form-control primary_mobile_number '.$errorClass )) !!}
			                {!! !empty($errors->has('primary_mobile_number')) ?'<div class="invalid-feedback"><span>'.$errors->first('primary_mobile_number').'</span></div>' :'' !!}
						</div>
						<div class="mb-3">
							<label for="inputsecondary_mobile_number" class="form-label">Secondary Mobile Number(Optional)</label>
							<?php  $errorClass =  !empty($errors->has('secondary_mobile_number')) ? 'is-invalid':''; ?>   
			                {!! Form::text('secondary_mobile_number', null, array('id'=>'secondary_mobile_number','maxlength'=>'20','placeholder' => 'Enter Number', 'class' => 'form-control secondary_mobile_number'.$errorClass )) !!}
							{!! !empty($errors->has('secondary_mobile_number')) ?'<div class="invalid-feedback"><span>'.$errors->first('secondary_mobile_number').'</span></div>' :'' !!}
						</div>
						<div class="mb-3">
						<div class="row">
								
							<label for="inputyears_of_experience" class="form-label required">Years Of Experience</label>
							<?php  $errorClass =  !empty($errors->has('years_of_experience')) ? 'is-invalid':''; ?>   
							<div class="col-md-6 mb-3">
							 <select name="year" class ="form-control" required="required">
								 <option value="">Select Year</option>
								<option <?php if (isset($data->year) && $data->year == "0") { echo "selected"; } ?> value="0">0 year</option> 
								<option <?php if (isset($data->year) && $data->year == "1") { echo "selected"; } ?> value="1">1 year</option>
								<option <?php if (isset($data->year) && $data->year == "2") { echo "selected"; } ?> value="2">2 year</option> 
								<option <?php if (isset($data->year) && $data->year == "3") { echo "selected"; } ?> value="3">3 year</option> 
								<option <?php if (isset($data->year) && $data->year == "4") { echo "selected"; } ?> value="4">4 year</option> 
								<option <?php if (isset($data->year) && $data->year == "5") { echo "selected"; } ?> value="5">5 year</option>
								<option <?php if (isset($data->year) && $data->year == "6") { echo "selected"; } ?> value="6">6 year</option>
								<option <?php if (isset($data->year) && $data->year == "7") { echo "selected"; } ?> value="7">7 year</option>
								<option <?php if (isset($data->year) && $data->year == "8") { echo "selected"; } ?> value="8">8 year</option>
								<option <?php if (isset($data->year) && $data->year == "9") { echo "selected"; } ?> value="9">9 year</option>
								<option <?php if (isset($data->year) && $data->year == "10") { echo "selected"; } ?> value="10">10 year</option>
								<option <?php if (isset($data->year) && $data->year == "11") { echo "selected"; } ?> value="11">11 year</option>
								<option <?php if (isset($data->year) && $data->year == "12") { echo "selected"; } ?> value="12">12 year</option>
								<option <?php if (isset($data->year) && $data->year == "13") { echo "selected"; } ?> value="13">13 year</option>
								<option <?php if (isset($data->year) && $data->year == "14") { echo "selected"; } ?> value="14">14 year</option>
								<option <?php if (isset($data->year) && $data->year == "15+") { echo "selected"; } ?> value="15+">15+ year</option>
                             </select>
							 </div>
							 <div class="col-md-6 mb-3">
							 <select name="month" class ="form-control" required="required">
							 <option value="">Select Month</option>
								<option <?php if (isset($data->month) && $data->month == "0")  { echo "selected"; } ?> value="0">0 month</option> 
								<option <?php if (isset($data->month) && $data->month == "1") { echo "selected"; } ?> value="1">1 month</option>
								<option <?php if (isset($data->month) && $data->month == "2") { echo "selected"; } ?> value="2">2 month</option> 
								<option <?php if (isset($data->month) && $data->month == "3") { echo "selected"; } ?> value="3">3 month</option> 
								<option <?php if (isset($data->month) && $data->month == "4") { echo "selected"; } ?> value="4">4 month</option> 
								<option <?php if (isset($data->month) && $data->month == "5") { echo "selected"; } ?> value="5">5 month</option> 
								<option <?php if (isset($data->month) && $data->month == "6") { echo "selected"; } ?> value="6">6 month</option> 
								<option <?php if (isset($data->month) && $data->month == "7") { echo "selected"; } ?> value="7">7 month</option> 
								<option <?php if (isset($data->month) && $data->month == "8") { echo "selected"; } ?> value="8">8 month</option> 
								<option <?php if (isset($data->month) && $data->month == "9") { echo "selected"; } ?> value="9">9 month</option> 
								<option <?php if (isset($data->month) && $data->month == "10") { echo "selected"; } ?> value="10">10 month</option> 
								<option <?php if (isset($data->month) && $data->month == "11") { echo "selected"; } ?> value="11">11 month</option> 
							 </select>
							 </div>
							 {!! !empty($errors->has('years_of_experience')) ?'<div class="invalid-feedback"><span>'.$errors->first('years_of_experience').'</span></div>' :'' !!}
						</div>

						<div class="mb-3">
							<label for="inputprimarySkills" class="form-label required">Primary Skills</label>
							<?php  $errorClass =  !empty($errors->has('primarySkills')) ? 'is-invalid':''; ?> 
							<select class ="form-control skills" name="primarySkills[]" multiple='multiple' required="required">
								@if(!empty($data['primarySkills']))
								@foreach($data['primarySkills'] as $value)
									<option value="{{ $value->primarySkills}}" <?php if (isset($data['selected_primarySkills']) && in_array($value->primarySkills, $data['selected_primarySkills'])) { echo "selected"; } ?>>{{ $value->primarySkills}}</option>
								@endforeach
								@endif
							</select>
						</div>

						<div class="mb-3">
							<label for="inputsecondarySkills" class="form-label">Secondary Skills</label>
							<?php  $errorClass =  !empty($errors->has('secondarySkills')) ? 'is-invalid':''; ?>  
							<select class ="form-control skills" name="secondarySkills[]" multiple='multiple'>
							@if(!empty($data['secondarySkills']))
							@foreach($data['secondarySkills'] as $value)
							<option value="{{ $value->secondarySkills}}" <?php if (isset($data['selected_secondarySkills']) && in_array($value->secondarySkills, $data['selected_secondarySkills'])) { echo "selected"; } ?>>{{ $value->secondarySkills}}</option>
							 @endforeach
							 @endif
							</select>
			
						</div>
						<div class="mb-3">
							<label for="inputcurrentCompany" class="form-label">Current Company</label>
							<?php  $errorClass =  !empty($errors->has('currentCompany')) ? 'is-invalid':''; ?>   
			                {!! Form::text('currentCompany', null, array('id'=>'currentCompany','placeholder' => 'Enter Current Company', 'class' => 'form-control '.$errorClass )) !!}
			                {!! !empty($errors->has('currentCompany')) ?'<div class="invalid-feedback"><span>'.$errors->first('currentCompany').'</span></div>' :'' !!}
						</div>
						<div class="mb-3">
							<label for="inputctc" class="form-label">CTC</label>
							<?php  $errorClass =  !empty($errors->has('ctc')) ? 'is-invalid':''; ?>   
			                {!! Form::text('ctc', null, array('id'=>'ctc','placeholder' => 'Enter Current CTC','class' => 'form-control ctc'.$errorClass )) !!}
			                {!! !empty($errors->has('ctc')) ?'<div class="invalid-feedback"><span>'.$errors->first('ctc').'</span></div>' :'' !!}
						</div>
						<div class="mb-3">
							<label for="inputectc" class="form-label">ECTC</label>
							<?php  $errorClass =  !empty($errors->has('ectc')) ? 'is-invalid':''; ?>   
			                {!! Form::text('ectc', null, array('id'=>'ectc','placeholder' => 'Enter  ECTC', 'class' => 'form-control ectc'.$errorClass )) !!}
			                {!! !empty($errors->has('ectc')) ?'<div class="invalid-feedback"><span>'.$errors->first('ectc').'</span></div>' :'' !!}
						</div>
						<div class="mb-3">
							<label for="inputMobile" class="form-label">Upload Resume</label>
						
							<div class="form-group input-group">
	                        	@if(isset($data->image))
                                    <div id="image_preview"><img src="{{ $data->image }}"></div>

                    
	                            @endif

	            
	                            <div class="form-control">
	                                <label for="files">Select File</label>
	                                <input type="file" id="file" name="image" class="form-control">
	                            </div>
								
	                         </div>
	                    </div>
						<div class="mb-3">
							<label for="inputlinkedIn_URL" class="form-label">LinkedIn Profile URL</label>
							<?php  $errorClass =  !empty($errors->has('linkedIn_URL')) ? 'is-invalid':''; ?>   
			                {!! Form::text('linkedIn_URL', null, array('id'=>'linkedIn_URL','placeholder' => 'Enter linkedIn URL','url'=>'true','pattern'=>'https://.*' ,'class' => 'form-control '.$errorClass )) !!}
			                {!! !empty($errors->has('linkedIn_URL')) ?'<div class="invalid-feedback"><span>'.$errors->first('linkedIn_URL').'</span></div>' :'' !!}
						</div>
						<div class="mb-3">
							<label for="inputnotice_period" class="form-label">Notice Period</label>
							<?php  $errorClass =  !empty($errors->has('notice_period')) ? 'is-invalid':''; ?>   
			                {!! Form::select('notice_period',[ '15 days' => '15 days', '30 days' => '30 days','45 days'=>'45 days','60 days'=>'60 days','90 days'=>'90 days'], null, array('id'=>'notice_period','placeholder' => 'Select Notice Period','class' => 'form-control '.$errorClass )) !!}
			                {!! !empty($errors->has('notice_period')) ?'<div class="invalid-feedback"><span>'.$errors->first('notice_period').'</span></div>' :'' !!}
						</div>
						<!-- <div class="mb-3">
							<label for="inputProductDescription" class="form-label">Description</label>
							<textarea class="form-control" id="inputProductDescription" rows="3"></textarea>
						</div> -->
			            <div class="mb-3">
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
<script src="{{ URL::asset('assets/plugins/Drag-And-Drop/dist/imageuploadify.min.js')}}"></script>
 <!-- <script>
	$(document).ready(function () {
		$("#file").change(function(){
	      var fileObj = this.files[0];
	      var imageFileType = fileObj.type;
	      var imageSize = fileObj.size;

	      var file = $('#file')[0].files[0].name;
	      $(this).prev('label').text(file);
	    
	      var match = ["image/jpeg","image/png","image/jpg"];
	      if(!((imageFileType == match[0]) || (imageFileType == match[1]) || (imageFileType == match[2]))){
	        $('#previewing').attr('src','images/image.png');
	        toastr.error('Please Select A valid Image File <br> Note: Only jpeg, jpg and png Images Type Allowed!!');
	        return false;
	      }else{
	        //console.log(imageSize);
	        if(imageSize < 5000000){
	          var reader = new FileReader();
	          reader.onload = imageIsLoaded;
	          reader.readAsDataURL(this.files[0]);
	        }else{
	          toastr.error('Images Size Too large Please Select Less Than 5MB File!!');
	          return false;
	        }
	        
	      }
	      
	    });
	    function imageIsLoaded(e){
	      //console.log(e);
	      $("#file").css("color","green");
	      $('#previewing').attr('src',e.target.result);

	    }
	}) -->
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
  	
</script>



<script>
	jQuery('.primary_mobile_number').keyup(function () { 
    this.value = this.value.replace(/[^0-9\.]/g,'');
});
// $('.primary_mobile_number').keyup(function(e){
//   if (/\D/g.test(this.value)) {
//     // Filter non-digits from input value.
//     this.value = this.value.replace(/\D/g, '');
//   }
// });
$('.secondary_mobile_number').keyup(function(e){
  if (/\D/g.test(this.value)) {
    // Filter non-digits from input value.
    this.value = this.value.replace(/\D/g, '');
  }
});
$('.ctc').keyup(function(e){
  if (/\D/g.test(this.value)) {
    // Filter non-digits from input value.
    this.value = this.value.replace(/\D/g, '');
  }
});
$('.ectc').keyup(function(e){
  if (/\D/g.test(this.value)) {
    // Filter non-digits from input value.
    this.value = this.value.replace(/\D/g, '');
  }
});
</script>
<script>

	</script>