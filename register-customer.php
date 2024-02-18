<?php
    include('sendmail.php');

    function random_strings($length_of_string)
    {
      $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
      return substr(str_shuffle($str_result), 0, $length_of_string);
    }
    
    session_start();

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        // username and password sent from form 
        define('DB_SERVER', 'localhost');
        define('DB_USERNAME', 'root');
        define('DB_PASSWORD', '');
        define('DB_DATABASE', 'canteenmgmt');
        $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);

        if(isset($_SESSION['OTP']) && $_SESSION['OTP'] == $_POST['code']) {
            $custid = strtoupper(random_strings(9));
            $fullname = mysqli_real_escape_string($db,$_POST['full_name']);
            $email = mysqli_real_escape_string($db,$_POST['email']);
            $phone = mysqli_real_escape_string($db,$_POST['phone']);
            $pwd = mysqli_real_escape_string($db,$_POST['pwd']);

            $sql = "INSERT into customer(custid,name,wallet,phone,email) values ('$custid','$fullname',5000,'$phone','$email')";
            $result = mysqli_query($db,$sql);

            $sql1 = "INSERT into sauth(custid,pwd) values ('$custid','$pwd')";
            $result1 = mysqli_query($db,$sql1);

            $mailBody = "Dear customer,<br/><br/>
            Your account is created.<br/>
            Your username is <strong>".$custid."</strong>";
            sendMail($email, "Pannash Greens - Account Created", $mailBody);

            if($result) {
                echo "<script>alert('Register successful!');</script>";
                echo "<script>window.location.href='employee.php';</script>";
            }
        } else {
            echo "<script>alert('Invalid code!');</script>";
        }
    }
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
        </nav>
    </div>
</header>
<!-- END HEADER -->

<!-- START SECTION LOGIN -->
<div class="section">
	<div class="container">
    	<div class="row justify-content-center">
            <div class="col-lg-6 col-md-8">
                <div class="lr_form box_shadow1 radius_all_10 animation" data-animation="fadeInUp" data-animation-delay="0.02s">
                    <div class="heading_s1 text-center pb-md-3">
                        <h2>Register New Account</h2>
                    </div>
                    <form method="post" class="form_style1" action="<?php $_PHP_SELF ?>">
                        <div class="form-group">
                            <input type="text" class="form-control" id="full_name" name="full_name" placeholder="Full Name" value="<?= isset($_POST['full_name'])?$_POST['full_name']:''; ?>" required>
                        </div>
                        <div class="form-group account-verification">
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="<?= isset($_POST['email'])?$_POST['email']:''; ?>" required>
                            <a href="#" id="verify-btn">Verify</a>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="code" name="code" Placeholder="Code" required>
                        </div>
                        <div class="form-group">
                            <input type="number" class="form-control" id="phone" name="phone" min="1000000000" max="9999999999" placeholder="Phone" value="<?= isset($_POST['phone'])?$_POST['phone']:''; ?>" required>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" id="pwd" name="pwd" Placeholder="Password" required>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-default btn-block" name="register">Register</button>
                        </div>
                    </form>
                    <div class="form-note text-center">Already have an account? <a href="employee.php" class="text_default">Sign in</a></div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END SECTION LOGIN -->

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

<a href="#" class="scrollup" style="display: none;"><i class="ion-ios-arrow-up"></i></a> 

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

<script>
  $(document).ready(function(){
    $('#verify-btn').click(function(e){
      e.preventDefault();

      $.ajax({url: "sendOTP.php",
        type: "POST",
        data: "email="+$("#email").val(),
        success: function(result){
          alert("OTP sent to your email account.");
        }  
      });
    });
  });
</script>

</body>
</html>