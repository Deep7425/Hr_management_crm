@section('css') 
	<link href="{{ URL::asset('assets/plugins/Drag-And-Drop/dist/imageuploadify.min.css')}}" rel="stylesheet" />
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
							<label for="inputName" class="form-label">Name</label>
							<?php  $errorClass =  !empty($errors->has('name')) ? 'is-invalid':''; ?>   
			                {!! Form::text('name', null, array('id'=>'name','placeholder' => 'Enter Name', 'required'=>'required', 'class' => 'form-control '.$errorClass )) !!}
			                {!! !empty($errors->has('name')) ?'<div class="invalid-feedback"><span>'.$errors->first('name').'</span></div>' :'' !!}
						</div>
						<div class="mb-3">
							<label for="inputEmail" class="form-label">Email</label>
							<?php $errorClass =  !empty($errors->has('email')) ? 'is-invalid':''; ?>
			                {!! Form::email('email', null, array('id'=>isset($data->email)?true:false,'placeholder' => 'Email', 'required'=>'required', 'class' => 'form-control '.$errorClass)) !!}
			                {!! !empty($errors->has('email')) ?'<div class="invalid-feedback"><span>'.$errors->first('email').'</span></div>' :'' !!}
						</div>
						<div class="mb-3">
							<label for="inputPassword" class="form-label">Password</label>
							<?php  $errorClass =  !empty($errors->has('password')) ? 'is-invalid':''; ?>   
							<input placeholder="Password" class="form-control " name="password" type="password">
			                <!-- {!! Form::text('password', null, array('id'=>'password','placeholder' => 'Enter password', 'required'=>'required', 'class' => 'form-control '.$errorClass )) !!} -->
			                {!! !empty($errors->has('password')) ?'<div class="invalid-feedback"><span>'.$errors->first('password').'</span></div>' :'' !!}
						</div>
						<!-- <div class="mb-3">
							<label for="inputEmail" class="form-label">Secondory Email</label>
							<?php $errorClass =  !empty($errors->has('second_email')) ? 'is-invalid':''; ?>
			                {!! Form::email('second_email', null, array('id'=>isset($data->second_email)?true:false,'placeholder' => 'Secondory Email', 'class' => 'form-control '.$errorClass)) !!}
			                {!! !empty($errors->has('second_email')) ?'<div class="invalid-feedback"><span>'.$errors->first('second_email').'</span></div>' :'' !!}
						</div>
						<div class="mb-3">
							<label for="input_phone_number" class="form-label">Phone Number</label>
							<?php  $errorClass =  !empty($errors->has('phone_number')) ? 'is-invalid':''; ?>   
			                {!! Form::text('phone_number', null, array('id'=>'phone_number', 'maxlength'=>'20','placeholder' => 'Enter Phone Number', 'class' => 'form-control phone_number '.$errorClass )) !!}
			                {!! !empty($errors->has('phone_number')) ?'<div class="invalid-feedback"><span>'.$errors->first('phone_number').'</span></div>' :'' !!}
						</div>
						<div class="mb-3">
							<label for="input_second_phone_number" class="form-label">Secondory Phone Number</label>
							<?php  $errorClass =  !empty($errors->has('second_phone_number')) ? 'is-invalid':''; ?>   
			                {!! Form::text('second_phone_number', null, array('id'=>'second_phone_number', 'maxlength'=>'20','placeholder' => 'Enter Secondory Phone Number', 'class' => 'form-control second_phone_number '.$errorClass )) !!}
			                {!! !empty($errors->has('second_phone_number')) ?'<div class="invalid-feedback"><span>'.$errors->first('second_phone_number').'</span></div>' :'' !!}
						</div>
						<div class="mb-3">
							<label for="inputMobile" class="form-label">Attach File</label>
	                        <div class="input-group">
	                        	@if(isset($data) && $data->file)
                                    <div id="image_preview"> <a href="{{ url('public/'.$data->file) }}" target="_blank"><img id="previewing" src="{{ url('images/download.jpg') }}"></a></div>
                                @else
	                            	<div id="image_preview"><img id="previewing" src="{{ URL::asset('assets/images/image.png')}}"></div>
	                            @endif
	                            <div class="form-control" onclick="document.getElementById('file').click()">
	                                <label for="files">Select File</label>
	                                <input type="file" id="file" name="file" style="visibility:hidden;" class="form-control">
	                            </div>
	                         </div>
	                    </div>
						<div class="mb-3">
							<label for="inputLocation" class="form-label">Location</label>
							<?php  $errorClass =  !empty($errors->has('location')) ? 'is-invalid':''; ?>   
			                {!! Form::text('location', null, array('id'=>'location','placeholder' => 'Enter location', 'class' => 'form-control '.$errorClass )) !!}
			                {!! !empty($errors->has('location')) ?'<div class="invalid-feedback"><span>'.$errors->first('location').'</span></div>' :'' !!}
						</div>
						<div class="mb-3">
							<label for="inputSecondLocation" class="form-label">Secondary Location</label>
							<?php  $errorClass =  !empty($errors->has('second_location')) ? 'is-invalid':''; ?>   
			                {!! Form::text('second_location', null, array('id'=>'second_location','placeholder' => 'Enter second location', 'class' => 'form-control '.$errorClass )) !!}
			                {!! !empty($errors->has('second_location')) ?'<div class="invalid-feedback"><span>'.$errors->first('second_location').'</span></div>' :'' !!}
						</div>
						<div class="mb-3">
							<label for="inputSource" class="form-label">Source</label>
							<select class ="form-control" name="source"  id="source">
								<option value="">Select source</option>
								<option value="UP" <?php echo isset($data) && $data->source == 'UP' ? 'selected' : '' ?>>UP</option>
								<option value="BA" <?php echo isset($data) && $data->source == 'BA' ? 'selected' : '' ?>>BA</option>
								<option value="Other" <?php echo isset($data) && $data->source == 'Other' ? 'selected' : '' ?>>Other</option>
							</select>
						</div>
						<div class="mb-3 up_link_div" style="display:none;">
							<label for="inputLink" class="form-label">Link</label>
			                {!! Form::text('up_link', null, array('id'=>'up_link','placeholder' => 'Enter Link', 'class' => 'form-control '.$errorClass )) !!}
						</div>
						<div class="mb-3 ba_credit_div" style="display:none;">
							<label for="inputCradit" class="form-label">Credit</label>
			                {!! Form::text('ba_credit', null, array('id'=>'ba_credit','placeholder' => 'Enter Credit', 'class' => 'form-control '.$errorClass )) !!}
						</div>
						<div class="mb-3 ba_screenshot_div" style="display:none;">
							<label for="inputLink" class="form-label">Screenshot</label>
							<label for="inputScreenshot" class="form-label">Screenshot</label>
	                        <div class="input-group">
	                        	@if(isset($data) && $data->image)
                                    <div id="image_preview"><img id="ba_screenshot_preview" src="{{ $data->ba_screenshot }}"></div>
                                @else
	                            	<div id="image_preview"><img id="ba_screenshot_preview" src="{{ URL::asset('assets/images/image.png')}}"></div>
	                            @endif
	                            <div class="form-control" onclick="document.getElementById('ba_screenshot').click()">
	                                <label for="files">Select Image</label>
	                                <input type="file" id="ba_screenshot" name="ba_screenshot" style="visibility:hidden;" class="form-control">
	                            </div>
	                         </div>
						</div>
						<div class="mb-3 other_name_div" style="display:none;">
							<label for="inputCradit" class="form-label">Name</label>
			                {!! Form::text('other_name', null, array('id'=>'other_name','placeholder' => 'Enter Name', 'class' => 'form-control '.$errorClass )) !!}
						</div>
						<div class="mb-3">
							<label for="input_message" class="form-label">Message</label>
							<?php  $errorClass =  !empty($errors->has('message')) ? 'is-invalid':''; ?>   
			                {!! Form::textarea('message',null, array('id'=>'message','class' => 'form-control ckeditor'.$errorClass )) !!}
			                {!! !empty($errors->has('message')) ?'<div class="invalid-feedback"><span>'.$errors->first('message').'</span></div>' :'' !!}
						</div>
						@if(isset($data) && !empty($data))
						<div class="mb-3">
							<label for="inputLinkedInURL" class="form-label">LinkedIn URL</label>
							<?php  $errorClass =  !empty($errors->has('linkedIn_url')) ? 'is-invalid':''; ?>   
			                {!! Form::text('linkedIn_url', null, array('id'=>'linkedIn_url','placeholder' => 'Enter LinkedIn URL', 'class' => 'form-control '.$errorClass )) !!}
			                {!! !empty($errors->has('linkedIn_url')) ?'<div class="invalid-feedback"><span>'.$errors->first('linkedIn_url').'</span></div>' :'' !!}
						</div>
						<div class="mb-3">
							<label for="inputProjectTitle" class="form-label">Project Title</label>
							<?php  $errorClass =  !empty($errors->has('project_title')) ? 'is-invalid':''; ?>   
			                {!! Form::text('project_title', null, array('id'=>'project_title','placeholder' => 'Enter Project Title', 'class' => 'form-control '.$errorClass )) !!}
			                {!! !empty($errors->has('project_title')) ?'<div class="invalid-feedback"><span>'.$errors->first('project_title').'</span></div>' :'' !!}
						</div>
						@endif -->
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
<script>
	jQuery('.phone_number').keyup(function () { 
		this.value = this.value.replace(/[^0-9\.]/g,'');
	});
	
	// $(document).ready(function(){
	// 	var source = "{{ isset($data) && !empty($data->source) ? $data->source : '' }}";
	// 	if(source == 'UP'){
	// 		$('.up_link_div').show();
	// 		$('.ba_credit_div').hide();
	// 		$('.ba_screenshot_div').hide();
	// 		$('.other_name_div').hide();
	// 	}else if(source == 'BA'){
	// 		$('.up_link_div').hide();
	// 		$('.ba_credit_div').show();
	// 		$('.ba_screenshot_div').show();
	// 		$('.other_name_div').hide();
	// 	}else if(source == 'Other'){
	// 		$('.up_link_div').hide();
	// 		$('.ba_credit_div').hide();
	// 		$('.ba_screenshot_div').hide();
	// 		$('.other_name_div').show();
	// 	}else{
	// 		$('.up_link_div').hide();
	// 		$('.ba_credit_div').hide();
	// 		$('.ba_screenshot_div').hide();
	// 		$('.other_name_div').hide();
	// 	}

	// 	$('#source').on('change', function(){
	// 		if($(this).val() == 'UP'){
	// 			$('.up_link_div').show();
	// 			$('.ba_credit_div').hide();
	// 			$('.ba_screenshot_div').hide();
	// 			$('.other_name_div').hide();
	// 		}else if($(this).val() == 'BA'){
	// 			$('.up_link_div').hide();
	// 			$('.ba_credit_div').show();
	// 			$('.ba_screenshot_div').show();
	// 			$('.other_name_div').hide();
	// 		}else if($(this).val() == 'Other'){
	// 			$('.up_link_div').hide();
	// 			$('.ba_credit_div').hide();
	// 			$('.ba_screenshot_div').hide();
	// 			$('.other_name_div').show();
	// 		}else{
	// 			$('.up_link_div').hide();
	// 			$('.ba_credit_div').hide();
	// 			$('.ba_screenshot_div').hide();
	// 			$('.other_name_div').hide();
	// 		}
	// 	});
	// });
	// $("#file").change(function(){
    //   var fileObj = this.files[0];
    //   var imageFileType = fileObj.type;
    //   var imageSize = fileObj.size;

    //   var file = $('#file')[0].files[0].name;
    //   $(this).prev('label').text(file);
    
    //   var match = ["image/jpeg","image/png","image/jpg"];
    //   if(!((imageFileType == match[0]) || (imageFileType == match[1]) || (imageFileType == match[2]))){
    //     $('#previewing').attr('src','images/image.png');
    //     toastr.error('Please Select A valid Image File <br> Note: Only jpeg, jpg and png Images Type Allowed!!');
    //     return false;
    //   }else{
    //     //console.log(imageSize);
    //     if(imageSize < 5000000){
    //       var reader = new FileReader();
    //       reader.onload = imageIsLoaded;
    //       reader.readAsDataURL(this.files[0]);
    //     }else{
    //       toastr.error('Images Size Too large Please Select Less Than 5MB File!!');
    //       return false;
    //     } 
    //   }  
    // });

    // function imageIsLoaded(e){
    //   //console.log(e);
    //   $("#file").css("color","green");
    //   $('#previewing').attr('src',e.target.result);
    // }
</script>
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
	})
</script> -->