i<!DOCTYPE html>
<?php 
    include('sessionemp.php');
    $uname = $_SESSION['login_user'];
    $sql = "SELECT * from employee where eid='$uname'";
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
                            echo "$cant, $loc"; 
                        ?>
                    </div>
                </div>
                <div class="col span-6-of-12 header-btn">
                    <a href="empprof.php" class="custom-btn">Profile</a>
                    <a href="index.php" class="custom-btn">Logout</a>
                </div>
            </div>
        </section>
        <section class="section-cant" id="cities">
            <div class="row">
            <br><br><br>
                <h2>Food Items</h2>
            </div>
            <div class="row">
                <div class="row">
                    <table>
                        <tr>
                            <td width=15><strong>Category</strong></td>
                            <td width=15><strong>Image</strong></td>
                        </tr>
                    <?php 
                        $qb = "select * from (select eid, sum(cost)/count(eid) as jo from ord where status = 'Completed' group by eid) as t order by jo desc";
                        $mb = mysqli_query($db,$qb);
                        while($item = mysqli_fetch_array($mb, MYSQLI_ASSOC)){
                            $eid = $item['eid'];
                            $name = "select * from employee where eid='$eid'";
                            $r = mysqli_query($db,$name);
                            $nm = mysqli_fetch_array($r,MYSQLI_ASSOC);
                            $cid = $nm['cid'];
                            $c = "select name from canteen where cid=".$cid."";
                            $s = mysqli_query($db,$c);
                            $cant = mysqli_fetch_array($s, MYSQLI_ASSOC);
                            echo "<tr><td>".$nm['name']."</td><td>".$cant['name']."</td></tr>";
                        }
                    ?>
                    </table>
                </div>
            </div>
        </section>
        <section class="section-plans">
            <div class="row">
                <h2>DASHBOARD</h2>
            </div>
            <div class="row">
                <div class="col span-1-of-1 dashboard-menu">
                    <a style="text-decoration: none; color:#18314f;" href="emordstat.php">
                        <div class="col span-1-of-1" style="box-shadow: 4px 4px 10px rgba(72, 39, 10, 0.15); text-align: center; padding: 1%;border: 2px solid #18314f;">
                            Pending Orders
                        </div>
                    </a>
                    <a style="text-decoration: none; color: white;" href="emordview.php">
                        <div class="col span-1-of-1" style="box-shadow: 4px 4px 10px rgba(72, 39, 10, 0.15); text-align: center; padding: 1%;border: 2px solid #18314f;background-color: #18314f;">
                            Completed Orders
                        </div>
                    </a>
                    <a style="text-decoration: none; color: white;" href="add-item.php">
                        <div class="col span-1-of-1" style="box-shadow: 4px 4px 10px rgba(72, 39, 10, 0.15); text-align: center; padding: 1%;border: 2px solid #18314f;background-color: #18314f;">
                            Add Items
                        </div>
                    </a>
                    <a style="text-decoration: none; color:#18314f;" href="food-category-list.php">
                        <div class="col span-1-of-1" style="box-shadow: 4px 4px 10px rgba(72, 39, 10, 0.15); text-align: center; padding: 1%;border: 2px solid #18314f;">
                            View Category
                        </div>
                    </a>
                </div>
            </div>
        </section>
   </body>
</html>
