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
                <div class="breadcrumb_section background_bg page_title_light">
                    <div class="page-title">
                        <h1>Cart</h1>
                    </div>
                </div>
                <!-- END SECTION BREADCRUMB -->
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive shop_cart_table">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="product-name">Product</th>
                                        <th class="product-price">Price</th>
                                        <th class="product-quantity">Quantity</th>
                                        <!-- <th class="product-subtotal">Total</th> -->
                                        <th class="product-remove">Remove</th>
                                    </tr>
                                </thead>
                                <tbody id="cartItemsList">
                                    <?php 
                                        $cartArr = [];
                                        //$total = 0;

                                        if(isset($_SESSION['cart']) || !empty($_SESSION['cart'])) {
                                            $cartArr = $_SESSION['cart'];
                                        }

                                        foreach($cartArr as $key => $value) {
                                            if($key != "undefined") {
                                            $iQuery = "SELECT * FROM sjtalacarte WHERE iid=".$key;
                                            $iRes = mysqli_query($db,$iQuery);
                                            $item = mysqli_fetch_array($iRes, MYSQLI_ASSOC);
                                    ?>
                                    <tr>
                                        <td class="product-name" data-title="Product"><?= $item['name'] ?></td>
                                        <td class="product-price" data-title="Price">Rs. <span class="itemPrice"><?= $item['price'] ?></span></td>
                                        <td class="product-quantity" data-title="Quantity">
                                            <div class="quantity-counter">
                                                <button class="dec-btn">-</button>
                                                <input type="text" class="form-control quantity-field" id="<?= $item['iid'] ?>" name="<?= $item['iid'] ?>" value="<?= $value ?>">
                                                <button class="inc-btn">+</button>
                                            </div>
                                        </td>
                                        <!-- <td class="product-subtotal" data-title="Total">Rs. <span class="itemTotal"><?= ($item['price'] * intval($value)) ?></span></td> -->
                                        <td class="product-remove" data-title="Remove">
                                            <a href="#" class="item-remove" item-id="<?= $key ?>"><i class="ti-close"></i></a>
                                        </td>
                                    </tr>
                                    <?php /*$total += ($item['price'] * intval($value));*/ } } ?>
                                    <?php if(!isset($_SESSION['cart']) || empty($_SESSION['cart'])) { ?>
                                         <tr>
                                            <td class="product-name text-center" colspan="5" data-title="Product">
                                                Cart is empty.
                                            </td>
                                        </tr>  
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="medium_divider"></div>
                    </div>
                    
                    <a href="homepage.php" class="btn btn-default">Add More</a>
                    <a href="checkout.php" class="btn btn-default">Checkout</a>
                </div>
                <!-- <div class="row">
                    <div class="col-lg-12 col-12">
                        <div class="cart_totals">
                            <div class="heading_s1 mb-3">
                                <h6>Cart Totals</h6>
                            </div>
                            <div class="table-responsive">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td class="cart_total_label">Cart Subtotal</td>
                                            <td class="cart_total_amount">Rs. <span class="cartTotal"><?= $total ?></span></td>
                                        </tr>
                                        <tr>
                                            <td class="cart_total_label">Shipping</td>
                                            <td class="cart_total_amount">Free Shipping</td>
                                        </tr>
                                        <tr>
                                            <td class="cart_total_label">Total</td>
                                            <td class="cart_total_amount"><strong>Rs. <span class="cartTotal"><?= $total ?></span></strong></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <a href="homepage.php" class="btn btn-default">Add More</a>
                            <a href="checkout.php" class="btn btn-default">Checkout</a>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
</div>
<!-- START SECTION OUR MENU -->

<?php include('footer.php'); ?>

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
                $(this).closest("tr").remove();
            }

            addToCart(itemId, curVal);
            $(this).siblings("input").val(curVal);
        });

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

        $("a.item-remove, a.item_remove").click(function(e) {
            e.preventDefault();
            let itemId = $(this).attr("item-id");

            addToCart(itemId, "");

            $("a.item-remove[item-id='"+itemId+"']").closest("tr").remove();
            $("a.item_remove[item-id='"+itemId+"']").closest("li").remove();
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