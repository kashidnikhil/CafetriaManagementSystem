<!DOCTYPE html>
<?php 
    include('sessionemp.php');
    $uname = $_SESSION['login_user'];
    $sql = "SELECT * from employee where eid='$uname'";
    $result = mysqli_query($db,$sql);
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
    $cid = $row['cid'];
    $s = "SELECT * from canteen where cid='$cid'";
    $res = mysqli_query($db,$s);
    $cant = mysqli_fetch_array($res,MYSQLI_ASSOC);
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
                    <?php       
                        $cid = $row['cid'];
                        $canteen = "SELECT * from canteen where cid='$cid'";
                        $res = mysqli_query($db,$canteen);
                        $cantrow = mysqli_fetch_array($res,MYSQLI_ASSOC);
                    ?>
                    <img src="images/person.png" class="profile-img">
                    <div style="display: inline-block; vertical-align: super">
                        <?php echo $row['name']?><br>
                        <?php 
                            $cant=$cantrow['name'];
                            $loc=$cantrow['location'];
                            echo "$cant, $loc" 
                        ?>
                    </div>
                </div>
                <div class="col span-6-of-12 header-btn">
                    <a href="empprof.php" class="custom-btn">Profile</a>
                    <a href="index.php" class="custom-btn">Logout</a>
                </div>
            </div>
        </section>
        <section class="section-plans">
			<div class="row">
				<h2>Today's Orders : (<?php echo $cant; ?>)</h2>
			</div>
		</section>
        <section class="section-cant">
            <div class="row">
                <table>
                    <tr>
                        <td width=15 style="text-align: center;"><strong>Order Number</strong></td>
                        <td width=15 style="text-align: center;"><strong>Order Date</strong></td>
                        <td width=15 style="text-align: center;"><strong>Price</strong></td>
                        <td width=15 style="text-align: center;"><strong>Status</strong></td>
                    </tr>
                    <?php 
                        $al = "select * from ord where cid='$cid'";
                        $res = mysqli_query($db,$al);
                        while($item = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
                            if(strcmp($item['status'],'Cancelled')==0){
                                echo "<tr><td style=\"text-align: center;\">".$item['oid']."<td style=\"text-align: center;\">".$item['odate']."<td style=\"text-align: center;\">".$item['cost']."</td>";
                                echo "<td style=\"margin:10px; background: rgba(245, 70, 70, 0.8);color:black; text-align: center;\"><a href='empordview.php?oid=".$item['oid']."' style=\"text-decoration:none; color:black;\">Cancelled</a></td>";
                                echo "</tr>";                               
                            }
                            else if(strcmp($item['status'],'Completed')==0){
                                echo "<tr><td style=\"text-align: center;\">".$item['oid']."<td style=\"text-align: center;\">".$item['odate']."<td style=\"text-align: center;\">".$item['cost']."</td>";
                                echo "<td style=\"margin:10px; background: rgba(58, 216, 51, 0.8);color:black; text-align: center;\"><a href='empordview.php?oid=".$item['oid']."' style=\"text-decoration:none; color:black;\">Completed</a></td>";
                                echo "</tr>";                               
                            }
                        }
                    ?>
                </table>
            </div>
        </section>
        <section class="section-plans">
            <div class="row">
                <a style="text-decoration: none; color:#18314f;" href="emphome.php">
                    <div class="col span-5-of-11" style="box-shadow: 4px 4px 10px rgba(72, 39, 10, 0.15); text-align: center; padding: 1%;border: 2px solid #18314f;">
                        GO BACK
                    </div>
                </a>
                <div class="col">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                <a style="text-decoration: none; color: white;" href="emordstat.php">
                    <div class="col span-5-of-11" style="box-shadow: 4px 4px 10px rgba(12, 10, 72, 0.15); text-align: center; padding: 1%;border: 2px solid #18314f;background-color: #18314f;">
                        TODAY'S ORDER
                    </div>
                </a>
            </div>
        </section>
   </body>
</html>