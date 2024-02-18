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

<!-- START SECTION SHOP -->
<div class="section">
	<div class="container">
        <div class="row">            
            
            <?php include('sidebar.php'); ?>

            <div class="col-lg-9 col-sm-12 col-12">
                <!-- START SECTION BREADCRUMB -->
                <div class="breadcrumb_section background_bg page_title_light">
                    <div class="page-title">
                        <h1>Checkout</h1>
                    </div>
                </div>
                <!-- END SECTION BREADCRUMB -->
                <div class="row">
                    <div class="col-lg-12 col-12">
                        <div class="order_review">
                            <div class="heading_s1">
                                <h4>Your Orders</h4>
                            </div>
                            <?php
                                if($_SERVER['REQUEST_METHOD'] == 'POST'){
                                    $ala = "SELECT * from sjtalacarte";
                                    $res = mysqli_query($db,$ala);
                                    $x = 0;

                                    $cartItemArr = [];

                                    if(isset($_SESSION['cart'])) {
                                        $cartItemArr = $_SESSION['cart'];
                                    }

                                    while($item = mysqli_fetch_array($res, MYSQLI_ASSOC)){
                                        $it = $item['iid'];
                                        $pr = $item['price'];
                                        
                                        if(isset($cartItemArr[$it]) && $cartItemArr[$it]!=NULL){
                                            $ord[$x]=$it;
                                            $pri[$x]=$pr;
                                            $qty[$x++]=$cartItemArr[$it];
                                        }
                                    }
                                    $cost = 0;
                                    for($y=0;$y<$x;$y++){
                                        $cost = $cost+$pri[$y]*$qty[$y];
                                    }
                                    if($row['wallet']>=$cost){
                                        $date = date("Y-m-d");
                                        $cust = $row['custid'];
                                        $note = $_POST['order_note'];
                                        $add = "INSERT INTO ord(cid,custid,odate,cost,note,status) VALUES ('919','$cust','$date','$cost','$note','Received')";
                                        $retval = mysqli_query($db,$add);
                                        $m = mysqli_query($db,"select max(oid) from ord");
                                        $max = mysqli_fetch_array($m,MYSQLI_ASSOC);
                                        $oid = $max['max(oid)'];
                                        for($y=0;$y<$x;$y++){
                                            $add = "INSERT INTO orderdet VALUES('$oid','$ord[$y]','$qty[$y]')";
                                            $retval = mysqli_query($db,$add);
                                        }
                                        $balance=$row['wallet']-$cost;
                                        $add="update customer set wallet='$balance' where custid='$cust'";
                                        $retval = mysqli_query($db,$add);

                                        echo "<script>alert('Order Placed!');</script>";
                                        echo "<script>window.location.href='stordstat.php';</script>";
                                        unset($_SESSION['cart']);
                                    } else {
                                        echo "<script>alert('Not enough Balance in your wallet');</script>";
                                    }
                                }
                            ?>
                            <form method="POST" action="<?php $_PHP_SELF ?>">
                            <div class="table-responsive order_table">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody id="cartTable">                                        
                                        <?php 
                                            $cartArr = [];
                                            $total = 0;

                                            if(isset($_SESSION['cart'])) {
                                                $cartArr = $_SESSION['cart'];
                                            }

                                            foreach($cartArr as $key => $value) {
                                                if($key != "undefined") {
                                                $iQuery = "SELECT * FROM sjtalacarte WHERE iid=".$key;
                                                $iRes = mysqli_query($db,$iQuery);
                                                $item = mysqli_fetch_array($iRes, MYSQLI_ASSOC);
                                        ?>
                                        <tr>
                                            <td><?= $item['name'] ?> <span class="product-qty">x <?= intval($value) ?></span></td>
                                            <td>Rs. <?= ($item['price'] * intval($value)) ?></td>
                                        </tr>
                                        <?php $total += ($item['price'] * intval($value)); } } ?>
                                        <?php if(!isset($_SESSION['cart']) || empty($_SESSION['cart'])) { ?>
                                             <tr>
                                                <td class="text-center" colspan="2">
                                                    Cart is empty.
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>SubTotal</th>
                                            <td class="product-subtotal">Rs. <span class="cartTotalAmt"><?= $total ?></span></td>
                                        </tr>
                                        <tr>
                                            <th>Shipping</th>
                                            <td>Free Shipping</td>
                                        </tr>
                                        <tr>
                                            <th>Total</th>
                                            <td class="product-subtotal">Rs. <span class="cartTotalAmt"><?= $total ?></span></td>
                                        </tr>
                                    </tfoot>
                                </table>
                                <div class="form-group">
                                    <textarea class="form-control" name="order_note" id="order_note" placeholder="Order notes" rows="2" maxlength="100"></textarea>
                                </div>
                            </div>
                            <?php if(!isset($_SESSION['cart']) || empty($_SESSION['cart'])) { ?>
                                <a href="homepage.php" class="btn btn-default">Add Item</a>
                            <?php } else { ?>
                            <div class="payment_method">
                                <div class="heading_s1">
                                    <h4>Payment</h4>
                                </div>
                                <div class="payment_option">
                                    <div class="custome-radio">
                                        <input class="form-check-input" required="" type="radio" name="payment_option" id="exampleRadios3" value="option3" checked="">
                                        <label class="form-check-label" for="exampleRadios3">Direct Bank Transfer</label>
                                        <p data-method="option3" class="payment-text">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration. </p>
                                    </div>
                                    <div class="custome-radio">
                                        <input class="form-check-input" type="radio" name="payment_option" id="exampleRadios4" value="option4">
                                        <label class="form-check-label" for="exampleRadios4">Check Payment</label>
                                    </div>
                                    <div class="custome-radio">
                                        <input class="form-check-input" type="radio" name="payment_option" id="exampleRadios5" value="option5">
                                        <label class="form-check-label" for="exampleRadios5">Paypal</label>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-default">Place Order</button>
                            <?php } ?>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END SECTION SHOP -->

<?php include('footer.php'); ?>

<!-- <a href="#" class="scrollup" style="display: none;"><i class="ion-ios-arrow-up"></i></a> -->

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
            let tableStr = ``;
            let total = 0;

            $.each(cart, (key, item) => {
                cartStr += `<li>
                            <a href="#" class="item_remove" item-id="${key}"><i class="ion-close"></i></a>
                            <a href="#"><img src="uploads/${item.image}" alt="${item.name}">${item.name}</a>
                            <span class="cart_quantity"> ${item.quantity} x <span class="cart_amount"> <span class="price_symbole">Rs. </span></span>${item.price}</span>
                        </li>`;

                let itemTotal = (parseInt(item.quantity) * parseFloat(item.price));

                tableStr += `<tr>
                            <td>${item.name} <span class="product-qty">x ${item.quantity}</span></td>
                            <td>Rs. ${itemTotal}</td>
                        </tr>`;

                total += itemTotal;
            });

            $("#cart_list").html(cartStr);
            $("#cartTable").html(tableStr);
            $("#cartTotalAmt, .cartTotalAmt").text(total);
        }
    });
</script>

</body>
</html>