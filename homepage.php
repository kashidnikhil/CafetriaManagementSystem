<!DOCTYPE html>
<?php 
    include('sessioncust.php');
    $uname = $_SESSION['login_user'];
    $sql = "SELECT * from customer where custid='$uname'";
    $result = mysqli_query($db,$sql);
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
?>
<html>
    <head>
        <title>Student</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="css/grid.css">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    </head>
    <body>
        <section class="section-plans">
            <div class="row">
                <div class="col span-6-of-12">
                    <img src="images/person.png" class="profile-img">
                    <div style="display: inline-block; vertical-align: super"><?php echo $row['name']?><br><?php echo $row['custid']?></div>
                </div>
                <div class="col span-6-of-12 header-btn">
                    <a href="profile.php" class="custom-btn">Profile</a>
                    <a href="index.php" class="custom-btn">Logout</a>
                </div>
            </div>
        </section>
        <!-- <section class="section-cant" id="cities">
            <div class="row">
            <br><br><br>
                <h2>Our Canteens</h2>
            </div>
            <div class="row">
                <div class="col span-1-of-5 cities-box">
                   <img src="images/919.jpg"><br><br>
                    <h3><a href="alasjt.php" class="cant" style="text-decoration: none; border: 2px solid #18314f; border-radius: 4px; padding: 2px 4px;">SJT Canteen</a><br><br>Inside SJT</h3>
                </div>
                <div class="col span-1-of-5 cities-box">
                   <img src="images/943.jpg"><br><br>
                    <h3><a href="aladc.php" class="cant" style="text-decoration: none; border: 2px solid #18314f; border-radius: 4px; padding: 2px 4px;">DC</a><br><br>Near TT</h3>
                </div>
                <div class="col span-1-of-5 cities-box">
                   <img src="images/2015.jpg"><br><br>
                    <h3><a href="alanac.php" class="cant" style="text-decoration: none; border: 2px solid #18314f; border-radius: 4px; padding: 2px 4px;">FC (Non AC)</a><br><br>Near TT</h3>
                </div>
                <div class="col span-1-of-5 cities-box">
                   <img src="images/2038.jpg"><br><br>
                    <h3><a href="alaac.php" class="cant" style="text-decoration: none; border: 2px solid #18314f; border-radius: 4px; padding: 2px 4px;">FC (AC)</a><br><br>Near TT</h3>
                </div>
                <div class="col span-1-of-5 cities-box">
                    <img src="images/2299.jpg"><br><br>
                     <h3><a href="aladar.php" class="cant" style="text-decoration: none; border: 2px solid #18314f; border-radius: 4px; padding: 2px 4px;">Darling</a><br><br>Gate 2</h3>
                 </div>
            </div>
            <div class="row">
            <br><br><br>
                <h2>Leaderboard</h2>
            </div>
            <div class="row">
                <div class="col span-1-of-5">
                   &nbsp;
                </div>
                <div class="col span-1-of-5 cities-box">
                    <?php 
                        $best = "select cid, max(tot) from (select cid, sum(cost) as tot from ord group by cid) as T";
                        $res = mysqli_query($db,$best);
                        $ans = mysqli_fetch_array($res, MYSQLI_ASSOC);
                        $name = "select name from canteen where cid=".$ans['cid']."";
                        $res = mysqli_query($db,$name);
                        $nm = mysqli_fetch_array($res, MYSQLI_ASSOC);
                    ?>
                   <img src="images/<?php echo $ans['cid'] ?>.jpg"><br><br>
                    <h3><div class="cant" style="text-decoration: none; border: 2px solid #18314f; border-radius: 4px; padding: 2px 4px;"><?php echo $nm['name'] ?></div><br><strong>SALES</strong><br>Total Sale : <?php echo $ans['max(tot)'] ?></h3>
                </div>
                <div class="col span-1-of-5">
                   &nbsp;
                </div>
                <div class="col span-1-of-5 cities-box">
                   <?php 
                        $mrate = "select max(avrat) from (select cid, sum(rating)/count(cid) as avrat from feedback group by cid) as t";
                        $m = mysqli_query($db,$mrate);
                        $a = mysqli_fetch_array($m, MYSQLI_ASSOC);
                        $rate = "select cid, sum(rating)/count(cid) as avrat from feedback group by cid";
                        $res = mysqli_query($db,$rate);
                        while($ans = mysqli_fetch_array($res, MYSQLI_ASSOC)){
                            if($ans['avrat']==$a['max(avrat)']){
                                $cid = $ans['cid'];
                                $name = "select name from canteen where cid=".$ans['cid']."";
                                $r = mysqli_query($db,$name);
                                $nm = mysqli_fetch_array($r, MYSQLI_ASSOC);
                                break;
                            }
                        }
                    ?>
                   <img src="images/<?php echo $cid ?>.jpg"><br><br>
                    <h3><div class="cant" style="text-decoration: none; border: 2px solid #18314f; border-radius: 4px; padding: 2px 4px;"><?php echo $nm['name'] ?></div><br><strong>SALES</strong><br>Total Rating : <?php echo round($a['max(avrat)'],2) ?></h3>
                </div>
                <div class="col span-1-of-5">
                    &nbsp;
                 </div>
            </div>
        </section> -->
        <section class="section-cant">
            <div class="row">
                <h2>ALAcarte</h2>
            </div>
            <div class="row">
                <form method="post" id="sjt" name="sjt" action="<?php $_PHP_SELF ?>">
                <table style="font-family: 'Lato','Arial', sans-serif;">
                    <tr>
                        <td style="width: 70px;"></td>
                        <td width=150><strong>Item</strong></td>
                        <td width=15><strong>Price (in Rs)</strong></td>
                        <td width=15><strong>Quantity</strong></td>
                    </tr>
                    <?php
                        $ala = "SELECT * from sjtalacarte";
                        $res = mysqli_query($db,$ala);
                        while($item = mysqli_fetch_array($res, MYSQLI_ASSOC)){
                            echo "<tr><td><img src=\"images\\".$item['image']."\"/></td><td>".$item['name']."</td><td>".$item['price']."</td><td align=\"center\"><div class=\"quantity-counter\"><button class=\"dec-btn\">-</button><input type=\"numeric\" class=\"btnsmall quantity-field\" id=\"".$item['iid']."\" name =\"".$item['iid']."\"><button class=\"inc-btn\">+</button></div></td>";
                        }
                        if(isset($_POST['Submit'])){
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
                            }
                            else{
                                echo "<script>alert('Not enough Balance in your wallet');</script>";
                            }
                        }
                    ?>
                </table>
                <div class="field-wrap"><label>Note:</label><input name="order_note" id="order_note" maxlength="100"/></div>
                <div class="section-plans">
                    <div class="row">
                        <div class="col span-1-of-1 dashboard-menu">
                            <a style="text-decoration: none; color:#18314f;" href="homepage.php">
                                <div class="col span-1-of-1" style="box-shadow: 4px 4px 10px rgba(72, 39, 10, 0.15); text-align: center; padding: 1%;border: 2px solid #18314f;font-family: 'Lato','Arial', sans-serif;font-weight: 300;font-size: 20px;">
                                    GO BACK
                                </div>
                            </a>
                            <button type="submit" id="Submit" name="Submit" style="border: 0;" for="sjt">
                                <div class="col span-1-of-1" style="box-shadow: 4px 4px 10px rgba(12, 10, 72, 0.15); text-align: center; padding: 1%;border: 2px solid #18314f;background-color: #18314f; color: white; font-family: 'Lato','Arial', sans-serif;font-weight: 300;font-size: 20px;">CONTINUE</div>
                            </button>
                        </div>                   
                    </div>
                </div>
                </form>
            </div>
        </section>
        <section class="section-plans">
            <div class="row">
                <h2>DASHBOARD</h2>
            </div>
            <div class="row">
                <div class="col span-1-of-1 dashboard-menu">
                    <a style="text-decoration: none; color:#18314f;" href="stordstat.php">
                        <div class="col span-1-of-1" style="box-shadow: 4px 4px 10px rgba(72, 39, 10, 0.15); text-align: center; padding: 1%;border: 2px solid #18314f;">
                            VIEW TODAY'S ORDERS
                        </div>
                    </a>
                    <a style="text-decoration: none; color: white;" href="stordview.php">
                        <div class="col span-1-of-1" style="box-shadow: 4px 4px 10px rgba(72, 39, 10, 0.15); text-align: center; padding: 1%;border: 2px solid #18314f;background-color: #18314f;">
                            ORDER HISTORY
                        </div>
                    </a>
                    <a style="text-decoration: none; color: white;" href="givefeed.php">
                        <div class="col span-1-of-1" style="box-shadow: 4px 4px 10px rgba(72, 39, 10, 0.15); text-align: center; padding: 1%;border: 2px solid #18314f;background-color: #18314f;">
                            GIVE FEEDBACK
                        </div>
                    </a>
                    <a style="text-decoration: none; color:#18314f;" href="viewfeed.php">
                        <div class="col span-1-of-1" style="box-shadow: 4px 4px 10px rgba(72, 39, 10, 0.15); text-align: center; padding: 1%;border: 2px solid #18314f;">
                            VIEW FEEDBACK
                        </div>
                    </a>
                </div>                
            </div>
        </section>

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
            });
        </script>
   </body>
</html>
