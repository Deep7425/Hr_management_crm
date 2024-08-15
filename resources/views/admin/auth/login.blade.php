@extends('layouts.app')

@section('content')
	<!--wrapper-->
	<div class="wrapper">
		<div class="section-authentication-signin d-flex align-items-center justify-content-center my-5 my-lg-0">
			<div class="container-fluid">
				<div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
					<div class="col mx-auto">
						<div class="mb-4 text-center">
							<img src="{{ asset('images/logo.webp') }}" width="180" alt="HR Management System" />
						</div>
						<div class="card">
							<div class="card-body">
								<div class="border p-4 rounded">
									<div class="text-center">
										<h3 class="">Sign in</h3>
										<!-- <p>Don't have an account yet? <a href="authentication-signup.html">Sign up here</a> -->
										</p>
									</div>
									<!-- <div class="d-grid">
										<a class="btn my-4 shadow-sm btn-light" href="javascript:;"> <span class="d-flex justify-content-center align-items-center">
				                          <img class="me-2" src="{{ asset('assets/images/icons/search.svg') }}" width="16" alt="Image Description">
				                          <span>Sign in with Google</span>
											</span>
										</a> <a href="javascript:;" class="btn btn-light"><i class="bx bxl-facebook"></i>Sign in with Facebook</a>
									</div>
									<div class="login-separater text-center mb-4"> <span>OR SIGN IN WITH EMAIL</span>
										<hr/>
									</div> -->
									<div class="form-body">
										<form method="POST" class="form-horizontal form-material row align-items-center" id="loginform" action="{{ route('admin.login') }}">
											@csrf
											@if (Session::has('error_msg'))
							                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
							                        <h6>{{ Session::get('error_msg') }}</h6> {{ session('danger') }}
							                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
							                            <span aria-hidden="true">×</span>
							                        </button>
							                    </div>
							                    <!-- <span style="width: 100%; margin-top: 0.25rem;font-size: 80%;color: #f62d51;"><strong>{{ Session::get('error_msg') }}</strong></span> -->
						                    @endif
						                    @if (Session::has('message'))
							                    <div class="alert alert-success alert-dismissible fade show" role="alert">
							                        <h6>{{ Session::get('message') }}</h6> {{ session('danger') }}
							                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
							                            <span aria-hidden="true">×</span>
							                        </button>
							                    </div>
							                    <!-- <span style="width: 100%; margin-top: 0.25rem;font-size: 80%;color: #f62d51;"><strong>{{ Session::get('error_msg') }}</strong></span> -->
						                    @endif
											<div class="col-12">
												<label for="inputEmailAddress" class="form-label">Email Address</label>
												<input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="inputEmailAddress" placeholder="Email Address" value="{{isset($_COOKIE["admin_email"]) ? $_COOKIE["admin_email"] :  old('email') }}">
												@error('email')
						                            <span class="invalid-feedback" role="alert">
						                                <strong>{{ $message }}</strong>
						                            </span>
					                            @enderror
											</div>
											<div class="col-12">
												<label for="inputChoosePassword" class="form-label">Enter Password</label>
												<div class="input-group" id="show_hide_password">
													<input type="password" name="password" class="form-control border-end-0 @error('password') is-invalid @enderror" id="inputChoosePassword" placeholder="Enter Password" value="{{isset($_COOKIE["admin_password"]) ? $_COOKIE["admin_password"] : '' }}"> <a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
													@error('password')
							                            <span class="invalid-feedback" role="alert">
							                                <strong>{{ $message }}</strong>
							                            </span>
						                            @enderror
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-check form-switch">
													<input class="form-check-input" name="remember_me" type="checkbox" id="flexSwitchCheckChecked" checked>
													<label class="form-check-label" for="flexSwitchCheckChecked">Remember Me</label>
												</div>
											</div>
											<div class="col-md-6 text-end">	<a href="{{ route('password.request') }}">Forgot Password ?</a>
											</div>
											<div class="col-12">
												<div class="d-grid">
													<button type="submit" class="btn btn-light" ><i class="bx bxs-lock-open" style="margin-bottom: 0em !important;"></i>Sign In</button>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!--end row-->
			</div>
		</div>
	</div>
	<!--end wrapper-->
	<!--start switcher-->
	
	<!--end switcher-->

	<!--Password show & hide js -->
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
		});
	</script>
@endsection