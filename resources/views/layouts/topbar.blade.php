<?php
	// use App\User;
	$login_user_data = auth()->user();
?>
<!--start header -->
<header>
	<div class="topbar d-flex align-items-center">
		<nav class="navbar navbar-expand">
			<div class="mobile-toggle-menu"><i class='bx bx-menu'></i>
			</div>
			<div class="search-bar flex-grow-1">
				<div class="position-relative search-bar-box">

				</div>
			</div>
			
			<div class="user-box dropdown">
				<a class="d-flex align-items-center nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
					<!-- <img src="{{Auth::user()->image}}" class="user-img" alt="user avatar"> -->
					<div class="user-info ps-3">
						<p class="user-name mb-0">{{$login_user_data->name}}</p>
						<p class="designattion mb-0">{{($login_user_data->user_type == 1) ? "Admin" : "Other"}}</p>
					</div>
				</a>
				<ul class="dropdown-menu dropdown-menu-end">
					<!-- <li><a class="dropdown-item" href="{{ route('admin.profile') }}"><i class="bx bx-user"></i><span>Profile</span></a>
					</li> -->
					<!-- <li><a class="dropdown-item" href="javascript:;"><i class="bx bx-cog"></i><span>Settings</span></a> -->
					</li>
					<li><a class="dropdown-item" href="{{ route('admin.profile') }}"><i class='bx bx-user-circle'></i><span>Profile</span></a></li>
					<li><a class="dropdown-item" href="{{ route('admin.change-password') }}"><i class='bx bx-key'></i><span>Change Password</span></a></li>

					<!-- <li><a class="dropdown-item" href="javascript:;"><i class='bx bx-dollar-circle'></i><span>Earnings</span></a> -->
					</li>
					<!-- <li><a class="dropdown-item" href="javascript:;"><i class='bx bx-download'></i><span>Downloads</span></a>
					</li> -->
					<li>
						<div class="dropdown-divider mb-0"></div>
					</li>
					<li>
						<a class="dropdown-item" href="{{ route('admin.logout') }}" onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();"><i class='bx bx-log-out-circle'></i><span>Logout</span></a>
					</li>
					<form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
				</ul>
			</div>
		</nav>
	</div>
</header>
<!--end header -->