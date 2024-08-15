
@section('css') 
	<link href="{{ URL::asset('assets/plugins/Drag-And-Drop/dist/imageuploadify.min.css')}}" rel="stylesheet" />
	<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/css/select2.min.css" rel="stylesheet" />
@endsection

       	<div class="form-body mt-4">
		    <div class="row">
			   	<div class="col-lg-12">
		           	<div class="border border-3 p-4 rounded">
						 
						   <input type="hidden" name="candidate_id" id="candidate_id" value="<?php echo $data['candidate_id']; ?>">
						  
						<div class="mb-3">
							<label for="inputschool_university_name" class="form-label required">School/University/Certification Name</label>
							<?php  $errorClass =  !empty($errors->has('school_university_name')) ? 'is-invalid':''; ?>  
			                {!! Form::text('school_university_name', null, array('id'=>'school_university_name','placeholder' => 'Enter school/university/certification Name', 'required'=>'required', 'class' => 'form-control'.$errorClass )) !!}
			                {!! !empty($errors->has('school_university_name')) ?'<div class="invalid-feedback"><span>'.$errors->first('school_university_name').'</span></div>' :'' !!}
						</div>
		
					
						<div class="mb-3">
							<label for="inputpassout_year" class="form-label required">Passout Year</label>
							<?php  $errorClass =  !empty($errors->has('passout_year')) ? 'is-invalid':''; ?>   
			                {!! Form::date('passout_year', null, array('id'=>'passout_year','placeholder' => 'Enter Year', 'required'=>'required', 'class' => 'form-control datepicker'.$errorClass )) !!}
			                {!! !empty($errors->has('passout_year')) ?'<div class="invalid-feedback"><span>'.$errors->first('passout_year').'</span></div>' :'' !!}
						</div>
						
						<div class="mb-3">
							<label for="inputpercentage" class="form-label required">Percentage</label>
							<?php  $errorClass =  !empty($errors->has('percentage')) ? 'is-invalid':''; ?>   
			                {!! Form::text('percentage', null, array('id'=>'percentage','placeholder' => 'Enter Percentage', 'required'=>'required', 'class' => 'form-control'.$errorClass )) !!}
			                {!! !empty($errors->has('percentage')) ?'<div class="invalid-feedback"><span>'.$errors->first('percentage').'</span></div>' :'' !!}
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.9.1/themes/base/jquery-ui.css" />
<script src="https://code.jquery.com/ui/1.9.1/jquery-ui.js"></script>   
<script>
	$(function() {
    $( ".datepicker" ).datepicker({dateFormat: 'yy'});
});​
</script>     
<!-- <script> function validateAadhaar(){ 
var regexp = /^[2-9]{1}[0-9]{3}\s[0-9]{4}\s[0-9]{4}$/; 
var ano = document.getElementById("aadhar_card").value; 

if(regexp.test(ano)) { 
console.log("Valid Aadhaar Number"); 
return true; 
}else{ 
console.log("Invalid Aadhaar Number"); 
 return false; 
} } 
</script>
<script type="text/javascript">    
$(document).ready(function(){     
        
$(".pan").change(function () {      
var inputvalues = $(this).val();      
  var regex = /[A-Z]{5}[0-9]{4}[A-Z]{1}$/;    
  if(!regex.test(inputvalues)){      
  $(".pan").val("");    
  alert("invalid PAN no");    
  return regex.test(inputvalues);    
  }    
});      
    
});    
</script>    
<script type="text/javascript">    
$(document).ready(function(){     
        
$(".ifsc").change(function () {      
var inputvalues = $(this).val();      
  var reg = /[A-Z|a-z]{4}[0][a-zA-Z0-9]{6}$/;    
                if (inputvalues.match(reg)) {    
                    return true;    
                }    
                else {    
                     $(".ifsc").val("");    
                    alert("You entered invalid IFSC code");    
                    //document.getElementById("txtifsc").focus();    
                    return false;    
                }    
});      
    
});    
</script>    -->

