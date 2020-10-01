<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Title</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta content="Wpp bot" name="description" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<!-- App favicon -->
		<link rel="shortcut icon" href="/assets/themes/app/images/favicon.ico">
		<!-- App css -->
		<link href="/assets/themes/app/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
		<link href="/assets/themes/app/css/icons.min.css" rel="stylesheet" type="text/css" />
		<link href="/assets/themes/app/css/app.min.css" rel="stylesheet" type="text/css" />
		<!-- fontawesome css -->
		<link href="/assets/vendor/font-awesome-pro/css/all.min.css" rel="stylesheet" type="text/css" />

		@yield('css')

	</head>
	<body data-layout="topnav">
		<!-- Begin page -->
		<div class="wrapper">

			<!-- ============================================================== -->
			<!-- Start Page Content here -->
			<!-- ============================================================== -->

			<!-- Sidenav -->
			@include('template.partials.topnav')

			<div class="content-page">
				<div class="content">
					<!-- Start Content-->
					<div class="container-fluid">

						@yield('content')

					</div>
				</div>


				<!-- Footer Start -->
				<footer class="footer">
					<div class="container-fluid">
						<div class="row">
							<div class="col-12">
								<?php echo date('Y') ?> &copy; All Rights Reserved. <!-- Made by <a href="https://github.com/oterminramiro" target="_blank">oterminramiro</a> -->
							</div>
						</div>
					</div>
				</footer>
				<!-- end Footer -->
			</div>
			<!-- ============================================================== -->
			<!-- End Page content -->
			<!-- ============================================================== -->
		</div>

		<!-- Vendor js -->
		<script src="/assets/themes/app/js/vendor.min.js"></script>
		<!-- SWEET ALERT-->
		<script src="/assets/vendor/sweetalert/sweetalert.min.js"></script>
		<!-- App js -->
		<script src="/assets/themes/app/js/app.min.js"></script>

		@yield('js')
	</body>
</html>
