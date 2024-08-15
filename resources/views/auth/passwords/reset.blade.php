@extends('layouts.app')

@section('content')
	<!-- wrapper -->
	<div class="wrapper">
		<div class="authentication-reset-password d-flex align-items-center justify-content-center">
			<div class="row">
				<div class="col-12 col-lg-10 mx-auto">
					<div class="card">
						<div class="row g-0">
							<div class="col-lg-5 border-end">
								<form method="POST" action="{{ route('password.update') }}">
									@csrf
									<div class="card-body">
										<input type="hidden" name="token" value="{{ $token }}">

										<div class="p-5">
											<div class="text-start">
												<img src="{{ asset('assets/images/logo-img.png') }}" width="180" alt="">
											</div>
											<h4 class="mt-5 font-weight-bold">Genrate New Password</h4>
											<p class="">We received your reset password request. Please enter your new password!</p>

					                        <div class="mb-3 mt-5">
					                            <label class="form-label">Email</label>
				                                <input id="email" placeholder="Email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" readonly autofocus>
				                                @error('email')
				                                    <span class="invalid-feedback" role="alert">
				                                        <strong>{{ $message }}</strong>
				                                    </span>
				                                @enderror
					                        </div>
											<div class="mb-3 mt-5">
												<label class="form-label">New Password</label>
												<input type="password" class="form-control @error('password') is-invalid @enderror" name="password" required placeholder="Enter new password" />
												@error('password')
				                                    <span class="invalid-feedback" role="alert">
				                                        <strong>{{ $message }}</strong>
				                                    </span>
				                                @enderror
											</div>
											<div class="mb-3">
												<label class="form-label">Confirm Password</label>
												<input type="password" class="form-control" name="password_confirmation" placeholder="Confirm password" />
											</div>
											<div class="d-grid gap-2">
												<button type="submit" class="btn btn-light">Change Password</button> <a href="{{ route('admin.login') }}" class="btn btn-light"><i class='bx bx-arrow-back mr-1'></i>Back to Login</a>
											</div>
										</div>
									</div>
								</form>
							</div>
							<div class="col-lg-7">
								<img src="{{ asset('assets/images/login-images/forgot-password-frent-img.jpg') }}" class="card-img login-img h-100" alt="...">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end wrapper -->
	<!--start switcher-->

@endsection