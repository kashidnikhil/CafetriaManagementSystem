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
                <?php
                    if(isset($_SESSION['counter_user'])) {
                        $id = $row['id'];
                        $counter = "SELECT * FROM food_category WHERE id=$id";
                        $res = mysqli_query($db,$counter);
                        $counterRow = mysqli_fetch_array($res,MYSQLI_ASSOC);
                    ?>
                    <a class="nav-link" href="#">
                        <i class="ti-user"></i><span> <?= $counterRow['holder'] ?><br><?= $counterRow['username'] ?></span>
                    </a>
                    <?php
                    } else {
                        $cid = $row['cid'];
                        $canteen = "SELECT * FROM canteen WHERE cid='$cid'";
                        $res = mysqli_query($db,$canteen);
                        $cantrow = mysqli_fetch_array($res,MYSQLI_ASSOC);

                        $cant=$cantrow['name'];
                        $loc=$cantrow['location'];
                    ?>
                    <a class="nav-link" href="#">
                        <i class="ti-user"></i><span> <?= $row['name'] ?><br><?= $cant.", ".$loc ?></span>
                    </a>
                    <?php
                    }
                ?>                
            </div>
            <div class="cart-count">            
                <a class="nav-link" href="emordstat.php">
                    <i id="order-bell" class="ti-bell"></i>
                </a>
            </div>
        </nav>
    </div>
    <audio id="bell-sound">
      <source src="assets/ring.mp3">
    </audio>
</header>
<!-- END HEADER -->
<script>
    const getOrderData = () => {
        fetch("getOrderData.php")
        .then(result => result.json())
        .then(data => {
            if(localStorage.getItem("orders") === null || (localStorage.getItem("orders") !== JSON.stringify(data))) {
                localStorage.setItem("orders", JSON.stringify(data));
                document.getElementById("order-bell").classList.add("blink-anim");
                document.querySelector("#bell-sound").play();

                setTimeout(() => {
                    document.getElementById("order-bell").classList.remove("blink-anim");
                }, 6000);
            }
        });
    }

    getOrderData();

    setInterval(getOrderData, 5000);
</script>