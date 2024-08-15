@section('css') 
	<link href="{{ URL::asset('assets/plugins/Drag-And-Drop/dist/imageuploadify.min.css')}}" rel="stylesheet" />
@endsection

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
						<div class="mb-3">
							<label for="inputName" class="form-label required"> Name</label>
							<?php  $errorClass =  !empty($errors->has('client_name')) ? 'is-invalid':''; ?>   
			                {!! Form::text('client_name', null, array('id'=>'client_name','placeholder' => 'Enter Client Name', 'required'=>'required', 'class' => 'form-control '.$errorClass )) !!}
			                {!! !empty($errors->has('client_name')) ?'<div class="invalid-feedback"><span>'.$errors->first('client_name').'</span></div>' :'' !!}
						</div>
						
						<div class="mb-3">
						
						<div class="mb-3">
							<label for="inputEmail" class="form-label required">Email Address</label>
							<?php $errorClass =  !empty($errors->has('email')) ? 'is-invalid':''; ?>
			                {!! Form::email('email', null, array('id'=>isset($data->email)?true:false,'placeholder' => 'Enter Client Email', 'required'=>'required', 'class' => 'form-control '.$errorClass)) !!}
			                {!! !empty($errors->has('email')) ?'<div class="invalid-feedback"><span>'.$errors->first('email').'</span></div>' :'' !!}
						</div>
						<div class="mb-3">
							<label for="inputclient_mobile_number" class="form-label required">Mobile Number</label>
							<?php  $errorClass =  !empty($errors->has('client_mobile_number')) ? 'is-invalid':''; ?>   
			                {!! Form::text('client_mobile_number', null, array('id'=>'client_mobile_number', 'maxlength'=>'20','placeholder' => 'Enter Mobile Number', 'required'=>'required', 'class' => 'form-control client_mobile_number '.$errorClass )) !!}
			                {!! !empty($errors->has('client_mobile_number')) ?'<div class="invalid-feedback"><span>'.$errors->first('client_mobile_number').'</span></div>' :'' !!}
						</div>

						<div class="mb-3">
							<label for="inputclient_GST_number" class="form-label required">GST Number</label>
							<?php  $errorClass =  !empty($errors->has('client_GST_number')) ? 'is-invalid':''; ?>   
			                {!! Form::text('client_GST_number', null, array('id'=>'client_GST_number','placeholder' => 'Enter GST Number', 'required'=>'required', 'class' => 'form-control client_GST_number '.$errorClass )) !!}
			                {!! !empty($errors->has('client_GST_number')) ?'<div class="invalid-feedback"><span>'.$errors->first('client_GST_number').'</span></div>' :'' !!}
						</div>



						<div class="mb-3">
							<label for="inputclient_address" class="form-label required">Address</label>
							<?php  $errorClass =  !empty($errors->has('client_address')) ? 'is-invalid':''; ?>   
			                {!! Form::textarea('client_address',null, array('id'=>'client_address','required'=>'required','class' => 'form-control ckeditor'.$errorClass )) !!}
			                {!! !empty($errors->has('client_address')) ?'<div class="invalid-feedback"><span>'.$errors->first('client_address').'</span></div>' :'' !!}
						</div>
			              
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
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
<script>
	jQuery('.client_mobile_number').keyup(function () { 
    this.value = this.value.replace(/[^0-9\.]/g,'');
});
</script>
