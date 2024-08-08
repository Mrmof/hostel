<div class="page-header">

    <div class="toggle-sidebar" id="toggle-sidebar"><i class="bi bi-list"></i></div>

    <!-- Breadcrumb start -->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <i class="bi bi-house"></i>
            <a href="index.html">Home</a>
        </li>
        <!-- <li class="breadcrumb-item breadcrumb-active" aria-current="page">Analytics</li> -->
    </ol>
    <!-- Breadcrumb end -->

    <!-- Header actions ccontainer start -->
    <div class="header-actions-container">

        <!-- Search container start -->
        
        <!-- Search container end -->

        <!-- Leads start -->
        <!-- <a href="orders.html" class="leads d-none d-xl-flex">
            <div class="lead-details">You have <span class="count"> 21 </span> new leads </div>
            <span class="lead-icon"><i
                    class="bi bi-bell-fill animate__animated animate__swing animate__infinite infinite"></i><b
                    class="dot animate__animated animate__heartBeat animate__infinite"></b></span>
        </a> -->
        <!-- Leads end -->

        <!-- Header actions start -->
        <ul class="header-actions">
            <!-- <li class="dropdown d-none d-md-block">
                <a href="#" id="countries" data-toggle="dropdown" aria-haspopup="true">
                    <img src="assets/images/flags/1x1/br.svg" class="flag-img" alt="Admin Panels" />
                </a>
                <div class="dropdown-menu dropdown-menu-end mini" aria-labelledby="countries">
                    <div class="country-container">
                        <a href="index.html">
                            <img src="assets/images/flags/1x1/us.svg" alt="Clean Admin Dashboards" />
                        </a>
                        <a href="index.html">
                            <img src="assets/images/flags/1x1/in.svg" alt="Google Dashboards" />
                        </a>
                        <a href="index.html">
                            <img src="assets/images/flags/1x1/gb.svg" alt="AI Admin Dashboards" />
                        </a>
                        <a href="index.html">
                            <img src="assets/images/flags/1x1/tr.svg" alt="Modern Dashboards" />
                        </a>
                        <a href="index.html">
                            <img src="assets/images/flags/1x1/ca.svg" alt="Best Admin Dashboards" />
                        </a>
                    </div>
                </div>
            </li> -->
            <li class="dropdown">
                <a href="#" id="userSettings" class="user-settings" data-toggle="dropdown" aria-haspopup="true">
                    <span class="user-name d-none d-md-block">
                        <?php
                        if (isset($_SESSION['userDetails'])) {
                            echo $_SESSION['userDetails']['fullname'];
                        }
                        ?>
                    </span>
                    <span class="avatar">
                        <img src="assets/images/user.png" alt="Admin Templates">
                        <span class="status online"></span>
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="userSettings">
                    <div class="header-profile-actions">
                        <a href="#" data-bs-target="#editdetails" data-bs-toggle="modal">Profile</a>
                        <a href="" data-bs-target="#logout" data-bs-toggle="modal">
                            <span class="menu-text">Logout</span>
                        </a>
                    </div>
                </div>
            </li>
        </ul>
        <!-- Header actions end -->

    </div>
    <!-- Header actions ccontainer end -->
    <form action="<?=WEB_ROOT?>/php/controller/profile.php" method="post">
    <div class="modal fade" id="editdetails" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="scrollableLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="scrollableLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                
                    <div class="modal-body">
                        <div class="content-wrapper-scroll">

                            <!-- Content wrapper start -->
                            <div class="content-wrapper">

                                <!-- Row start -->
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="m-0">
                                                    <label class="form-label">Fullname</label>
                                                    <input type="text" class="form-control" name="fullname" placeholder="Enter text" value="<?=$_SESSION['userDetails']['fullname']?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="m-0">
                                                    <label class="form-label">Phone</label>
                                                    <input type="tel" class="form-control" name="phone" placeholder="Enter New Phone" value="<?=$_SESSION['userDetails']['phone']?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="m-0">
                                                    <label class="form-label">Enter new Address</label>
                                                    <input type="text" class="form-control" name="address" placeholder="Enter new Address" value="<?=$_SESSION['userDetails']['address']?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="m-0">
                                                    <label class="form-label">Password</label>
                                                    <input type="password" class="form-control" name="password" placeholder="Enter new Password" value="<?=$_SESSION['userDetails']['password']?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="m-0">
                                                    <label class="form-label">Password</label>
                                                    <input type="password" class="form-control" name="confirmPassword" placeholder="Confirm new Password" >
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> 
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Change</button>
                    </div>
                
            </div>
        </div>
    </div>
    </form>
    
    <?php 
        if (isset( $_SESSION['update_success'])) {
           echo '<script>Swal.fire({
            title: "Good job!",
            text: "You clicked the button!",
            icon: "success"
          });</script>';
        }
    ?>
</div>