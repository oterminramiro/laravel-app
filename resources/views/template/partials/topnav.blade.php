<!-- Topbar Start -->
<div class="navbar navbar-expand flex-column flex-md-row navbar-custom">
	<div class="container-fluid">
		<!-- LOGO -->
		<a href="/" class="navbar-brand mr-0 mr-md-2 logo">
			<span class="logo-lg">
				<img src="/assets/themes/app/images/logo.png" alt="" height="24" />
				<span class="d-inline h5 ml-1 text-logo">BO</span>
			</span>
			<span class="logo-sm">
				<img src="/assets/themes/app/images/logo.png" alt="" height="24">
			</span>
		</a>

		<ul class="navbar-nav bd-navbar-nav flex-row list-unstyled menu-left mb-0">
			<li class="">
				<button class="button-menu-mobile open-left disable-btn">
					<i data-feather="menu" class="menu-icon"></i>
					<i data-feather="x" class="close-icon"></i>
				</button>
			</li>
		</ul>

		<ul class="navbar-nav flex-row ml-auto d-flex list-unstyled topnav-menu float-right mb-0">

			@auth
			<li class="d-none d-sm-block">
				<div class="app-search">
					<form>
						<div class="input-group">
							<input type="text" class="form-control" placeholder="Search...">
							<span data-feather="search"></span>
						</div>
					</form>
				</div>
			</li>

			<li class="dropdown notification-list align-self-center profile-dropdown">
				<a class="nav-link dropdown-toggle nav-user mr-0" data-toggle="dropdown" href="#" role="button"
					aria-haspopup="false" aria-expanded="false">
					<div class="media user-profile ">
						<span class="avatar-title rounded-circle align-self-center bg-soft-primary text-primary" style="height:32px;width:32px">{{ ucfirst(Auth::user()->name[0]) }}</span>
						<div class="media-body text-left">
							<h6 class="pro-user-name ml-2 my-0">
								<span>{{ Auth::user()->name }}</span>
								<span class="pro-user-desc text-muted d-block mt-1">Role</span>
							</h6>
						</div>
						<span data-feather="chevron-down" class="ml-2 align-self-center"></span>
					</div>
				</a>
				<div class="dropdown-menu profile-dropdown-items dropdown-menu-right">
					<a href="/manage/account/account/" class="dropdown-item notify-item">
						<i data-feather="user" class="icon-dual icon-xs mr-2"></i>
						<span>Account</span>
					</a>

					<a href="javascript:void(0);" class="dropdown-item notify-item">
						<i data-feather="settings" class="icon-dual icon-xs mr-2"></i>
						<span>Settings</span>
					</a>

					<div class="dropdown-divider"></div>

					<a href="{{ route('logout') }}" class="dropdown-item notify-item">
						<i data-feather="log-out" class="icon-dual icon-xs mr-2"></i>
						<span>Logout</span>
					</a>
				</div>
			</li>
			@endauth
			@guest
				<li class="nav-item">
					<a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
				</li>
				@if (Route::has('register'))
					<li class="nav-item">
						<a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
					</li>
				@endif
			@endguest

		</ul>
	</div>

</div>
<!-- end Topbar -->
