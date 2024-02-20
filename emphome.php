<?php 
    include('sessionemp.php');

    $uname = $_SESSION['login_user'];
    $sql = "SELECT * from employee where eid='$uname'";
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

<?php include('header_cust.php'); ?>

<!-- START SECTION OUR MENU -->
<div class="section pb_70">
    <div class="container">
        <div class="row">
            
            <?php include('sidebar_cust.php'); ?>

            <div class="col-lg-9 col-sm-12 col-12">
                <!-- START SECTION BREADCRUMB -->
                <div class="breadcrumb_section background_bg page_title_light">
                    <div class="page-title">
                        <h1>Best Employee</h1>
                    </div>
                </div>
                <!-- END SECTION BREADCRUMB -->
                <div class="row align-items-center">
                    <div class="col-md-12 best-employee">
                        <?php 
                            $q = "select max(jo) from (select eid, sum(cost)/count(eid) as jo from ord where status = 'Completed' group by eid) as t";
                            $m = mysqli_query($db,$q);
                            $cost = mysqli_fetch_array($m, MYSQLI_ASSOC);
                            $qb = "select eid, sum(cost)/count(eid) as jo from ord where status = 'Completed' group by eid";
                            $mb = mysqli_query($db,$qb);
                            while($item = mysqli_fetch_array($mb, MYSQLI_ASSOC)){
                                if ($cost['max(jo)']==$item['jo']){
                                    $eid = $item['eid'];
                                    $name = "select * from employee where eid='$eid'";
                                    $r = mysqli_query($db,$name);
                                    $nm = mysqli_fetch_array($r,MYSQLI_ASSOC);
                                    $cid = $nm['cid'];
                                    $c = "select name from canteen where cid=".$cid."";
                                    $s = mysqli_query($db,$c);
                                    $cant = mysqli_fetch_array($s, MYSQLI_ASSOC);

                                ?>
                                <div><label>Name of employee:</label> <?= $nm['name'] ?></div>
                                <div><label>Canteen:</label> <?= $cant['name'] ?></div>
                                <div><label>Average sale:</label> <?= round($cost['max(jo)']) ?></div>
                                <?php
                                }
                            }
                        ?>
                    </div>
                </div><br/><br/>
                <!-- START SECTION BREADCRUMB -->
                <div class="breadcrumb_section background_bg page_title_light">
                    <div class="page-title">
                        <h2>Leaderboard</h2>
                    </div>
                </div>
                <!-- END SECTION BREADCRUMB -->
                <div class="row">
                    <div class="col-12">
                        <table class="table">
                            <tr>
                                <th>Name of Employee</th>
                                <th>Canteen</th>
                                <th>Average Sale</th>
                            </tr>
                            <?php 
                                $qb = "select * from (select eid, sum(cost)/count(eid) as jo from ord where status = 'Completed' group by eid) as t order by jo desc";
                                $mb = mysqli_query($db,$qb);
                                while($item = mysqli_fetch_array($mb, MYSQLI_ASSOC)){
                                    $eid = $item['eid'];
                                    $name = "select * from employee where eid='$eid'";
                                    $r = mysqli_query($db,$name);
                                    $nm = mysqli_fetch_array($r,MYSQLI_ASSOC);
                                    $cid = $nm['cid'];
                                    $c = "select name from canteen where cid=".$cid."";
                                    $s = mysqli_query($db,$c);
                                    $cant = mysqli_fetch_array($s, MYSQLI_ASSOC);
                            ?>
                            <tr>
                                <td><?= $nm['name'] ?></td>
                                <td><?= $cant['name'] ?></td>
                                <td><?= round($item['jo']) ?></td>
                            </tr>
                            <?php } ?>
                        </table>
                    </div>
                </div> 
            </div>
        </div>
    </div>
</div>
<!-- START SECTION OUR MENU -->

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