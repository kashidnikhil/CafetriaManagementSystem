<?php 
    include('sessioncust.php');
    include('sendmail.php');

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

<?php include('header.php'); ?>

<!-- START SECTION OUR MENU -->
<div class="section pb_70">
    <div class="container">
        <div class="row">
            
            <?php include('sidebar.php'); ?>

            <div class="col-lg-9 col-sm-12 col-12">
                <!-- START SECTION BREADCRUMB -->
                <div class="breadcrumb_section background_bg page_title_light">
                    <div class="page-title">
                        <h1>Rating For Order <?= $_GET['oid'] ?></h1>
                    </div>
                </div>
                <!-- END SECTION BREADCRUMB -->
                <div class="row align-items-center">
                    <div class="col-12">
                        <?php
                            $custid = $row['custid'];
                            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                                $target_dir = "uploads/";
                                $extension = explode(".", $_FILES["image"]["name"]);
                                $file_name = time(). "." .end($extension);
                                $target_file = $target_dir . $file_name;

                                if ($_FILES["image"]["name"]) {
                                  move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
                                }

                                $image = $file_name;
                                $rating = $_POST['rating'];
                                $review = $_POST['comment'];
                                $rdate = date('Y-m-d');

                                $add = "UPDATE ord SET image='$image', rating='$rating', review='$review', rdate='$rdate' WHERE oid=".$_GET['oid'];
                                $retval = mysqli_query($db,$add);

                                $mailBody = "Order No.: ".$_GET['oid']."<br/>
                                Review: $review<br/>
                                Rating: $rating<br/>
                                <img src='' style='width: 200px'/>";

                                sendMail("cssonawane32@gmail.com", "Pannash Greens - Review For Order No-".$_GET['oid'], $mailBody);
                            ?>
                            <script>
                                simpleModal("Review submitted successfully.", "stordview.php");
                            </script>
                            <?php
                            }
                        ?>
                        <form method="post" class="row" action="<?php $_PHP_SELF ?>" enctype="multipart/form-data">
                            <div class="form-group col-12">
                                <label>Image</label>
                                <input type="file" class="form-control" id="image" name="image"/>
                            </div>
                            <div class="form-group col-12">
                                <label>Rating</label><br/>
                                <div id="rating-star">
                                  <span class="fa fa-star"></span>
                                  <span class="fa fa-star"></span>
                                  <span class="fa fa-star"></span>
                                  <span class="fa fa-star"></span>
                                  <span class="fa fa-star"></span>
                                </div>
                                <input type="hidden" name="rating" id="rating" value="0"/>
                            </div>
                            <div class="form-group col-12">
                                <label>Review</label>
                                <input type="text" class="form-control" id="comment" name="comment" required/>
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

<script>
    document.querySelector('#rating-star').addEventListener('click', function (e) {
        if (e.target.nodeName === 'SPAN') {
            let currentSibling = e.target;
            let nextSibling = e.target;
            currentSibling.classList.add('active');
            while ((currentSibling = currentSibling.previousElementSibling)) {
                currentSibling.classList.add('active');
            }
            while ((nextSibling = nextSibling.nextElementSibling)) {
                nextSibling.classList.remove('active');
            }
        }

        let rating = document.querySelectorAll("span.active").length;
        document.querySelector('#rating').value = rating;
    });
</script>

<script>
    $(document).ready(function(){
        let divId = 0;
        const addToCart = (id, qty) => {
            $.ajax({url: "cart_session.php",
                type: "POST",
                data: "itemId="+id+"&quantity="+qty,
                success: function(result){
                    let response = JSON.parse(result);

                    if(response.result == "true") {
                        let id = 'msg'+divId
                        $("body").append(`<div id="${id}" class="temp-msg">Cart Updated!</div>`);
                        setTimeout(() => {                            
                            $("#"+id).remove();
                        }, 3000);
                        divId++;

                        $(".cart-count .cart_trigger .cart_count").text(response.count);
                        updateCart(response.cart);
                    }
                }
            });
        }

        $(document).on("click", "a.item_remove", function(e) {
            e.preventDefault();

            addToCart($(this).attr("item-id"), "");

            $(this).closest("li").remove();
        });

        const updateCart = (cart) => {
            let cartStr = ``;
            let total = 0;

            $.each(cart, (key, item) => {
                cartStr += `<li>
                            <a href="#" class="item_remove" item-id="${key}"><i class="ion-close"></i></a>
                            <a href="#"><img src="uploads/${item.image}" alt="${item.name}">${item.name}</a>
                            <span class="cart_quantity"> ${item.quantity} x <span class="cart_amount"> <span class="price_symbole">Rs. </span></span>${item.price}</span>
                        </li>`;

                let itemTotal = (parseInt(item.quantity) * parseFloat(item.price));
                total += itemTotal;
            });

            $("#cart_list").html(cartStr);
            $("#cartTotalAmt").text(total);
        }
    });
</script>

</body>
</html>