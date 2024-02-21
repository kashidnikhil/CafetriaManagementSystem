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
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="css/grid.css">
        <link rel="stylesheet" type="text/css" href="css/stordstatc.css">
    </head>
    <body>
        <section class="section-cant">
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
        <section class="section-plans">
			<div class="row">
				<h2>Your Old Orders</h2>
			</div>
		</section>
        <section class="section-cant">
            <div class="row">
                <div class="col span-1-of-1 max-table">
                    <table>
                        <tr>
                            <td width=15 style="text-align: center;"><strong>Order Number</strong></td>
                            <td width=15 style="text-align: center;"><strong>Order Date</strong></td>
                            <td width=15 style="text-align: center;"><strong>Price</strong></td>
                            <td width=15 style="text-align: center;"><strong>Canteen</strong></td>
                            <td width=15 style="text-align: center;"><strong>Status</strong></td>
                            <td width=15 style="text-align: center;"><strong>Action</strong></td>
                        </tr>
                        <?php 
                            $un = $row['custid'];
                            $al = "select * from ord where custid='$un'";
                            $res = mysqli_query($db,$al);
                            while($item = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
                                if(strcmp($item['odate'],date("Y-m-d"))!=0){
                                    $cid = $item['cid'];
                                    $q = "select name from canteen where cid='$cid'";
                                    $r = mysqli_query($db,$q);
                                    $name = mysqli_fetch_array($r,MYSQLI_ASSOC);
                                    if(strcmp($item['status'],'Cancelled')==0){
                                        echo "<tr><td style=\"text-align: center;\">".$item['oid']."<td style=\"text-align: center;\">".$item['odate']."<td style=\"text-align: center;\">".$item['cost']."<td style=\"text-align: center;\">".$name['name']."</td>";
                                        echo "<td style=\"margin:10px; background: rgba(245, 70, 70, 0.8);color:black; text-align: center;\"><a href='stord.php?oid=".$item['oid']."' style=\"text-decoration:none; color:black;\">Cancelled</a></td>
                                            <td><a href='orderreview.php?oid=".$item['oid']."' class='review-btn'>Review</a></td>"; 
                                        echo "</tr>";                          
                                    }
                                    else if(strcmp($item['status'],'Processing')==0){
                                        echo "<tr><td style=\"text-align: center;\">".$item['oid']."<td style=\"text-align: center;\">".$item['odate']."<td style=\"text-align: center;\">".$item['cost']."<td style=\"text-align: center;\">".$name['name']."</td>";
                                        echo "<td style=\"margin:10px; background: rgba(245, 238, 70, 0.8);color:black; text-align: center;\"><a href='stord.php?oid=".$item['oid']."' style=\"text-decoration:none; color:black;\">Processing</a></td>
                                            <td><a href='orderreview.php?oid=".$item['oid']."' class='review-btn'>Review</a></td>";         
                                        echo "</tr>";                       
                                    }
                                    else if(strcmp($item['status'],'Received')==0){
                                        echo "<tr><td style=\"text-align: center;\">".$item['oid']."<td style=\"text-align: center;\">".$item['odate']."<td style=\"text-align: center;\">".$item['cost']."<td style=\"text-align: center;\">".$name['name']."</td>";
                                        echo "<td style=\"margin:10px; background: rgba(180, 149, 149, 0.8);color:black; text-align: center;\"><a href='stord.php?oid=".$item['oid']."' style=\"text-decoration:none; color:black;\">Received</a></td>
                                            <td><a href='orderreview.php?oid=".$item['oid']."' class='review-btn'>Review</a></td>"; 
                                        echo "</tr>";                               
                                    }
                                    else {
                                        echo "<tr><td style=\"text-align: center;\">".$item['oid']."<td style=\"text-align: center;\">".$item['odate']."<td style=\"text-align: center;\">".$item['cost']."<td style=\"text-align: center;\">".$name['name']."</td>";
                                        echo "<td style=\"margin:10px; background: rgba(58, 216, 51, 0.8);color:black; text-align: center;\"><a href='stord.php?oid=".$item['oid']."' style=\"text-decoration:none; color:black;\">Completed</a></td>
                                            <td><a href='orderreview.php?oid=".$item['oid']."' class='review-btn'>Review</a></td>"; 
                                        echo "</tr>";
                                    }
                                }
                            }
                        ?>
                    </table>
                </div>
            </div>
        </section>

        <section class="section-plans">
            <div class="row">
                <div class="col span-1-of-1 dashboard-menu">
                    <a style="text-decoration: none; color:#18314f;" href="homepage.php">
                        <div class="col span-1-of-1" style="box-shadow: 4px 4px 10px rgba(72, 39, 10, 0.15); text-align: center; padding: 1%;border: 2px solid #18314f;">
                            GO BACK
                        </div>
                    </a>
                    <a style="text-decoration: none; color: white;" href="stordstat.php">
                        <div class="col span-1-of-1" style="box-shadow: 4px 4px 10px rgba(12, 10, 72, 0.15); text-align: center; padding: 1%;border: 2px solid #18314f;background-color: #18314f;">
                            VIEW TODAY'S ORDERS
                        </div>
                    </a>
                </div>
            </div>
        </section>
   </body>
</html>