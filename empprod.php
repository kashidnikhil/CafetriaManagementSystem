<!DOCTYPE html>
<?php 
    include('sessionemp.php');
    $uname = $_SESSION['login_user'];
    $sql = "SELECT * from employee where eid='$uname'";
    $result = mysqli_query($db,$sql);
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
    $cid = $row['cid'];
    $canteen = "SELECT * from canteen where cid='$cid'";
    $res = mysqli_query($db,$canteen);
    $cantrow = mysqli_fetch_array($res,MYSQLI_ASSOC);
?>
<html>
    <head>
        <title>SJT Canteen</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="css/grid.css">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    </head>
    <body>
        <section class="section-cant">
            <div class="row">
                <div class="col span-6-of-12">
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
                    <a href="emphome.php" class="custom-btn">Home</a>
                    <a href="index.php" class="custom-btn">Logout</a>
                </div>
            </div>
        </section>
        <section class="section-cant">
            <div class="row">
                <h2>Personal Details</h2>
            </div>
            <?php
                echo "<li style=\"margin-left:25vw; width:30vw;\"><strong>Joining Date: </strong><div style=\"float:right;\">".$row['join_date']."</div></li>";
                echo "<li style=\"margin-left:25vw; width:30vw;\"><strong>Address: </strong><div style=\"float:right;\">".$row['streetname'].", ".$row['city']."</div></li>";
                echo "<li style=\"margin-left:25vw; width:30vw;\"><strong>Phone Number: </strong><div style=\"float:right;\">".$row['phone']."</div></li>";
            ?>
        </section>
        <section class="section-plans">
            <div class="row">
                <h2>Change Password</h2>
            </div>
            <div class="row">
                <form method="post" id="sjt" name="sjt" action="<?php $_PHP_SELF ?>">
                    <?php
                        if(isset($_POST['Submit'])){
                            $eid = $row['empid'];
                            $q="select pwd from eauth where eid='$eid'";
                            $res = mysqli_query($db,$q);
                            $item = mysqli_fetch_array($res,MYSQLI_ASSOC);
                            $o = $_POST['oldpwd'];
                            $n = $_POST['newpwd'];
                            if(strcmp($o,$item['pwd'])==0){
                                $add = "update eauth set pwd='$n' where eid='$custid'";
                                $retval = mysqli_query($db,$add);
                                echo "<script>alert('Password Successfully Updated!')</script>";
                                header('Location: index.php');
                            }
                            else{
                                echo "<script>alert('Enter Correct Password!')</script>";
                            }
                        }
                    ?>
                    <label for="oldpwd" style="font-family: 'Lato','Arial', sans-serif;font-weight: 300;font-size: 20px; margin-left:4vw;">Your Old Password</label>
                    <input type="password" placeholder="Old Password" id="oldpwd" name="oldpwd" style="margin:2vw 4vw; width:60vw; padding: 0.5vw;" required>
                    <br>
                    <label for="newpwd" style="font-family: 'Lato','Arial', sans-serif;font-weight: 300;font-size: 20px; margin-left:4vw;">Your New Password</label>
                    <input type="password" placeholder="New Password" id="newpwd" name="newpwd" style="margin:2vw 4vw; width:60vw; padding: 0.5vw;" required>
                    <br>
                    <input type="submit" for="sjt" value="Submit" id="Submit" name="Submit" style="box-shadow: 4px 4px 10px rgba(12, 10, 72, 0.15); text-align: center; padding: 1%;border: 2px solid #18314f;background-color: #18314f; color: white; font-family: 'Lato','Arial', sans-serif;font-weight: 300;font-size: 20px;margin-left:35vw; margin-botton:4vw;"><br>
                </form>
            </div>
        </section>
   </body>
</html>
