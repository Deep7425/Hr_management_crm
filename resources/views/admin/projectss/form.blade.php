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
.select2-results__option.select2-results__message {
  color: black;
}
.btn.btn-primary.btn-xs {
  width: 33px;
}
.milestone_name {
  width: 57px;
}

.milestone_details {
  width: 645px;
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
							<label for="inputclient_name" class="form-label required">Client Name</label>
							<select class ="form-control" name="client_name" id="client_name" required="required">
							<option value="">Select Client</option>
							
								
							@if(!empty($all_client_name))
								@foreach($all_client_name as $value)
								
								<option value="{{ $value->id}}">{{ $value->client_name}}</option>
								@endforeach
								@endif
							</select>
						</div>
						<div class="mb-3">
							
							
							<label for="inputproject_name" class="form-label required">Project Name</label>
							<?php  $errorClass =  !empty($errors->has('project_name')) ? 'is-invalid':''; ?>   
			                {!! Form::text('project_name', null, array('id'=>'project_name','placeholder' => 'Enter Project Name', 'required'=>'required', 'class' => 'form-control '.$errorClass )) !!}
			                {!! !empty($errors->has('project_name')) ?'<div class="invalid-feedback"><span>'.$errors->first('project_name').'</span></div>' :'' !!}
						</div>
						<div class="mb-3">
							
							<label for="inputteam_member" class="form-label required">Team member</label>
							<?php  $errorClass =  !empty($errors->has('team_member')) ? 'is-invalid':''; ?> 
							<select class ="form-control skills" name="team_member[]" multiple='multiple' required="required">
								@if(!empty($data['currentEmployee']))
								@foreach($data['currentEmployee'] as $value)
							
								
									<option value="{{ $value->employee_name}}" <?php if (isset($data['selected_team_member']) && in_array($value->employee_name, $data['selected_team_member'])) { echo "selected"; } ?>>{{ $value->employee_name}}</option>
								@endforeach
								@endif
							</select>
						</div>
						<div class="mb-3">
							<label for="inputproject_award_date" class="form-label required">Project Award Date</label>
							<?php  $errorClass =  !empty($errors->has('project_award_date')) ? 'is-invalid':''; ?>   
			                {!! Form::date('project_award_date', null, array('id'=>'project_award_date','placeholder' => 'Enter Date', 'required'=>'required', 'class' => 'form-control '.$errorClass )) !!}
			                {!! !empty($errors->has('project_award_date')) ?'<div class="invalid-feedback"><span>'.$errors->first('project_award_date').'</span></div>' :'' !!}
						</div>
						<div class="mb-3">
							
							
							<label for="inputtotal_amount" class="form-label required">Total Amount</label>
							<?php  $errorClass =  !empty($errors->has('total_amount')) ? 'is-invalid':''; ?>   
			                {!! Form::text('total_amount', null, array('id'=>'total_amount','placeholder' => 'Enter Total Amount','id'=>'pointspossible', 'required'=>'required', 'class' => 'form-control '.$errorClass )) !!}
			                {!! !empty($errors->has('total_amount')) ?'<div class="invalid-feedback"><span>'.$errors->first('total_amount').'</span></div>' :'' !!}
						</div>
						<!-- <div class="mb-3">
							
							
							<label for="inputdue_amount" class="form-label required">Due Amount</label>
							<?php  $errorClass =  !empty($errors->has('due_amount')) ? 'is-invalid':''; ?>   
			                {!! Form::text('due_amount', null, array('id'=>'due_amount','placeholder' => 'Enter Due Amount', 'required'=>'required', 'class' => 'form-control '.$errorClass )) !!}
			                {!! !empty($errors->has('due_amount')) ?'<div class="invalid-feedback"><span>'.$errors->first('due_amount').'</span></div>' :'' !!}
						</div> -->
						<div class="mb-3">
						<label for="input" class="form-label required">Project Milestones</label>
						
						<div class="row">
						<div id='TextBoxesGroup'>
						<div id="TextBoxDiv1">
					 
						
			<div class="row">
				<div class="col-sm mb-3">
		
				
					<input type="text" class="form-control  milestone_name" name="milestone_name[]" id="milestone_name" placeholder="Please enter milestone name" value="{{$new_milestone_name_number}}" required="required" readonly>			
					
				</div>
					<div class="col-sm mb-3">
					
					
					<input type="text" class="form-control milestone_details" name="milestone_details[]" id="milestone_details" placeholder="Please enter milestone details" value="" required="required">
					
					</div>
					<div class="col-sm mb-3">
					
					<input type="text" class="form-control pointsperc " name="percentage_project_amount[]" placeholder="Enter % of project amount" value="" required="required">
					
					</div>
					<div class="col-sm mb-3">
					
					<input type="text" class="form-control amount" name="totalproject_amount[]" placeholder="Total amount" value="" required="required">
					
					</div>
					<div class="col-sm mb-3">
					
					<input type="date" class="form-control" name="due_date[]" placeholder="Please enter due date" value="" required="required">
					
					</div>
					<div class="col-md-1"><button type="button" id='addButton' class="btn btn-primary btn-xs" style="color:white;">+</button></div>
				</div>
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
	
})
  	
</script>



<script>
	$(document).ready(function(){
    var counter = 2;
    $("#addButton").click(function () {
        /*if(counter>10){
          toastr.error("Only 10 textboxes allow");
          return false;
        }*/
        var newTextBoxDiv = $(document.createElement('div')).attr("id", 'TextBoxDiv' + counter);
        newTextBoxDiv.after().html('<br/><div class="row appendAttrDiv_'+counter+'"><div class="col-sm mb-3"><input type="text" class="form-control attr_name_en milestone_name" placeholder="Please enter milestone name" id="milestone_name" required="required" value="' + counter + '" readonly name="milestone_name[]"  id="textbox' + counter + '"  ></div><div class="col-sm mb-3"><input type="text" class="form-control attr_name_en milestone_details" placeholder="Please enter milestone details" required="required" name="milestone_details[]" id="textbox' + counter + '" value="" ></div><div class="col-sm mb-3"><input type="text" class="form-control attr_name_en pointsperc_'+counter+'" onkeyup=calculateAmount(this) data-count="'+counter+'" placeholder="Enter % of project amount" required="required" name="percentage_project_amount[]" id="textbox' + counter + '" value="" ></div><div class="col-sm mb-3"><input type="text" class="form-control attr_name_en amount_'+counter+'" name="totalproject_amount[]" placeholder="Total amount" required="required" id="textbox' + counter + '" value="" ></div><div class="col-sm mb-3"><input type="date" class="form-control attr_name_en" placeholder="Please enter due date" required="required" name="due_date[]" id="textbox' + counter + '" value="" ></div><a onclick="removeAttributeField('+counter+')" class="btn btn-primary btn-xs">-</a></div>');
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


function removeAttributeField(id) {
    $('.appendAttrDiv_'+id).remove();
}
</script>

<script>
	
	$(document).on('change', "#addButton",function(e){
		e.preventDefault();
		
		var new_milestone_name_number = "{{$new_milestone_name_number}}";
		  
		// var project = new_milestone_name_number.substring($project,3);
		//var project_val = $('#addButton :click').val();
		//var lastFive = project_val.substr(project_val.length - 3);
		// alert(lastFive);
		// var project = new_milestone_name_number.substring($project,3);
		// alert(project_val);
		if(project_val != ''){
			// alert($('#invoice_number').val())
			$('#milestone_name').val(new_milestone_name_number);
		}
	});
</script>
<script>
	$(function(){
    
    $('#pointspossible').on('input', function() {
      calculate();
    });
    $('.pointsperc').on('input', function() {
		
		//alert(id);
     	calculate();
    });

    function calculate(){
        var pPos = parseInt($('#pointspossible').val()); 
        var pEarned = parseInt($('.pointsperc').val());
        var percentage_project_amount="";
        if(isNaN(pPos) || isNaN(pEarned)){
            percentage_project_amount=" ";
           }else{
			percentage_project_amount = ((pEarned*pPos) / 100);
           }
        
        $('.amount').val(percentage_project_amount);
    }

});

	function calculateAmount($this) {
		var count = $($this).attr('data-count');

  	var pPos = parseInt($('#pointspossible').val()); 
    var pEarned = parseInt($($this).val());
    var percentage_project_amount="";

    if (isNaN(pPos) || isNaN(pEarned)) {
      percentage_project_amount="";
    } else {
			percentage_project_amount = ((pEarned*pPos) / 100);
    }
        
    $('.amount_'+count).val(percentage_project_amount);
  }

	</script>