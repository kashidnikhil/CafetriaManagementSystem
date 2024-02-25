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
<link rel="stylesheet" href="assets/sweetalert/sweetalert2.min.css">
<link id="layoutstyle" rel="stylesheet" href="assets/color/theme-green.css">

<!--Sweet alert script-->
<script src="assets/sweetalert/sweetalert2.min.js"></script>

<script>
    const simpleModal = (message, redirect='') => {
        Swal.fire({
            text: message,
        }).then(() => {
            if(redirect != '') {
                window.location.href = redirect;
            }
        });
    }
</script>
</head>

<body>
<?php
    session_start();

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        // username and password sent from form 
        define('DB_SERVER', 'localhost');
        define('DB_USERNAME', 'root');
        define('DB_PASSWORD', '');
        define('DB_DATABASE', 'canteenmgmt');
        $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);

        $myusername = mysqli_real_escape_string($db,$_POST['uname']);
        $mypassword = mysqli_real_escape_string($db,$_POST['pwd']); 

        $sql = "SELECT eid FROM eauth WHERE eid='$myusername' AND pwd='$mypassword'";
        $result = mysqli_query($db,$sql);
        $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
        $count = mysqli_num_rows($result);

        // If result matched $myusername and $mypassword, table row must be 1 row
        if($count == 1) {
            $_SESSION['login_user'] = $myusername;
            $_SESSION['cust_user'] = $myusername;
            header("location: emphome.php");
        }
        else {
            $sql1 = "SELECT id FROM food_category WHERE username='$myusername' AND passwd='$mypassword'";
            $result1 = mysqli_query($db,$sql1);
            $row1 = mysqli_fetch_array($result1,MYSQLI_ASSOC);
            $count1 = mysqli_num_rows($result1);

            if($count1) {
                $_SESSION['login_user'] = $myusername;
                $_SESSION['counter_user'] = $myusername;
                header("location: emordstat.php");
            } else {
            ?>
                <script>
                    simpleModal("Enter correct details.");
                </script>
            <?php
            }
        }
    }
?>

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
                        <h2>Login to Your Account</h2>
                    </div>
                    <form method="post" class="form_style1" action="<?php $_PHP_SELF ?>">
                        <div class="form-group">
                            <input type="text" class="form-control" id="uname" name="uname" placeholder="Username" required>
                        </div>
                        <div class="form-group">
                            <input class="form-control" type="password" id="pwd" name="pwd" Placeholder="Password" required>
                        </div>
                        <!-- <div class="login_footer form-group">
                          <a href="#">Forgot password?</a>
                            <div class="chek-form">
                                <div class="custome-checkbox">
                                    <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox3" value="">
                                    <label class="form-check-label" for="exampleCheckbox3">Remember me</label>
                                </div>
                            </div>
                        </div> -->
                        <div class="form-group">
                            <button type="submit" class="btn btn-default btn-block" name="login">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END SECTION LOGIN -->

<?php include('footer.php'); ?>

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