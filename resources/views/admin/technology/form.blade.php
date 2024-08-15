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
							<label for="inputName" class="form-label">Bank Name</label>
							<?php  $errorClass =  !empty($errors->has('technology_name')) ? 'is-invalid':''; ?>   
			                {!! Form::text('technology_name', null, array('id'=>'technology_name','placeholder' => 'Enter Technology', 'required'=>'required', 'class' => 'form-control '.$errorClass )) !!}
			                {!! !empty($errors->has('technology_name')) ?'<div class="invalid-feedback"><span>'.$errors->first('technology_name').'</span></div>' :'' !!}

						<div class="mb-3 mt-3">
						    <div class="d-grid">
	                           <button type="submit" class="btn btn-light">{{$data['button']}}</button>
						    </div>		  
			            </div>
		            </div>
			   	</div>
			</div>
	   </div><!--end row-->
	</div>
</div>
