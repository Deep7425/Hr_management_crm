@extends('layouts.master')
@section('content')
<!--start page wrapper -->
<div class="page-wrapper">
    <div class="page-content">

        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">View Profile</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">View</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->
        <div class="card">
            <div class="card-body">
                <!-- <div class="card-title">
                    <h5 class="mb-0">Available breakpoints</h5>
                </div>
                <hr/> -->
                <div class="table-responsive">
                <div class="card">
  	<div class="card-body p-4">
	  	<!-- <h5 class="card-title">Add New</h5>
	  	<hr/> -->
       	<div class="form-body mt-4">
		    <div class="row">
			   	<div class="col-lg-12">
		           	<div class="border border-3 p-4 rounded">
					   <!-- <input type="hidden" name="employee_id" value="">
					   <input type="hidden" name="client_id" value=""> -->
					   <div class="mb-3">
							<label for="inputclient_name" class="form-label required">Client Name</label>
							<select readonly class ="form-control" name="client_name" id="client_name" readonly="readonly" disabled="true">
							<option value="">Select Client</option>
							
								
							@if(!empty($all_client_name))
								@foreach($all_client_name as $value)
								<option value="{{ $value->id}}" <?php  echo isset($data['client_name']) &&  ($data['client_name'] == $value->id)  ? 'selected' : ''?> >{{ $value->client_name}}</option>
								@endforeach
								@endif
							</select>
						</div>
						<div class="mb-3">
							
							
							<label for="inputproject_name" class="form-label required">Project Name</label>
							<?php  $errorClass =  !empty($errors->has('project_name')) ? 'is-invalid':''; ?>   
			                {!! Form::text('project_name', $data->project_name, array('id'=>'project_name','placeholder' => 'Enter Project Name', 'required'=>'required','readonly'=>'readonly', 'class' => 'form-control '.$errorClass )) !!}
			                {!! !empty($errors->has('project_name')) ?'<div class="invalid-feedback"><span>'.$errors->first('project_name').'</span></div>' :'' !!}
						</div>
						
						<div class="mb-3">
							<label for="inputproject_award_date" class="form-label required">Project Award Date</label>
							<?php  $errorClass =  !empty($errors->has('project_award_date')) ? 'is-invalid':''; ?>   
			                {!! Form::date('project_award_date', $data->project_award_date, array('id'=>'project_award_date','placeholder' => 'Enter Date', 'required'=>'required','readonly'=>'readonly', 'class' => 'form-control '.$errorClass )) !!}
			                {!! !empty($errors->has('project_award_date')) ?'<div class="invalid-feedback"><span>'.$errors->first('project_award_date').'</span></div>' :'' !!}
						</div>
						<div class="mb-3">
							
							
							<label for="inputtotal_amount" class="form-label required">Total Amount</label>
							<?php  $errorClass =  !empty($errors->has('total_amount')) ? 'is-invalid':''; ?>   
			                {!! Form::text('total_amount', $data->total_amount, array('id'=>'total_amount','placeholder' => 'Enter Total Amount','id'=>'pointspossible','readonly'=>'readonly', 'required'=>'required', 'class' => 'form-control '.$errorClass )) !!}
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
		
				@if(count($data['milestone_details']) > 0)
					@for($i = 0; $i < count($data['milestone_details']); $i++)
					<input type="text" class="form-control  milestone_name" name="milestone_name[]" id="milestone_name" placeholder="Please enter milestone name" value="{{$data['milestone_name'][$i]}}" required="required" readonly>			
					@endfor
				    @endif
				</div>
					<div class="col-sm mb-3">
					
					@if(count($data['milestone_details']) > 0)
					@for($i = 0; $i < count($data['milestone_details']); $i++)
					<input type="text" class="form-control milestone_details" name="milestone_details[]" id="milestone_details" placeholder="Please enter milestone details" value="{{$data['milestone_details'][$i]}}" required="required" readonly>
					@endfor
				    @endif
					</div>
					<div class="col-sm mb-3">
					@if(count($data['percentage_project_amount']) > 0)
					@for($i = 0; $i < count($data['percentage_project_amount']); $i++)
					<input type="text" class="form-control pointsperc" name="percentage_project_amount[]" placeholder="Enter % of project amount" value="{{$data['percentage_project_amount'][$i]}}" required="required" readonly>
					@endfor
				    @endif
					</div>
					<div class="col-sm mb-3">
					@if(count($data['totalproject_amount']) > 0)
					@for($i = 0; $i < count($data['totalproject_amount']); $i++)
					<input type="text" class="form-control amount" name="totalproject_amount[]" placeholder="Total amount" value="{{$data['totalproject_amount'][$i]}}" required="required" readonly>
					@endfor
				    @endif
					</div>
					<div class="col-sm mb-3">
					@if(count($data['due_date']) > 0)
					@for($i = 0; $i < count($data['due_date']); $i++)
					<input type="date" class="form-control" name="due_date[]" placeholder="Please enter due date" value="{{$data['due_date'][$i]}}" required="required" readonly>
					@endfor
				    @endif
					</div>
					<!-- <div class="col-md-1"><button type="button" id='addButton' class="btn btn-primary btn-xs" style="color:white;">+</button></div> -->
				</div>
			</div>
		</div>
						
						
			            <div class="mb-3">
						    <div class="d-grid">
	                           <!-- <button type="submit" class="btn btn-light">Save</button> -->
						    </div>		  
			            </div>
		            </div>
			   	</div>
			</div>
	   </div><!--end row-->
	</div>
</div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--end page wrapper -->

@endsection
