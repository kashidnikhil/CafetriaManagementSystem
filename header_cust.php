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
                    $cid = $row['cid'];
                    $canteen = "SELECT * from canteen where cid='$cid'";
                    $res = mysqli_query($db,$canteen);
                    $cantrow = mysqli_fetch_array($res,MYSQLI_ASSOC);

                    $cant=$cantrow['name'];
                    $loc=$cantrow['location'];
                ?>
                <a class="nav-link" href="#">
                    <i class="ti-user"></i><span> <?= $row['name'] ?><br><?= $cant.", ".$loc ?></span>
                </a>
            </div>
        </nav>
    </div>
</header>
<!-- END HEADER -->