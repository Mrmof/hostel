<?php  
  include $_SERVER['APP'];
  include WEB_ROOT."include/text.php";
  include WEB_ROOT."php/model/config.php";
  include WEB_ROOT."php/model/user.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title><?=$schoolName?></title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Source+Sans+Pro:ital,wght@0,200;0,300;0,400;0,600;0,700;0,900;1,200;1,300;1,400;1,600;1,700;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: HeroBiz
  * Template URL: https://bootstrapmade.com/herobiz-bootstrap-business-template/
  * Updated: May 30 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body class="index-page">

  <!-- Header Start -->
  <?php include WEB_ROOT."include/header.php" ?>
  <!-- Header Start -->

  <main class="main mt-3">

   <div class="container " style="height: fit-content; align-content:center">
      <div class="row">
          <div class="col-md-4 offset-md-4">
            <h3 class="text-center">SIGNUP TO HOSTEL SYSTEM</h3>
            <p class="text-danger"><?php 

              if (isset($_SESSION['signup_error'])) {
                echo  $_SESSION['signup_error'];
                unset( $_SESSION['signup_error']);
              }
            ?></p>
            <form action="<?=ROOT_URL."php/controller/signup.php" ?>" method="post" >
              <div class="row">
                <div class="col-md-6 form-group mt-3">
                  <label for="" class="form-label">Your Fullname</label>
                  <input type="text" name="fullname" class="form-control" placeholder="Your Fullname" required="">
                </div>
                <div class="col-md-6 form-group mt-3">
                  <label for="" class="form-label">Your Email</label>
                  <input type="email" name="email" class="form-control"  placeholder="Your Email" required="">
                </div>
                <div class="col-md-6 form-group mt-3">
                  <label for="" class="form-label">Your Mat. No</label>
                  <input type="text" name="matNo" class="form-control" placeholder="Your Mat. No." required="">
                </div>
                <div class="col-md-6 form-group mt-3">
                  <label for="" class="form-label">Your Gender</label>
                  <select name="gender" class="form-control" id="">
                      <option value="">Select a Gender</option>
                      <option value="male">Male</option>
                      <option value="female">Female</option>
                  </select>
                </div>
                <div class="col-md-12 form-group mt-3">
                  <label for="" class="form-label">Your Password</label>
                  <input type="password" class="form-control" name="password"  placeholder="Your Password" required="">
                </div>
                <div class="col-md-12 form-group mt-3">
                  <label for="" class="form-label">Confirm your Password</label>
                  <input type="password" class="form-control" name="cpassword" placeholder="Your Password" required="">
                </div>
              </div>
              <div class="text-center"><button type="submit" class="btn btn-primary mt-3">Sign up</button></div>
            </form>
            <p>Already registered? <a href="login.php" class="btn text-primary">Login</a></p>
          </div>
      </div>
   </div>

  </main>

  <!-- footer -->
  <?php include WEB_ROOT."include/footer.php" ?>
  <!-- end footer -->

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>

  <!-- Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>