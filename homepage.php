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
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-expanded="false"> 
            	<span class="ion-android-menu"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                <ul class="navbar-nav">
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="nav-link dropdown-toggle user-account" href="#">
                            <i class="ti-user"></i><span> <?= $row['name'] ?><br><?= $row['custid'] ?></span>
                        </a>
                        <div class="dropdown-menu">
                            <ul> 
                                <li><a class="dropdown-item nav-link nav_item" href="profile.php">Profile</a></li>
                                <li><a class="dropdown-item nav-link nav_item" href="index.php">Logout</a></li>
                            </ul>
                        </div>   
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</header>
<!-- END HEADER -->

<!-- START SECTION OUR MENU -->
<div class="section pb_70">
	<div class="container">
    	<div class="row align-items-center">
        	<div class="col-md-12">
            	<div class="heading_tab_header animation" data-animation="fadeInUp" data-animation-delay="0.02s">
                    <div class="heading_s1">
                        <h2>from Our Menu</h2>
                    </div>
                    <div class="tab-style1">
                    	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#tabmenubar" aria-expanded="false"> 
                            <span class="ion-android-menu"></span>
                        </button>
                        <ul id="tabmenubar" class="nav nav-tabs" role="tablist">
                            <?php
                                $fcQuery = "SELECT * from food_category";
                                $fcRes = mysqli_query($db,$fcQuery);
                                $i = 0;
                                while($category = mysqli_fetch_array($fcRes, MYSQLI_ASSOC)){
                            ?>
                            <li class="nav-item">
                                <a class="nav-link <?= $i==0?'active':'' ?>" id="<?= $category['category'] ?>-tab" data-toggle="tab" href="#<?= $category['category'] ?>" role="tab" aria-controls="<?= $category['category'] ?>" aria-selected="true"><?= $category['category'] ?></a>
                            </li>
                            <?php $i++; } ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
        	<div class="col-12">
                <?php
                    if($_SERVER['REQUEST_METHOD'] == 'POST'){
                        $ala = "SELECT * from sjtalacarte";
                        $res = mysqli_query($db,$ala);
                        $x = 0;
                        while($item = mysqli_fetch_array($res, MYSQLI_ASSOC)){
                            $it = $item['iid'];
                            $pr = $item['price'];
                            if($_POST[$it]!=NULL){
                                $ord[$x]=$it;
                                $pri[$x]=$pr;
                                $qty[$x++]=$_POST[$it];
                            }
                        }
                        $cost = 0;
                        for($y=0;$y<$x;$y++){
                            $cost = $cost+$pri[$y]*$qty[$y];
                        }
                        if($row['wallet']>=$cost){
                            echo "<script>alert('Order Placed!');</script>";
                            $date = date("Y-m-d");
                            $cust = $row['custid'];
                            $note = $_POST['order_note'];
                            $add = "INSERT into ord(cid,custid,odate,cost,note,status) values ('919','$cust','$date','$cost','$note','Received')";
                            $retval = mysqli_query($db,$add);
                            $m = mysqli_query($db,"select max(oid) from ord");
                            $max = mysqli_fetch_array($m,MYSQLI_ASSOC);
                            $oid = $max['max(oid)'];
                            for($y=0;$y<$x;$y++){
                                $add = "insert into orderdet values('$oid','$ord[$y]','$qty[$y]')";
                                $retval = mysqli_query($db,$add);
                            }
                            $balance=$row['wallet']-$cost;
                            $add="update customer set wallet='$balance' where custid='$cust'";
                            $retval = mysqli_query($db,$add);
                        } else {
                            echo "<script>alert('Not enough Balance in your wallet');</script>";
                        }
                    }
                ?>
                <form method="post" id="sjt" name="sjt" action="<?php $_PHP_SELF ?>">
                    <div class="tab-content">
                        <?php
                            $iCatQuery = "SELECT * from food_category";
                            $iCatRes = mysqli_query($db,$fcQuery);
                            $j = 0;
                            while($cat = mysqli_fetch_array($iCatRes, MYSQLI_ASSOC)){
                        ?>
                        <div class="tab-pane fade <?= $j==0?'show active':'' ?>" id="<?= $cat['category'] ?>" role="tabpanel" aria-labelledby="<?= $cat['category'] ?>-tab">
                            <div class="row">
                                <?php
                                    $iQuery = "SELECT * FROM sjtalacarte WHERE category=".$cat['id'];
                                    $iRes = mysqli_query($db,$iQuery);
                                    while($item = mysqli_fetch_array($iRes, MYSQLI_ASSOC)) {
                                ?>
                                <div class="col-lg-3 col-sm-6">
                                    <div class="single_product">
                                        <div class="menu_product_img">
                                            <img src="uploads/<?= $item['image'] ?>" alt="menu_item1">
                                            <!-- <div class="action_btn"><a href="#" class="btn btn-white">Add To Cart</a></div> -->
                                        </div>
                                        <div class="menu_product_info">
                                            <div class="title">
                                                <h5><a href="#"><?= $item['name'] ?></a></h5>
                                            </div>
                                            <!-- <p>Lorem Ipsum is simply dummy text of the printing and industry.</p> -->
                                        </div>
                                        <div class="menu_footer">
                                            <div class="price">
                                                <span>Rs. <?= $item['price'] ?></span>
                                            </div>
                                            <div class="quantity-counter">
                                                <button class="dec-btn">-</button>
                                                <input type="text" class="form-control quantity-field" id="<?= $item['iid'] ?>" name="<?= $item['iid'] ?>">
                                                <button class="inc-btn">+</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                        <?php $j++; } ?>
                    </div>
                    <a href="homepage.php" class="btn btn-default">Go Back</a>
                    <a href="#" id="confirmOrder" class="btn btn-default">Continue</a>
                    <button type="submit" class="btn btn-default" id="Submit" name="Submit" style="display: none;">Continue</button>
                </form>
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

<script>
    $(document).ready(function(){
        $(".quantity-counter .inc-btn").click(function(e){
            e.preventDefault();
            let curVal = $(this).siblings("input").val();

            if(curVal == "") {
                curVal = 1;
            } else {
                curVal = parseInt(curVal) + 1;
            }

            $(this).siblings("input").val(curVal);
        });

        $(".quantity-counter .dec-btn").click(function(e){
            e.preventDefault();
            let curVal = $(this).siblings("input").val();

            if(curVal > 1) {
                curVal = parseInt(curVal) - 1;
            } else {
                curVal = "";
            }

            $(this).siblings("input").val(curVal);
        });

        $("a#confirmOrder").click(function(e){
            e.preventDefault();

            if(confirm('Do you want to place order?')) {
                $("button#Submit").trigger("click");
            }
        });
    });
</script>

</body>
</html>