<?php
include $_SERVER["APP"];
include WEB_ROOT . 'include/text.php';
include WEB_ROOT . 'php/model/config.php';
include WEB_ROOT . 'php/model/user.php';
include WEB_ROOT . 'php/model/hostel.php';
User::authenticate();
$user_id = $_SESSION['userid'];
$userdetails = new User();
$hostel = new Hostel();


?>
<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Meta -->
	<meta name="description" content="Vivo - Responsive Bootstrap 5 Dashboard Template">
	<meta name="author" content="Bootstrap Gallery" />
	<link rel="canonical" href="https://www.bootstrap.gallery/">
	<meta property="og:url" content="https://www.bootstrap.gallery">
	<meta property="og:title" content="Admin Templates - Dashboard Templates | Bootstrap Gallery">
	<meta property="og:description" content="Marketplace for Bootstrap Admin Dashboards">
	<meta property="og:type" content="Website">
	<meta property="og:site_name" content="Bootstrap Gallery">
	<link rel="shortcut icon" href="assets/images/favicon.svg">
	<link rel="stylesheet" href="assets/css/sweetalert2.min.css">

	<!-- Title -->
	<title><?= $schoolName ?> - Admin Dashboard</title>


	<!-- *************
			************ Common Css Files *************
		************ -->

	<!-- Animated css -->
	<link rel="stylesheet" href="assets/css/animate.css">

	<!-- Bootstrap font icons css -->
	<link rel="stylesheet" href="assets/fonts/bootstrap/bootstrap-icons.css">

	<!-- Main css -->
	<link rel="stylesheet" href="assets/css/main.min.css">


	<!-- *************
			************ Vendor Css Files *************
		************ -->

	<!-- Scrollbar CSS -->
	<link rel="stylesheet" href="assets/vendor/overlay-scroll/OverlayScrollbars.min.css">
	<script src="assets/js/sweetalert2.min.js"></script>

</head>

<body>

	<!-- Loading wrapper start -->
	<!-- <div id="loading-wrapper">
			<div class="spinner">
				<div class="line1"></div>
				<div class="line2"></div>
				<div class="line3"></div>
				<div class="line4"></div>
				<div class="line5"></div>
				<div class="line6"></div>
			</div>
		</div> -->
	<!-- Loading wrapper end -->

	<!-- Page wrapper start -->
	<div class="page-wrapper">

		<!-- Sidebar wrapper start -->
		<?php include (WEB_ROOT . '/php/view/admin/includes/sidebar.php') ?>
		<!-- Sidebar wrapper end -->

		<!-- *************
				************ Main container start *************
			************* -->
		<div class="main-container">

			<!-- Page header starts -->
			<?php include (WEB_ROOT . '/php/view/admin/includes/header.php') ?>
			<!-- Page header ends -->

			<!-- Content wrapper scroll start -->
			<div class="content-wrapper-scroll">

				<!-- Content wrapper start -->
				<div class="content-wrapper">

					<!-- Row start -->
					<div class="row justify-content-between">
						<div class="col-md-6 mt-3">
							<h3 class="text-center">Create a Hostel</h3>
							<small class="text-center text-danger">
								<?php
								if (isset($_SESSION['hostel_error'])) {
									echo $_SESSION['hostel_error'];
									unset($_SESSION['hostel_error']);
								}
								?>
							</small>
							<form action="<?= ROOT_URL ?>php/controller/hostel.php" method="post"
								enctype="multipart/form-data">
								<div class="row">
									<div class="col-12">
										<div class="m-2">
											<label class="form-label">Name of Hostel</label>
											<input type="text" class="form-control" name="hostelname">
										</div>
									</div>

									<div class="col-12">
										<div class="m-2">
											<label class="form-label">Hostels</label>
											<select name="gender" id="" class="form-control">
												<option value="">Select a level</option>
												<option value="male">Male</option>
												<option value="female">Female</option>

											</select>

										</div>
									</div>

								</div>
								<button type="submit" class="btn btn-success mx-auto d-block mt-2">Create Hostel
									Space</button>
							</form>
							<div class="table-responsive mt-4">
								<table class="table v-middle m-0">
									<thead>
										<tr>
											<th>S/N</th>
											<th>Name of Hostel</th>
											<th>Gender</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<?= $hostel->viewhostel() ?>
									</tbody>
								</table>
							</div>
						</div>
						<div class="col-md-4 mt-3">
							<h3 class="text-center">Create Rooms </h3>
							<small class="text-center text-danger">
								<?php
								if (isset($_SESSION['hostelspace_error'])) {
									echo $_SESSION['hostelspace_error'];
									unset($_SESSION['hostelspace_error']);
								}
								?>
							</small>
							<form action="<?= ROOT_URL ?>php/controller/hostelspace.php" method="post"
								enctype="multipart/form-data">
								<div class="row">
									<div class="col-12">
										<div class="m-2">
											<label class="form-label">Room No.</label>
											<input type="text" class="form-control" name="roomNo">
										</div>
									</div>

									<div class="col-12">
										<div class="m-2">
											<label class="form-label">Hostel</label>
											<select name="hostelId" id="" class="form-control">
												<option value="">Select Hostel</option>
												<?= $hostel->hosteloptions() ?>
											</select>

										</div>
									</div>

								</div>
								<button type="submit" class="btn btn-success mx-auto d-block mt-2">upload</button>
							</form>
						</div>
						<div class="table-responsive mt-4">
								<table class="table v-middle m-0">
									<thead>
										<tr>
											<th>S/N</th>
											<th>Room No.</th>
											<th>Name of Hostel</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<?= $hostel->viewrooms() ?>
									</tbody>
								</table>
							</div>
					</div>
					<!-- Row end -->


				</div>
				<!-- Content wrapper end -->

				<!-- App Footer start -->
				<div class="app-footer">
					<span>© <?= $schoolName ?>, 2024</span>
				</div>
				<!-- App footer end -->

			</div>
			<!-- Content wrapper scroll end -->
			<div class="modal fade" id="delete" tabindex="" aria-labelledby="verticallyCenteredLabel"
				aria-hidden="false">
				<div class="modal-dialog modal-dialog-centered">
					<div class="modal-content">
						<div class="modal-body">
							<p>Do you wish to delete condition?</p>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
							<a href="" class="btn btn-success" id="deletebutton">Delete</a>
						</div>
					</div>
				</div>
			</div>
			<!-- Modal View Row -->
			<div class="modal modal-dark fade" id="viewRow" tabindex="-1" aria-labelledby="viewRowLabel"
				style="display: none;" aria-hidden="true">
				<div class="modal-dialog modal-lg modal-dialog-centered">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="viewRowLabel">View Details</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">

							<!-- Row start -->
							<div class="row">
								<div class="col-lg-4 col-sm-6 col-6">
									<div class="customer-card">
										<h6>Customer Name</h6>
										<h5>Garrett Winters</h5>
									</div>
								</div>
								<div class="col-lg-4 col-sm-6 col-6">
									<div class="customer-card">
										<h6>Customer ID</h6>
										<h5>#VIVO00763</h5>
									</div>
								</div>
								<div class="col-lg-4 col-sm-6 col-6">
									<div class="customer-card">
										<h6>Contact</h6>
										<h5>067-676-98320</h5>
									</div>
								</div>
								<div class="col-lg-4 col-sm-6 col-6">
									<div class="customer-card">
										<h6>Amount Spent</h6>
										<h5>$2570.00</h5>
									</div>
								</div>
								<div class="col-lg-4 col-sm-6 col-6">
									<div class="customer-card">
										<h6>Last Login</h6>
										<h5>21/11/2021</h5>
									</div>
								</div>
								<div class="col-lg-4 col-sm-6 col-6">
									<div class="customer-card">
										<h6>Coupons Used</h6>
										<h5>7</h5>
									</div>
								</div>
								<div class="col-lg-4 col-sm-6 col-6">
									<div class="customer-card">
										<h6>Total Orders</h6>
										<h5>95</h5>
									</div>
								</div>
								<div class="col-lg-4 col-sm-6 col-6">
									<div class="customer-card">
										<h6>Cancelled Orders</h6>
										<h5>2</h5>
									</div>
								</div>
								<div class="col-lg-4 col-sm-6 col-6">
									<div class="customer-card">
										<h6>Reviews</h6>
										<h5>21</h5>
									</div>
								</div>
							</div>
							<!-- Row end -->

						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-success" data-bs-dismiss="modal">Close</button>
						</div>
					</div>
				</div>
			</div>
			<div class="modal fade" id="viewDelete" tabindex="-1" aria-labelledby="verticallyCenteredLabel"
				aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="verticallyCenteredLabel">Delete User</h5>

						</div>
						<div class="modal-body">
							<p>Do you wish to delete this user?</p>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
							<a href="" class="btn btn-success">Delete</a>
						</div>
					</div>
				</div>
			</div>
			<div>
				<?php
				if (isset($_SESSION['hostelspace_success'])) {
					echo '<script> 
							Swal.fire({
								title: "Congratulation!",
								text: "You just created a hostel room!",
								icon: "success"
							});
							</script>';
					unset($_SESSION['hostelspace_success']);
				}
				?>
			</div>
			<div>
				<?php
				if (isset($_SESSION['deletehostel_success'])) {
					echo '<script> 
							Swal.fire({
								title: "Congratulation!",
								text: "Hostel block has been removed",
								icon: "success"
							});
							</script>';
					unset($_SESSION['deletehostel_success']);
				}
				?>
			</div>
			<div>
				<?php
				if (isset($_SESSION['deletehostelspace_success'])) {
					echo '<script> 
							Swal.fire({
								title: "Congratulation!",
								text: "A room has been removed from hostel block",
								icon: "success"
							});
							</script>';
					unset($_SESSION['deletehostelspace_success']);
				}
				?>
			</div>
			<div>
				<?php
				if (isset($_SESSION['hostel_success'])) {
					echo '<script> 
							Swal.fire({
								title: "Congratulation!",
								text: "Hostel created successfully",
								icon: "success"
							});
							</script>';
					unset($_SESSION['hostel_success']);
				}
				?>
			</div>

		</div>
		<!-- *************
				************ Main container end *************
			************* -->

	</div>
	<!-- Page wrapper end -->

	<!-- *************
			************ Required JavaScript Files *************
		************* -->
	<!-- Required jQuery first, then Bootstrap Bundle JS -->
	<script src="assets/js/jquery.min.js"></script>
	<script src="assets/js/bootstrap.bundle.min.js"></script>
	<script src="assets/js/modernizr.js"></script>
	<script src="assets/js/moment.js"></script>
	<script src="assets/js/sweetalert2.min.js"></script>


	<!-- *************
			************ Vendor Js Files *************
		************* -->

	<!-- Overlay Scroll JS -->
	<script src="assets/vendor/overlay-scroll/jquery.overlayScrollbars.min.js"></script>
	<script src="assets/vendor/overlay-scroll/custom-scrollbar.js"></script>

	<!-- Main Js Required -->
	<script src="assets/js/main.js"></script>

	<!-- Product Js -->
	<script src="assets/js/product.js"></script>
	<script>
		function collectid(id) {
			var deletebutton = document.getElementById('deletebutton');
			deletebutton.setAttribute('href', 'http://localhost/medical diagnosis/php/controller/deletecondition.php?id=' + id);
		}
	</script>

</body>

</html>