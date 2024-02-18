<!-- START HEADER -->
<header class="header_wrap header_with_topbar dark_skin main_menu_uppercase"><!--fixed-top-->
    <div class="container">
        <nav class="navbar navbar-expand-lg"> 
            <a class="navbar-brand" href="homepage.php">
                <img class="logo_light" src="assets/images/logo_light.png" alt="logo">
                <img class="logo_dark" src="assets/images/logo_dark.png" alt="logo">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidebar-menu" aria-expanded="false"> 
            	<span class="ion-android-menu"></span>
            </button>
            <div class="user-account">
                <a class="nav-link" href="#">
                    <i class="ti-user"></i><span> <?= $row['name'] ?><br><?= $row['custid'] ?></span>
                </a>
            </div>
            <div class="cart-count">            
                <a class="nav-link cart_trigger" href="javascript:void(0);">
                    <i class="linearicons-cart"></i>
                    <span class="cart_count"><?= isset($_SESSION['cart'])?count($_SESSION['cart']):0 ?></span>
                </a>                
                <div class="cart_box">
                    <div class="cart_header">
                        <h3>Your Cart</h3>
                    </div>
                    <ul class="cart_list" id="cart_list">
                        <?php 
                            $cartItems = [];
                            $cartTotal = 0;

                            if(isset($_SESSION['cart']) || !empty($_SESSION['cart'])) {
                                $cartItems = $_SESSION['cart'];
                            }

                            foreach($cartItems as $key => $value) {
                                if($key != "undefined") {
                                $iQuery = "SELECT * FROM sjtalacarte WHERE iid=".$key;
                                $iRes = mysqli_query($db,$iQuery);
                                $item = mysqli_fetch_array($iRes, MYSQLI_ASSOC);
                        ?>
                        <li>
                            <a href="#" class="item_remove" item-id="<?= $key ?>"><i class="ion-close"></i></a>
                            <a href="#"><img src="uploads/<?= $item['image'] ?>" alt="<?= $item['name'] ?>"><?= $item['name'] ?></a>
                            <span class="cart_quantity"> <?= $value ?> x <span class="cart_amount"> <span class="price_symbole">Rs. </span></span><?= $item['price'] ?></span>
                        </li>
                        <?php 
                            $cartTotal += ($item['price'] * intval($value)); } }
                            if(!isset($_SESSION['cart']) || empty($_SESSION['cart'])) { ?>
                             <li class="text-center">
                                Cart is empty.
                            </li>
                        <?php } ?>
                    </ul>
                    <div class="cart_footer">
                        <p class="cart_total"><strong>Total:</strong> <span class="cart_price"> <span class="price_symbole">Rs. </span><span id="cartTotalAmt"><?= $cartTotal ?></span></span></p>
                        <p class="cart_buttons"><a href="checkout.php" class="btn btn-default btn-radius checkout">Checkout</a></p>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</header>
<!-- END HEADER -->