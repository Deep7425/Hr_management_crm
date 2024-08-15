<div class="card">
  	<div class="card-body p-4">
	  	<!-- <h5 class="card-title">Add New</h5>
	  	<hr/> -->
       	<div class="form-body mt-4">
		    <div class="row">
			   	<div class="col-lg-12">
		           	<div class="border border-3 p-4 rounded">

						<div class="mb-3">
						<div class="mb-3">
							<label for="inputName" class="form-label">Department</label>
							<?php  $errorClass =  !empty($errors->has('department_name')) ? 'is-invalid':''; ?>   
			                {!! Form::text('department_name', null, array('id'=>'department_name','placeholder' => 'Enter Department', 'required'=>'required', 'class' => 'form-control '.$errorClass )) !!}
			                {!! !empty($errors->has('department_name')) ?'<div class="invalid-feedback"><span>'.$errors->first('department_name').'</span></div>' :'' !!}

						<div class="mb-3 mt-3">
						    <div class="d-grid">
	                           <button type="submit" class="btn btn-light"> {{ $data['button'] }}</button>
						    </div>		  
			            </div>
		            </div>
			   	</div>
			</div>
	   </div><!--end row-->
	</div>
</div>
