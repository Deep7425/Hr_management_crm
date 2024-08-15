@extends('layouts.app')

@section('content')
	<!-- wrapper -->
	<div class="wrapper">
		<div class="authentication-forgot d-flex align-items-center justify-content-center">
			<div class="card forgot-box">
				<div class="card-body">

					<form method="POST" action="{{ route('password.email') }}">
						@csrf
						<div class="p-4 rounded  border">
							<div class="text-center">
								<img src="{{ asset('assets/images/icons/forgot-2.png') }}" width="120" alt="" />
							</div>
							<h4 class="mt-5 font-weight-bold">Forgot Password?</h4>
							<p class="">Enter your registered email ID to reset the password</p>
							<div class="my-4">
								<label class="form-label">Email id</label>
								<input type="text" name="email" class="form-control form-control-lg @error('email') is-invalid @enderror" placeholder="Example@user.com" autofocus />

								@error('email')
	                                <span class="invalid-feedback" role="alert">
	                                    <strong>{{ $message }}</strong>
	                                </span>
	                            @enderror
	                            @if (Session::has('error_msg'))
	                                    <span style="width: 100%; margin-top: 0.25rem;font-size: 80%;color: #f62d51;"><strong>{{ Session::get('error_msg') }}</strong></span>
	                            @endif
							</div>
							<div class="d-grid gap-2">
								<button type="submit" class="btn btn-light btn-lg">Send</button> <a href="{{ route('admin.login') }}" class="btn btn-light btn-lg"><i class='bx bx-arrow-back me-1'></i>Back to Login</a>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- end wrapper -->
	<!--start switcher-->
	
@endsection