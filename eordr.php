<!DOCTYPE html>
<?php 
    include('sessionemp.php');
    $uname = $_SESSION['login_user'];
    $sql = "SELECT * from employee where eid='$uname'";
    $result = mysqli_query($db,$sql);
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
    $oid = $_GET['oid'];
?>
<html>
    <head>
        <title>Student</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="css/grid.css">
        <link rel="stylesheet" type="text/css" href="css/stordstatc.css">
    </head>
    <body>
        <section class="section-cant">
            <div class="row">
                <div class="col span-6-of-12">
                    <img src="images/person.png" class="profile-img">
                    <div style="display: inline-block; vertical-align: super">
                        <?php echo $row['name']?><br>
                        <?php 
                            if(isset($row['custid'])) {
                                echo $row['custid']; 
                            } elseif(isset($row['cid'])) {
                                $cid = $row['cid'];
                                $canteen = "SELECT * from canteen where cid='$cid'";
                                $res = mysqli_query($db,$canteen);
                                $cantrow = mysqli_fetch_array($res,MYSQLI_ASSOC);
                                $cant=$cantrow['name'];
                                $loc=$cantrow['location'];
                                echo "$cant, $loc";
                            } 
                        ?>
                    </div>
                </div>
                <div class="col span-6-of-12 header-btn">
                    <?php if(isset($row['custid'])): ?>
                    <a href="profile.php" class="custom-btn">Profile</a>
                    <?php elseif(isset($row['cid'])): ?>
                    <a href="empprof.php" class="custom-btn">Profile</a>
                    <?php endif; ?>
                    <a href="index.php" class="custom-btn">Logout</a>
                </div>
            </div>
        </section>
        <section class="section-plans">
			<div class="row">
				<h2>Order Number: <?php 
                        echo $oid;
                    ?></h2>
			</div>
            <div class="row">
                <div class="col span-1-of-1 fix-table">
                    <table>
                        <tr>
                            <td width=15 style="text-align: center;"><strong>Item Name</strong></td>
                            <td width=15 style="text-align: center;"><strong>Quantity Date</strong></td>
                            <td width=15 style="text-align: center;"><strong>Price</strong></td>
                        </tr>
                        <?php
                            $eid = $row['eid'];
                            $c = "select * from ord where oid='$oid'";
                            $res = mysqli_query($db,$c);
                            $det = mysqli_fetch_array($res,MYSQLI_ASSOC);
                            $q = "SELECT * from orderdet where oid='$oid'";
                            $r = mysqli_query($db,$q);
                            $printData = [];
                            $note = $det['note'];

                            while($item = mysqli_fetch_array($r,MYSQLI_ASSOC)){
                                $iid = $item['iid'];
                                if($det['cid']==919){
                                    $s = "select * from sjtalacarte where iid='$iid'";
                                    $quer = mysqli_query($db,$s);
                                    $ala = mysqli_fetch_array($quer,MYSQLI_ASSOC);
                                    echo "<tr><td style=\"text-align: center;\">".$ala['name']."</td><td style=\"text-align: center;\">".$item['qty']."</td><td style=\"text-align: center;\">".$item['qty']*$ala['price']."</td></tr>";
                                    $printData[] = [
                                        'name' => $ala['name'],
                                        'qty' => $item['qty'],
                                        'price' => $item['qty']*$ala['price']
                                    ];
                                }
                                else if($det['cid']==943){
                                    $s = "select * from dcalacarte where iid='$iid'";
                                    $quer = mysqli_query($db,$s);
                                    $ala = mysqli_fetch_array($quer,MYSQLI_ASSOC);
                                    echo "<tr><td style=\"text-align: center;\">".$ala['name']."</td><td style=\"text-align: center;\">".$item['qty']."</td><td style=\"text-align: center;\">".$item['qty']*$ala['price']."</td></tr>";
                                    $printData[] = [
                                        'name' => $ala['name'],
                                        'qty' => $item['qty'],
                                        'price' => $item['qty']*$ala['price']
                                    ];
                                }
                                else if($det['cid']==2015){
                                    $s = "select * from nacalacarte where iid='$iid'";
                                    $quer = mysqli_query($db,$s);
                                    $ala = mysqli_fetch_array($quer,MYSQLI_ASSOC);
                                    echo "<tr><td style=\"text-align: center;\">".$ala['name']."</td><td style=\"text-align: center;\">".$item['qty']."</td><td style=\"text-align: center;\">".$item['qty']*$ala['price']."</td></tr>";
                                    $printData[] = [
                                        'name' => $ala['name'],
                                        'qty' => $item['qty'],
                                        'price' => $item['qty']*$ala['price']
                                    ];
                                }
                                else if($det['cid']==2038){
                                    $s = "select * from acalacarte where iid='$iid'";
                                    $quer = mysqli_query($db,$s);
                                    $ala = mysqli_fetch_array($quer,MYSQLI_ASSOC);
                                    echo "<tr><td style=\"text-align: center;\">".$ala['name']."</td><td style=\"text-align: center;\">".$item['qty']."</td><td style=\"text-align: center;\">".$item['qty']*$ala['price']."</td></tr>";
                                    $printData[] = [
                                        'name' => $ala['name'],
                                        'qty' => $item['qty'],
                                        'price' => $item['qty']*$ala['price']
                                    ];
                                }
                                else{
                                    $s = "select * from dalacarte where iid='$iid'";
                                    $quer = mysqli_query($db,$s);
                                    $ala = mysqli_fetch_array($quer,MYSQLI_ASSOC);
                                    echo "<tr><td style=\"text-align: center;\">".$ala['name']."</td><td style=\"text-align: center;\">".$item['qty']."</td><td style=\"text-align: center;\">".$item['qty']*$ala['price']."</td></tr>";
                                    $printData[] = [
                                        'name' => $ala['name'],
                                        'qty' => $item['qty'],
                                        'price' => $item['qty']*$ala['price']
                                    ];
                                }
                            }

                            $_SESSION['print_data'] = $printData;
                            $_SESSION['order_id'] = $oid;
                            $_SESSION['order_note'] = $note;

                            if(isset($_POST['Submit'])){
                                if($_POST['rating']==0){
                                    $l = "update ord set status='Processing', eid='$eid' where oid='$oid'";
                                    $ret = mysqli_query($db,$l);
                                    ?>
                                    <script>
                                        window.location.href = 'http://localhost/canteen-master/thermal-print.php';
                                    </script>
                                    <?php
                                }
                                else{
                                    $l = "update ord set status='Cancelled', eid='$eid' where oid='$oid'";
                                    $ret = mysqli_query($db,$l);
                                    $custid = $det['custid'];
                                    $cm = "select * from customer where custid='$custid'";
                                    $mn = mysqli_query($db,$cm);
                                    $im = mysqli_fetch_array($mn,MYSQLI_ASSOC);
                                    $wallet = $im['wallet'];
                                    $wallet += $det['cost'];
                                    $fin = "update customer set wallet='$wallet' where custid='$custid'";
                                    $qr = mysqli_query($db,$fin);
                                    header('Location: emphome.php');
                                }
                            }
                        ?>

                        <tr>
                            <td width=15 colspan="2" style="text-align: right;">Total Price:</td>
                            <td width=15 style="text-align: center;"><strong><?php echo $det['cost']; ?></strong></td>
                        </tr>
                    </table>
                </div>
                <!-- <div style="text-align:center; margin-top: 2vw;">Total Price : <?php echo $det['cost']; ?></div> -->
                <div style="text-align:center; margin-top: 2vw;"><strong>Note: </strong><?php echo $det['note']; ?></div>

                <div style="border: 2px black; margin: 2vw; margin-bottom: -4vw; background-color:rgba(0, 0, 0, 0.59); padding:2vw; color:white;">
                    <form method="post" id="sjt" name="sjt" style="text-align: center;" action="<?php $_PHP_SELF ?>">
                        <label for="rating" style="font-family: 'Lato','Arial', sans-serif;font-weight: 300;font-size: 20px;">Your Choice: </label>
                        <input type="radio" name="rating" value=0 style="margin:2vw 0.5vw 2vw 4vw;">Accept
                        <input type="radio" name="rating" value=1 style="margin:2vw 0.5vw 2vw 0.5vw;" checked>Decline<br>
                        <input type="submit" for="sjt" value="Submit" id="Submit" name="Submit" style="box-shadow: 4px 4px 10px rgba(12, 10, 72, 0.15); text-align: center; padding: 1%;border: 2px solid #18314f;background-color: #18314f; color: white; font-family: 'Lato','Arial', sans-serif;font-weight: 300;font-size: 20px;">
                    </form>
                    <br>
                </div>
            </div>
		</section>
        <section class="section-plans">
            <div class="row">
                <div class="col span-1-of-1 dashboard-menu">
                    <a style="text-decoration: none; color:#18314f;" class="mx-auto" href="emphome.php">
                        <div class="col span-1-of-1" style="box-shadow: 4px 4px 10px rgba(72, 39, 10, 0.15); text-align: center; padding: 1%;border: 2px solid #18314f;">
                            GO BACK
                        </div>
                    </a>
                </div>
            </div>
        </section>
   </body>
</html>