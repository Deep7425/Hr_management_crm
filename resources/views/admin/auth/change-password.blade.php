@extends('layouts.master')

@section('content')
  <!--start page wrapper -->
  <div class="page-wrapper">
    <div class="page-content">
      <!--breadcrumb-->
      <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Change Password</div>
        <div class="ps-3">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
              <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
              </li>
              <li class="breadcrumb-item active" aria-current="page">Change Password</li>
            </ol>
          </nav>
        </div>
      </div>
      <!--end breadcrumb-->
      <div class="container">
        <div class="main-body">
          <div class="row">
            <div class="col-lg-12">
              <form method="POST" action="{{ route('admin.change-password') }}" id="change_password">
              @csrf
                <div class="card">
                  <div class="card-body p-4">
                    <div class="row mb-3">
                        <div class="col-sm-3">
                          <h6 class="mb-0">Current Password</h6>
                        </div>
                        <div class="col-sm-9">
                          <?php  $errorClass =  !empty($errors->has('current_password')) ? 'is-invalid':''; ?>
                            <div class="input-group" id="show_hide_password">
                              <input type="password" name="current_password" placeholder="Current Password" class="form-control border-end-0 {{$errorClass}}" data-parsley-required-message="Please enter your old password." data-parsley-required>
                              <a href="javascript:void(0);" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
                              <!-- {!! !empty($errors->has('current_password')) ?'<div class="invalid-feedback"><span>'.$errors->first('current_password').'</span></div>' :'' !!} -->
                            </div>
                        </div>
                      </div>

                   <div class="row mb-3">
                          <div class="col-sm-3">
                            <h6 class="mb-0">New Password</h6>
                          </div>
                          <div class="col-sm-9">
                            <?php  $errorClass =  !empty($errors->has('new_password')) ? 'is-invalid':''; ?>
                              <div class="input-group" id="show_hide_password1">
								                <input type="password" name="new_password" placeholder="New Password" class="form-control border-end-0 {{$errorClass}}" minlength="8" data-parsley-minlength="8"  data-parsley-required-message="Please enter your password." data-parsley-pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*()_+=]).*" data-parsley-pattern-message="Your password must contain at least (1) lowercase, (1) uppercase letter and (1) special character." data-parsley-required id="password123">
								                <a href="javascript:void(0);" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
                                <!-- {!! !empty($errors->has('new_password')) ?'<div class="invalid-feedback"><span>'.$errors->first('new_password').'</span></div>' :'' !!} -->
                              </div>
                          </div>
                        </div>
                        <div class="row mb-3">
                          <div class="col-sm-3">
                            <h6 class="mb-0">Confirm Password</h6>
                          </div>
                          <div class="col-sm-9">
                            <div class="input-group" id="show_hide_password2">
                              <input type="password" name="confirm_password" placeholder="Confirm Password" data-parsley-equalto-message="New Password & Confirm Password shouldn't match" minlength="8" data-parsley-minlength="8" data-parsley-equalto="#password123" class="form-control border-end-0 {{$errorClass}}" id="confirm_password" >
                              <a href="javascript:void(0);" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>    
                              <!-- {!! !empty($errors->has('confirm_password')) ?'<div class="invalid-feedback"><span>'.$errors->first('confirm_password').'</span></div>' :'' !!} -->
                            </div>
                          </div>
                        </div>

                    <div class="row">
                      <div class="col-sm-3"></div>
                      <div class="col-sm-9">
                        <input type="submit" class="btn btn-light px-4" value="Update Password" />
                      </div>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--end page wrapper -->
  <!--start overlay-->
  <div class="overlay toggle-icon"></div>
  <!--end overlay-->
  <!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
  <!--End Back To Top Button-->

<script>
$(document).ready(function () {
  $("#show_hide_password a").on('click', function (event) {
		event.preventDefault();
		if ($('#show_hide_password input').attr("type") == "text") {
			$('#show_hide_password input').attr('type', 'password');
			$('#show_hide_password i').addClass("bx-hide");
			$('#show_hide_password i').removeClass("bx-show");
		} else if ($('#show_hide_password input').attr("type") == "password") {
			$('#show_hide_password input').attr('type', 'text');
			$('#show_hide_password i').removeClass("bx-hide");
			$('#show_hide_password i').addClass("bx-show");
		}
	});
	$("#show_hide_password1 a").on('click', function (event) {
		event.preventDefault();
		if ($('#show_hide_password1 input').attr("type") == "text") {
			$('#show_hide_password1 input').attr('type', 'password');
			$('#show_hide_password1 i').addClass("bx-hide");
			$('#show_hide_password1 i').removeClass("bx-show");
		} else if ($('#show_hide_password1 input').attr("type") == "password") {
			$('#show_hide_password1 input').attr('type', 'text');
			$('#show_hide_password1 i').removeClass("bx-hide");
			$('#show_hide_password1 i').addClass("bx-show");
		}
	});
  $("#show_hide_password2 a").on('click', function (event) {
		event.preventDefault();
		if ($('#show_hide_password2 input').attr("type") == "text") {
			$('#show_hide_password2 input').attr('type', 'password');
			$('#show_hide_password2 i').addClass("bx-hide");
			$('#show_hide_password2 i').removeClass("bx-show");
		} else if ($('#show_hide_password2 input').attr("type") == "password") {
			$('#show_hide_password2 input').attr('type', 'text');
			$('#show_hide_password2 i').removeClass("bx-hide");
			$('#show_hide_password2 i').addClass("bx-show");
		}
	});
});


$("#change_password").on('submit',function(e){
      e.preventDefault();
      var _this=$(this); 
      var formData = new FormData(this);
        $.ajax({
          url:'{{ route("admin.change-password") }}',
          dataType:'json',
          data:formData,
          cache:false,
          contentType: false,
          processData: false,
          type:'POST',
          success:function(result){
              if(result.status){
                $('#change_password')[0].reset();
                $('#change_password').parsley().reset();
                toastr.success(result.message)
              }else{
                toastr.error(result.message)
              }
          },
          error:function(jqXHR,textStatus,textStatus){
            if(jqXHR.responseJSON.errors){
              $.each(jqXHR.responseJSON.errors, function( index, value ) {
                toastr.error(value)
              });
            }else{
              toastr.error(jqXHR.responseJSON.message)
            }
          }
        });
        return false;   
    });
</script>
@endsection
