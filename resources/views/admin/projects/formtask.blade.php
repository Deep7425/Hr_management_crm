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
.btn.btn-danger.btn-xs {
  width: 90px;
}
.btn.btn-primary.btn-xs {
  width: auto;
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
							
						    <input type="hidden" name="project_id" value="<?php echo $data['project_id']; ?>" >
							<label for="inputtask_name" class="form-label required">Task Name</label>
							<?php  $errorClass =  !empty($errors->has('task_name')) ? 'is-invalid':''; ?>   
			                {!! Form::text('task_name', null, array('id'=>'task_name','placeholder' => 'Enter Task Name', 'required'=>'required', 'class' => 'form-control '.$errorClass )) !!}
			                {!! !empty($errors->has('task_name')) ?'<div class="invalid-feedback"><span>'.$errors->first('task_name').'</span></div>' :'' !!}
						</div>
						
						<div class="mb-3">
						<label for="input" class="form-label required">Feature List</label>
						
			<div class="row">
			<div id='TextBoxesGroup'>
			<div id="TextBoxDiv1">

				<div class="row">
					<div class="col-sm mb-3">
					
				{!! Form::text('feature_list_one[]', null, array('id'=>'feature_list_one','placeholder' => 'Enter Task Name', 'required'=>'required', 'class' => 'form-control '.$errorClass )) !!}
					{!! !empty($errors->has('feature_list_one')) ?'<div class="invalid-feedback"><span>'.$errors->first('feature_list_one').'</span></div>' :'' !!}
					</div>
					<div class="col-sm mb-3">
				{!! Form::text('feature_list_two[]', null, array('id'=>'feature_list_two', 'class' => 'form-control '.$errorClass )) !!}
					{!! !empty($errors->has('feature_list_two')) ?'<div class="invalid-feedback"><span>'.$errors->first('feature_list_two').'</span></div>' :'' !!}
					</div>
					<div class="col-sm mb-3">
				{!! Form::text('feature_list_three[]', null, array('id'=>'feature_list_three', 'class' => 'form-control '.$errorClass )) !!}
					{!! !empty($errors->has('feature_list_three')) ?'<div class="invalid-feedback"><span>'.$errors->first('feature_list_three').'</span></div>' :'' !!}
					</div>
					<div class="col-sm mb-3">
				{!! Form::text('feature_list_four[]', null, array('id'=>'feature_list_four', 'class' => 'form-control '.$errorClass )) !!}
					{!! !empty($errors->has('feature_list_four')) ?'<div class="invalid-feedback"><span>'.$errors->first('feature_list_four').'</span></div>' :'' !!}
					</div>
					<div class="col-sm mb-3">
				{!! Form::text('feature_list_five[]', null, array('id'=>'feature_list_five', 'class' => 'form-control'.$errorClass )) !!}
					{!! !empty($errors->has('feature_list_five')) ?'<div class="invalid-feedback"><span>'.$errors->first('feature_list_five').'</span></div>' :'' !!}
					</div>
					<div class="col-md-1"><button type="button" id='addButton' class="btn btn-primary btn-xs" style="color:white;">+</button></div>
				</div>

				</div>
							<!-- <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <a href="#" class="btn btn-warning waves-effect waves-light m-r-10" data-dismiss="modal">Close</a>
                                       
                                    </div>
                                </div>
                            </div> -->
						</div>
						<div class="mb-3">
							<label for="inputsrs" class="form-label">SRS</label>
							<?php  $errorClass =  !empty($errors->has('srs')) ? 'is-invalid':''; ?>   
			                {!! Form::textarea('srs', null, array('id'=>'srs','class' => 'form-control ckeditor'.$errorClass )) !!}
			                {!! !empty($errors->has('srs')) ?'<div class="invalid-feedback"><span>'.$errors->first('srs').'</span></div>' :'' !!}
						</div>
						<div class="mb-3">
						<label for="inputtest_cases" class="form-label required">Test Cases</label>
						
						<div class="row">
						<div id='checkl'>
						<div id="TextBoxDiv1">
		
							<div class="row">
							<div class="col-md-1"><button type="button" id='checklist' class="btn btn-primary btn-xs" style="color:white;">+</button></div>
								<div class="mb-3">
							{!! Form::text('test_cases[]', null, array('id'=>'test_cases','placeholder' => 'Enter Test Cases', 'required'=>'required', 'class' => 'form-control '.$errorClass )) !!}
								{!! !empty($errors->has('test_cases')) ?'<div class="invalid-feedback"><span>'.$errors->first('test_cases').'</span></div>' :'' !!}
								</div>
								
							 </div>
						  </div>
						</div>
                        <div class="mb-3">
							<label for="inputMobile" class="form-label">Task Image</label>
	                        <div class="form-group input-group">
	                        
	                            	<div id="image_preview"><img id="previewing" src="{{ URL::asset('assets/images/image.png')}}"></div>
	                           

	                            <!-- <input type="file" id="file" name="image" class="form-control"> -->
	                            <!-- <label for="files" >{{__('backend.Select_Image')}}</label>
	                            <input type="file" id="file" name="image" style="visibility:hidden;" class="form-control"> -->
	                            <div class="form-control" onclick="document.getElementById('file').click()">
	                                <label for="files">Select Image</label>
	                                <input type="file" id="file" name="image" style="visibility:hidden;" class="form-control">
	                            </div>
	                         </div>
	                    </div>
                        <div class="mb-3">
							<label for="inputteam_member" class="form-label required">Team member</label>
							<?php   $errorClass =  !empty($errors->has('team_member')) ? 'is-invalid':''; ?> 
		
								@if(isset($data['team_member']))
								@foreach($data['team_member'] as $value)
								
								<input type="checkbox" id="team_member" name="team_member">
                                <label for="">{{ $value->team_member}}</label><br>
							
								@endforeach
								@endif
							
						</div>
						
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
<script src="{{ URL::asset('assets/plugins/Drag-And-Drop/dist/imageuploadify.min.js')}}"></script>
<script src="https://cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
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
    var counter = 2;
    $("#addButton").click(function () {
        /*if(counter>10){
          toastr.error("Only 10 textboxes allow");
          return false;
        }*/
        var newTextBoxDiv = $(document.createElement('div')).attr("id", 'TextBoxDiv' + counter);
        newTextBoxDiv.after().html('<br/><div class="row appendAttrDiv_'+counter+'"><div class="col-sm mb-3"><input type="text" class="form-control attr_name_en" name="feature_list_one[]" id="textbox' + counter + '" value="" ></div><div class="col-sm mb-3"><input type="text" class="form-control attr_name_en" name="feature_list_two[]" id="textbox' + counter + '" value="" ></div><div class="col-sm mb-3"><input type="text" class="form-control attr_name_en" name="feature_list_three[]" id="textbox' + counter + '" value="" ></div><div class="col-sm mb-3"><input type="text" class="form-control attr_name_ar" name="feature_list_four[]" id="textbox' + counter + '" value="" ></div><div class="col-sm mb-3"><input type="text" class="form-control attr_name_en" name="feature_list_five[]" id="textbox' + counter + '" value="" ></div><div class="col-md-1"><button id="addButton('+counter+')" class="btn btn-primary btn-xs" style="color:white;">+</button></div><a onclick="removeAttributeField('+counter+')" class="btn btn-primary btn-xs">-</a></div>');
        newTextBoxDiv.appendTo("#TextBoxesGroup");
        counter++;
    });
    $("#removeButton").click(function () {

      if(counter==2){
        toastr.error("one textbox is Required");
        return false;
      }
      counter--;
      $("#TextBoxDiv" + counter).remove();
    });
});




$(document).ready(function(){
    var counter = 2;
    $("#checklist").click(function () {
        /*if(counter>10){
          toastr.error("Only 10 textboxes allow");
          return false;
        }*/
        var newTextBoxDiv = $(document.createElement('div')).attr("id", 'TextBoxDiv' + counter);
        newTextBoxDiv.after().html('<br/><div class="row appendAttrDiv_'+counter+'"><div class="col-md-3"><input type="text" class="form-control attr_name_en" name="test_cases[]" id="textbox' + counter + '" value="" ></div><div class="col-md-1"><button type="button" id="checklist('+counter+')" class="btn btn-primary btn-xs" style="color:white;">+</button></div><a onclick="removeAttributeField('+counter+')" class="btn btn-primary btn-xs">-</a></div>');
        newTextBoxDiv.appendTo("#checkl");
        counter++;
    });
    $("#removeButton").click(function () {

      if(counter==2){
        toastr.error("one textbox is Required");
        return false;
      }
      counter--;
      $("#TextBoxDiv" + counter).remove();
    });
});

function removeAttributeField(id) {
    $('.appendAttrDiv_'+id).remove();
}

	</script>

<script>

$(".skills").select2({
  tags: true,
  tokenSeparators: [',', ' ']
})


  	
</script>
<script src="{{ URL::asset('assets/plugins/Drag-And-Drop/dist/imageuploadify.min.js')}}"></script>
<script>
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
</script>