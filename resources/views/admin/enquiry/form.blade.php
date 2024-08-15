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
							<label for="inputmobile_number" class="form-label required">Mobile Number</label>
							<?php  $errorClass =  !empty($errors->has('mobile_number')) ? 'is-invalid':''; ?>   
			                {!! Form::text('mobile_number', null, array('id'=>'mobile_number', 'maxlength'=>'20','placeholder' => 'Enter Mobile Number', 'required'=>'required', 'class' => 'form-control mobile_number '.$errorClass )) !!}
			                {!! !empty($errors->has('mobile_number')) ?'<div class="invalid-feedback"><span>'.$errors->first('mobile_number').'</span></div>' :'' !!}
						</div>

						<div class="mb-3">
							<label for="inputprimary_country" class="form-label required">Primary Country</label>
							<?php  $errorClass =  !empty($errors->has('primary_country')) ? 'is-invalid':''; ?> 
							<select class ="form-control skills" name="primary_country[]" multiple='multiple' required="required">
							<option value="">Select Primary Country</option>
								@if(!empty($data['primary_country']))
								@foreach($data['primary_country'] as $value)
									<option value="{{ $value->primary_country}}" <?php if (isset($data['selected_primary_country']) && in_array($value->primary_country, $data['selected_primary_country'])) { echo "selected"; } ?>>{{ $value->primary_country}}</option>
								@endforeach
								@endif
							</select>
						</div>

						<div class="mb-3">
							<label for="inputsecondary_country" class="form-label">Secondary Country</label>
							<?php  $errorClass =  !empty($errors->has('secondary_country')) ? 'is-invalid':''; ?>  
							<select class ="form-control skills" name="secondary_country[]" multiple='multiple'>
								<option value="">Select Secondary Country</option>
							@if(!empty($data['secondary_country']))
							@foreach($data['secondary_country'] as $value)
							<option value="{{ $value->secondary_country}}" <?php if (isset($data['selected_secondary_country']) && in_array($value->secondary_country, $data['selected_secondary_country'])) { echo "selected"; } ?>>{{ $value->secondary_country}}</option>
							 @endforeach
							 @endif
							</select>
			
						</div>
						<div class="mb-3">
							<label for="inputrequirements" class="form-label">Requirements</label>
							<?php  $errorClass =  !empty($errors->has('requirements')) ? 'is-invalid':''; ?>   
			                {!! Form::text('requirements', null, array('id'=>'requirements','placeholder' => 'Enter Current Company', 'class' => 'form-control '.$errorClass )) !!}
			                {!! !empty($errors->has('requirements')) ?'<div class="invalid-feedback"><span>'.$errors->first('requirements').'</span></div>' :'' !!}
						</div>
						<div class="mb-3">
							<label for="inputlinkedIn_url" class="form-label">linkedIn URL</label>
							<?php  $errorClass =  !empty($errors->has('linkedIn_url')) ? 'is-invalid':''; ?>   
			                {!! Form::text('linkedIn_url', null, array('id'=>'linkedIn_url','placeholder' => 'Enter linkedIn URL','url'=>'true','pattern'=>'https://.*' ,'class' => 'form-control linkedIn_url'.$errorClass )) !!}
			                {!! !empty($errors->has('linkedIn_url')) ?'<div class="invalid-feedback"><span>'.$errors->first('linkedIn_url').'</span></div>' :'' !!}
						</div>
						<div class="mb-3">
							<label for="inputup_url" class="form-label">UP URL</label>
							<?php  $errorClass =  !empty($errors->has('up_url')) ? 'is-invalid':''; ?>   
			                {!! Form::text('up_url', null, array('id'=>'up_url','placeholder' => 'Enter up URL','url'=>'true','pattern'=>'https://.*' , 'class' => 'form-control up_url'.$errorClass )) !!}
			                {!! !empty($errors->has('up_url')) ?'<div class="invalid-feedback"><span>'.$errors->first('up_url').'</span></div>' :'' !!}
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
  placeholder: "Select a Countries",
  tokenSeparators: [',', ' ']
})
  	
</script>



<script>
	jQuery('.mobile_number').keyup(function () { 
    this.value = this.value.replace(/[^0-9\.]/g,'');
});
// $('.primary_mobile_number').keyup(function(e){
//   if (/\D/g.test(this.value)) {
//     // Filter non-digits from input value.
//     this.value = this.value.replace(/\D/g, '');
//   }
// });
</script>
