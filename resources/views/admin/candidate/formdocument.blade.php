
@section('css') 
	<link href="{{ URL::asset('assets/plugins/Drag-And-Drop/dist/imageuploadify.min.css')}}" rel="stylesheet" />
	<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/css/select2.min.css" rel="stylesheet" />
@endsection

       	<div class="form-body mt-4">
		    <div class="row">
			   	<div class="col-lg-12">
		           	<div class="border border-3 p-4 rounded">
						 
						   <input type="hidden" name="candidate_id" id="candidate_id" value="<?php echo $data['candidate_id']; ?>">
						   <div class="row">
						<div class="mb-3 col-sm-6">
							<label for="inputaadhar_card" class="form-label required">Aadhar Card</label>
							<?php  $errorClass =  !empty($errors->has('aadhar_card')) ? 'is-invalid':''; ?>  
			                {!! Form::text('aadhar_card', null, array('id'=>'aadhar_card','placeholder' => 'Enter aadhar card', 'required'=>'required', 'class' => 'form-control aadhar_card'.$errorClass )) !!}
			                {!! !empty($errors->has('aadhar_card')) ?'<div class="invalid-feedback"><span>'.$errors->first('aadhar_card').'</span></div>' :'' !!}
							<span id="lblError" class="error"></span>
						</div>
						<div class="mb-3 col-sm-6">
							<label for="inputMobile" class="form-label">Aadhar Image</label>
						
							<div class="form-group input-group">
	                        	@if(isset($data->aadhar_card_image))
                                    <div id="image_preview"><img src="{{ $data->aadhar_card_image }}"></div>

                    
	                            @endif

	            
	                            <div class="form-control">
	                                <label for="files">Select File</label>
	                                <input type="file" id="aadhar_card_image" name="aadhar_card_image" class="form-control">
	                            </div>
								
	                         </div>
	                    </div>
					</div>
					<div class="row">
						<div class="mb-3 col-sm-6">
							<label for="inputpan_card" class="form-label required">Pan Card</label>
							<?php  $errorClass =  !empty($errors->has('pan_card')) ? 'is-invalid':''; ?>   
			                {!! Form::text('pan_card', null, array('id'=>'pan_card','placeholder' => 'Enter pan card', 'required'=>'required', 'class' => 'form-control pan'.$errorClass )) !!}
			                {!! !empty($errors->has('pan_card')) ?'<div class="invalid-feedback"><span>'.$errors->first('pan_card').'</span></div>' :'' !!}
						</div>
						<div class="mb-3 col-sm-6">
							<label for="inputMobile" class="form-label">Pan card  Image</label>
						
							<div class="form-group input-group">
	                        	@if(isset($data->pan_card_image))
                                    <div id="image_preview"><img src="{{ $data->pan_card_image }}"></div>

                    
	                            @endif

	            
	                            <div class="form-control">
	                                <label for="files">Select File</label>
	                                <input type="file" id="pan_card_image" name="pan_card_image" class="form-control">
	                            </div>
								
	                         </div>
	                    </div>
						</div>
						<div class="mb-3">
							<label for="inputbank_account_number" class="form-label required">Bank Account Number</label>
							<?php  $errorClass =  !empty($errors->has('bank_account_number')) ? 'is-invalid':''; ?>   
			                {!! Form::text('bank_account_number', null, array('id'=>'bank_account_number','placeholder' => 'Enter Account card', 'required'=>'required', 'class' => 'form-control'.$errorClass )) !!}
			                {!! !empty($errors->has('bank_account_number')) ?'<div class="invalid-feedback"><span>'.$errors->first('bank_account_number').'</span></div>' :'' !!}
						</div>
						<div class="mb-3">
							<label for="inputbank_IFSC_code" class="form-label required">IFSC Code</label>
							<?php  $errorClass =  !empty($errors->has('bank_IFSC_code')) ? 'is-invalid':''; ?>   
			                {!! Form::text('bank_IFSC_code', null, array('id'=>'bank_IFSC_code','placeholder' => 'Enter IFSC Code', 'required'=>'required', 'class' => 'form-control ifsc'.$errorClass )) !!}
			                {!! !empty($errors->has('bank_IFSC_code')) ?'<div class="invalid-feedback"><span>'.$errors->first('bank_IFSC_code').'</span></div>' :'' !!}
						</div>
						<div class="mb-3">
							<label for="inputbank_name" class="form-label required">Bank Name</label>
							<?php  $errorClass =  !empty($errors->has('bank_name')) ? 'is-invalid':''; ?>   
			                {!! Form::text('bank_name', null, array('id'=>'bank_name','placeholder' => 'Enter Bank Name', 'required'=>'required', 'class' => 'form-control'.$errorClass )) !!}
			                {!! !empty($errors->has('bank_name')) ?'<div class="invalid-feedback"><span>'.$errors->first('bank_name').'</span></div>' :'' !!}
						</div>
						<div class="mb-3">
							<label for="inputMobile" class="form-label">Browser Image</label>
						
							<div class="form-group input-group">
	                        	@if(isset($data->image))
                                    <div id="image_preview"><img src="{{ $data->image }}"></div>

                    
	                            @endif

	            
	                            <div class="form-control">
	                                <label for="files">Select File</label>
	                                <input type="file" id="image" name="image" class="form-control">
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
           

<!-- <script type="text/javascript">
    function ValidateAadhaar() {
        var aadhaar = document.getElementById("aadhar_card").value;
        var lblError = document.getElementById("lblError");
        lblError.innerHTML = "";
        var expr = /^([0-9]{4}[0-9]{4}[0-9]{4}$)|([0-9]{4}\s[0-9]{4}\s[0-9]{4}$)|([0-9]{4}-[0-9]{4}-[0-9]{4}$)/;
        if (!expr.test(aadhaar)) {
            lblError.innerHTML = "Invalid Aadhaar Number";
        }
    }
</script> -->
<script type="text/javascript">    
$(document).ready(function(){     
        
$(".aadhar_card").change(function () {      
var inputvalues = $(this).val();      
  var regex = /^([0-9]{4}[0-9]{4}[0-9]{4}$)|([0-9]{4}\s[0-9]{4}\s[0-9]{4}$)|([0-9]{4}-[0-9]{4}-[0-9]{4}$)/;    
  if(!regex.test(inputvalues)){      
  $(".aadhar_card").val("");    
  alert("Invalid Aadhaar Number");    
  return regex.test(inputvalues);    
  }    
});      
    
});    
</script> 

<script type="text/javascript">    
$(document).ready(function(){     
        
$(".pan").change(function () {      
var inputvalues = $(this).val();      
  var regex = /[A-Z]{5}[0-9]{4}[A-Z]{1}$/;    
  if(!regex.test(inputvalues)){      
  $(".pan").val("");    
  alert("Invalid PAN Number");    
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
</script>   