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

<?php include('header.php'); ?>

<!-- START SECTION OUR MENU -->
<div class="section pb_70">
    <div class="container">
        <div class="row">
            
            <?php include('sidebar.php'); ?>

            <div class="col-lg-9 col-sm-12 col-12">
                <!-- START SECTION BREADCRUMB -->
                <!-- <div class="breadcrumb_section background_bg page_title_light">
                    <div class="page-title">
                        <h1>Dashboard</h1>
                    </div>
                </div> -->
                <!-- END SECTION BREADCRUMB -->
                <div class="row">
                    <div class="col-12 text-center">
                        <img class="max-90" src="images/whattoorder.jpeg"><br/><br/>
                        <!-- <h3>Are you confused, what to order?</h3> -->
                        <a href="counters.php" class="btn btn-default">Order Now</a>
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
    $(document).ready(function(){
        $(".quantity-counter .inc-btn").click(function(e){
            e.preventDefault();
            let itemId = $(this).siblings("input").attr("id");
            let curVal = $(this).siblings("input").val();

            if(curVal == "") {
                curVal = 1;
            } else {
                curVal = parseInt(curVal) + 1;
            }

            addToCart(itemId, curVal);
            $(this).siblings("input").val(curVal);
        });

        $(".quantity-counter .dec-btn").click(function(e){
            e.preventDefault();
            let itemId = $(this).siblings("input").attr("id");
            let curVal = $(this).siblings("input").val();

            if(curVal > 1) {
                curVal = parseInt(curVal) - 1;
            } else {
                curVal = "";
            }

            addToCart(itemId, curVal);
            $(this).siblings("input").val(curVal);
        });

        /*$("a#confirmOrder").click(function(e){
            e.preventDefault();

            if(confirm('Do you want to place order?')) {
                $("button#Submit").trigger("click");
                window.location.href = "cart.php";
            }
        });*/

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

                total += (parseInt(item.quantity) * parseFloat(item.price));
            });

            $("#cart_list").html(cartStr);
            $("#cartTotalAmt").text(total);
        }
    });
</script>

</body>
</html>