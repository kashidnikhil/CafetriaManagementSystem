<?php 
    include('sessionemp.php');

    if(isset($_SESSION['counter_user'])) {
        $uname = $_SESSION['counter_user'];
        $sql = "SELECT * from food_category where username='$uname'";
        $result = mysqli_query($db,$sql);
        $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
        $fcId = $row['id'];
    } else {
        $uname = $_SESSION['login_user'];
        $sql = "SELECT * from employee where eid='$uname'";
        $result = mysqli_query($db,$sql);
        $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
        $eid = $row['eid'];
    }
    $oid = $_GET['oid'];
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
                        <h1>Order Number: <?= $oid; ?></h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <?php
                            $c = "SELECT * FROM ord WHERE oid='$oid'";
                            $res = mysqli_query($db,$c);
                            $det = mysqli_fetch_array($res,MYSQLI_ASSOC);
                            if(isset($_SESSION['counter_user'])) {
                                $qb = "SELECT orderdet.iid as iid FROM orderdet LEFT JOIN sjtalacarte AS sjt ON sjt.iid=orderdet.iid LEFT JOIN food_category AS fc ON fc.id=sjt.category WHERE fc.username='$uname' AND orderdet.oid='$oid'";
                                $qbres = mysqli_query($db,$qb);
                                $iidList = "(";
                                while($fc = mysqli_fetch_array($qbres, MYSQLI_ASSOC)) {
                                    $iidList .= $iidList=="("?$fc['iid']:",".$fc['iid'];
                                }
                                $iidList .= ")";

                                $q = "SELECT * FROM orderdet WHERE iid IN $iidList AND oid='$oid'";
                            } else {
                                $q = "SELECT * FROM orderdet WHERE oid='$oid'";
                            }
                            $r = mysqli_query($db,$q);
                        ?>
                        <table class="table">
                            <tr>
                                <th>Item Name</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Status</th>
                            </tr>
                            <?php 
                                while($item = mysqli_fetch_array($r,MYSQLI_ASSOC)) {
                                    $iid = $item['iid'];
                                    if($det['cid']==919) {
                                        $s = "select * from sjtalacarte where iid='$iid'";
                                        $quer = mysqli_query($db,$s);
                                        $ala = mysqli_fetch_array($quer,MYSQLI_ASSOC);
                            ?>
                            <tr>
                                <td><?= $ala['name'] ?></td>
                                <td><?= $item['qty'] ?></td>
                                <td><?= $item['qty']*$ala['price'] ?></td>
                                <td><?= $item['status'] ?></td>
                            </tr>
                            <?php } } ?>
                            <tr>
                                <td colspan="2" class="text-right"><strong>Total</strong></td>
                                <td><strong><?= $det['cost'] ?></strong></td>
                            </tr>
                        </table>
                        <p><strong>Note:</strong> <?= $det['note'] ?></p>
                        <?php
                            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                                if(isset($_POST['rating']) && $_POST['rating']=="1"){
                                    $oPen = 0; $iidStr = "";
                                    $itemQue = "SELECT orderdet.iid, orderdet.status, fc.id FROM orderdet LEFT JOIN sjtalacarte AS sjt ON sjt.iid=orderdet.iid LEFT JOIN food_category AS fc ON fc.id=sjt.category WHERE orderdet.oid='$oid'";
                                    $itemRes = mysqli_query($db,$itemQue);

                                    while($ordItem = mysqli_fetch_array($itemRes,MYSQLI_ASSOC)) {
                                        if($ordItem['id']==$fcId) {
                                            $iidStr .= $iidStr==""?$ordItem['iid']:",".$ordItem['iid'];
                                        } elseif($ordItem['status']!='Ready') {
                                            $oPen++;
                                        }
                                    }

                                    if($iidStr!="") {
                                        $itemUpQue = "UPDATE orderdet SET `status`='Ready' WHERE `oid`=$oid AND `iid` IN ($iidStr)";
                                        $itemUpRes = mysqli_query($db,$itemUpQue);
                                    }

                                    if($oPen==0) {
                                        $l = "UPDATE ord SET status='Completed' WHERE oid='$oid'"; //eid='$eid' //Processing
                                        $ret = mysqli_query($db,$l);
                                        ?>
                                            <script>
                                                window.location.href = "emordstat.php";
                                            </script>
                                        <?php
                                    } else {
                                        ?>
                                            <script>
                                                simpleModal("<?= $oPen ?> items processing from this order.", "emordstat.php");
                                            </script>
                                        <?php
                                    }
                                }
                            }
                        ?>
                        <form method="POST" action="<?php $_PHP_SELF ?>">
                            <!-- <label for="rating" class="mr-20"><strong>Status</strong></label> -->
                            <label><input type="hidden" name="rating" value="1"> <!-- Finished --></label><br/>
                            <button type="submit" class="btn btn-sm btn-default" id="Submit" name="Submit">Complete</button>
                        </form>
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