<?php 
    include('sessionemp.php');

    if(isset($_SESSION['counter_user'])) {
        $uname = $_SESSION['counter_user'];
        $sql = "SELECT * from food_category where username='$uname'";
        $result = mysqli_query($db,$sql);
        $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
    } else {
        $uname = $_SESSION['login_user'];
        $sql = "SELECT * from employee where eid='$uname'";
        $result = mysqli_query($db,$sql);
        $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
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
                        <h1>Add Food Item</h1>
                    </div>
                </div>
                <!-- END SECTION BREADCRUMB -->
                <div class="row">
                    <div class="col-12">
                        <?php
                            if(isset($_SESSION['counter_user'])) {
                                $catQuery = "SELECT * FROM food_category WHERE username='$uname'";
                            } else {
                                $catQuery = "SELECT * FROM food_category";
                            }
                            $catMQ = mysqli_query($db,$catQuery);

                            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                                $target_dir = "uploads/";
                                $file_name = '';

                                if ($_FILES["image"]["name"]) {
                                    $extension = explode(".", $_FILES["image"]["name"]);
                                    $file_name = time(). "." .end($extension);
                                    $target_file = $target_dir . $file_name;
                                    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
                                }

                                $image = $file_name;
                                $item = $_POST['item'];
                                $desc = $_POST['description'];
                                $category = $_POST['category'];
                                $price = $_POST['price'];
                                $time = $_POST['time'];

                                $add = "INSERT into sjtalacarte(name,description,category,image,price,time) values ('$item','$desc','$category','$image','$price','$time')";
                                $retval = mysqli_query($db,$add);
                                if($retval) {
                                ?>
                                    <script>
                                        simpleModal("Item added successfully.", "items-list.php");
                                    </script>
                                <?php
                                }
                            }
                        ?>
                        <form method="post" class="row" action="<?php $_PHP_SELF ?>" enctype="multipart/form-data">
                            <div class="form-group col-12">
                                <label>Image</label>
                                <input type="file" class="form-control" id="image" name="image" required/>
                            </div>
                            <div class="form-group col-12">
                                <label>Item Name</label>
                                <input type="text" class="form-control"  id="item" name="item" required/>
                            </div>
                            <div class="form-group col-12">
                                <label>Description</label>
                                <textarea class="form-control" name="description" id="description" rows="2" maxlength="300"></textarea>
                            </div>
                            <div class="form-group col-12">
                                <label>Counter</label><br/>
                                <div class="custom_select">
                                    <select name="category" id="category" required>
                                        <?php while($cat = mysqli_fetch_array($catMQ, MYSQLI_ASSOC)) { ?>
                                            <option value="<?= $cat['id'] ?>"><?= $cat['category'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-12">
                                <label>Price</label>
                                <input type="number" class="form-control" id="price" name="price" required/>
                            </div>
                            <div class="form-group col-12">
                                <label>Time</label>
                                <input type="number" class="form-control" id="time" name="time" required/>
                            </div>
                            <div class="form-group col-12">
                                <button type="submit" class="btn btn-default">Submit</button>
                            </div>
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