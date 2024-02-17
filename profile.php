<?php 
    include('sessioncust.php');

    $uname = $_SESSION['login_user'];
    $sql = "SELECT * from customer where custid='$uname'";
    $result = mysqli_query($db,$sql);
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<!-- Meta -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="Templatemanja" name="author">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="Tashan Restaurant and Cafe HTML5 Template.">

<!-- SITE TITLE -->
<title>Pannash Greens</title>
<!-- Favicon Icon -->
<link rel="shortcut icon" type="image/x-icon" href="assets/images/favicon.png">
<!-- Animation CSS -->
<link rel="stylesheet" href="assets/css/animate.css">	
<!-- Latest Bootstrap min CSS -->
<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
<!-- Google Font -->
<link href="https://fonts.googleapis.com/css?family=Kaushan+Script&display=swap" rel="stylesheet"> 
<link href="https://fonts.googleapis.com/css?family=Josefin+Sans:100,100i,300,300i,400,400i,600,600i,700,700i&display=swap" rel="stylesheet"> 
<link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i&display=swap" rel="stylesheet"> 
<!-- Icon Font CSS -->
<link rel="stylesheet" href="assets/css/all.min.css">
<link rel="stylesheet" href="assets/css/ionicons.min.css">
<link rel="stylesheet" href="assets/css/themify-icons.css">
<link rel="stylesheet" href="assets/css/linearicons.css">
<link rel="stylesheet" href="assets/css/flaticon.css">
<!--- owl carousel CSS-->
<link rel="stylesheet" href="assets/owlcarousel/css/owl.carousel.min.css">
<link rel="stylesheet" href="assets/owlcarousel/css/owl.theme.css">
<link rel="stylesheet" href="assets/owlcarousel/css/owl.theme.default.min.css">
<!-- Slick CSS -->
<link rel="stylesheet" href="assets/css/slick.css">
<link rel="stylesheet" href="assets/css/slick-theme.css">
<!-- Magnific Popup CSS -->
<link rel="stylesheet" href="assets/css/magnific-popup.css">
<!-- DatePicker CSS -->
<link href="assets/css/datepicker.min.css" rel="stylesheet">
<!-- TimePicker CSS -->
<link href="assets/css/mdtimepicker.min.css" rel="stylesheet">
<!-- Style CSS -->
<link rel="stylesheet" href="assets/css/style.css">
<link rel="stylesheet" href="assets/css/responsive.css">
<link rel="stylesheet" type="text/css" href="css/font-awesome/css/font-awesome.min.css">
<link id="layoutstyle" rel="stylesheet" href="assets/color/theme-green.css">

</head>

<body>

<!-- LOADER -->
<div id="preloader">
	<div class="loader_wrap">
        <div class="sk-chase">
          <div class="sk-chase-dot"></div>
          <div class="sk-chase-dot"></div>
          <div class="sk-chase-dot"></div>
          <div class="sk-chase-dot"></div>
          <div class="sk-chase-dot"></div>
          <div class="sk-chase-dot"></div>
        </div>
    </div>
</div>
<!-- END LOADER -->  

<!-- START HEADER -->
<header class="header_wrap header_with_topbar dark_skin main_menu_uppercase"><!--fixed-top-->
    <div class="container">
        <nav class="navbar navbar-expand-lg"> 
            <a class="navbar-brand" href="index.html">
                <img class="logo_light" src="assets/images/logo_light.png" alt="logo">
                <img class="logo_dark" src="assets/images/logo_dark.png" alt="logo">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidebar-menu" aria-expanded="false"> 
            	<span class="ion-android-menu"></span>
            </button>
            <div class="user-account">
                <a class="nav-link" href="#">
                    <i class="ti-user"></i><span> <?= $row['name'] ?><br><?= $row['custid'] ?></span>
                </a>
            </div>
        </nav>
    </div>
</header>
<!-- END HEADER -->

<!-- START SECTION OUR MENU -->
<div class="section pb_70">
    <div class="container">
        <div class="row">
            <div class="col-lg-3" id="sidebar-menu">
                <a href="homepage.php">Dashboard</a>
                <a href="stordstat.php">Today's Orders</a>
                <a href="stordview.php">Order History</a>
                <a href="givefeed.php">Give Feedback</a>
                <a href="viewfeed.php">View Feedback</a>
                <a href="profile.php">Profile</a>
                <a href="index.php">Logout</a>
            </div>
            <div class="col-lg-9 col-sm-12 col-12">
                <!-- START SECTION BREADCRUMB -->
                <div class="breadcrumb_section background_bg page_title_light">
                    <div class="page-title">
                        <h1>My Profile</h1>
                    </div>
                </div>
                <!-- END SECTION BREADCRUMB -->
                <div class="row align-items-center">
                    <div class="col-12">
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label>Full Name</label>
                                <input type="text" class="form-control" value="<?= $row['name'] ?>" disabled/>
                            </div>
                            <div class="form-group col-md-12">
                                <label>Wallet Balance</label>
                                <input type="text" class="form-control" value="<?= $row['wallet'] ?>" disabled/>
                            </div>
                            <div class="form-group col-md-12">
                                <label>Email Address</label>
                                <input type="text" class="form-control" value="<?= $row['email'] ?>" disabled/>
                            </div>
                            <div class="form-group col-md-12">
                                <label>Phone Number</label>
                                <input type="text" class="form-control" value="<?= $row['phone'] ?>" disabled/>
                            </div>
                        </div>
                        <br/>
                        <br/>
                        <h3>Change Password</h3>
                        <br/>
                         <?php
                            $custid = $row['custid'];
                            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                                $custid = $row['custid'];
                                $q="select pwd from sauth where custid='$custid'";
                                $res = mysqli_query($db,$q);
                                $item = mysqli_fetch_array($res,MYSQLI_ASSOC);

                                $o = $_POST['oldpwd'];
                                $n = $_POST['newpwd'];
                                if(strcmp($o,$item['pwd'])==0){
                                    $add = "update sauth set pwd='$n' where custid='$custid'";
                                    $retval = mysqli_query($db,$add);
                                    echo "<script>alert('Password updated successfully!')</script>";
                                    header('Location: homepage.php');
                                }
                                else{
                                    echo "<script>alert('Enter Correct Password!')</script>";
                                }
                            }
                        ?>
                        <form method="post" class="row" action="<?php $_PHP_SELF ?>">
                            <div class="form-group col-12">
                                <label>Old Password</label>
                                <input type="text" class="form-control" id="oldpwd" name="oldpwd" required/>
                            </div>
                            <div class="form-group col-12">
                                <label>New Password</label>
                                <input type="text" class="form-control" id="newpwd" name="newpwd" required/>
                            </div>
                            <div class="form-group col-12">
                                <button type="submit" class="btn btn-default">Change Password</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- START SECTION OUR MENU -->

<!-- START FOOTER -->
<footer class="bg_dark footer_dark">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="bottom_footer border-top-tran">
                    <div class="row">
                        <div class="col-md-6">
                            <p class="mb-md-0 text-center text-md-left">© <?= date('Y'); ?> All Rights Reserved by <span class="text_default">Pannash Greens</span></p>
                        </div>
                        <!-- <div class="col-md-6">
                            <ul class="list_none footer_link text-center text-md-right">
                                <li><a href="#">Privacy Policy</a></li>
                                <li><a href="#">Terms &amp; Conditions</a></li>
                            </ul>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- END FOOTER -->

<!-- <a href="#" class="scrollup" style="display: none;"><i class="ion-ios-arrow-up"></i></a>  -->

<!-- Latest jQuery --> 
<script src="assets/js/jquery-1.12.4.min.js"></script> 
<!-- Latest compiled and minified Bootstrap --> 
<script src="assets/bootstrap/js/bootstrap.min.js"></script> 
<!-- owl-carousel min js  --> 
<script src="assets/owlcarousel/js/owl.carousel.min.js"></script> 
<!-- magnific-popup min js  --> 
<script src="assets/js/magnific-popup.min.js"></script> 
<!-- waypoints min js  --> 
<script src="assets/js/waypoints.min.js"></script> 
<!-- parallax js  --> 
<script src="assets/js/parallax.js"></script> 
<!-- countdown js  --> 
<script src="assets/js/jquery.countdown.min.js"></script> 
<!-- jquery.countTo js  -->
<script src="assets/js/jquery.countTo.js"></script>
<!-- imagesloaded js --> 
<script src="assets/js/imagesloaded.pkgd.min.js"></script>
<!-- isotope min js --> 
<script src="assets/js/isotope.min.js"></script>
<!-- jquery.appear js  -->
<script src="assets/js/jquery.appear.js"></script>
<!-- jquery.dd.min js -->
<script src="assets/js/jquery.dd.min.js"></script>
<!-- slick js -->
<script src="assets/js/slick.min.js"></script>
<!-- DatePicker js -->
<script src="assets/js/datepicker.min.js"></script>
<!-- TimePicker js -->
<script src="assets/js/mdtimepicker.min.js"></script>
<!-- scripts js --> 
<script src="assets/js/scripts.js"></script>

</body>
</html>