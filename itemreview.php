<!DOCTYPE html>
<?php 
    include('sessioncust.php');
    include('sendmail.php');

    $uname = $_SESSION['login_user'];
    $sql = "SELECT * from customer where custid='$uname'";
    $result = mysqli_query($db,$sql);
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
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
        <section class="section-cant">
            <div class="row">
                <h2>GIVE FEEDBACK</h2>
            </div>
            <div class="row">
                <form method="post" id="sjt" name="sjt" class="custom-form" action="<?php $_PHP_SELF ?>" enctype="multipart/form-data">
                    <?php
                        $custid = $row['custid'];
                        if(isset($_POST['Submit'])){
                            $target_dir = "uploads/";
                            $extension = explode(".", $_FILES["image"]["name"]);
                            $file_name = time(). "." .end($extension);
                            $target_file = $target_dir . $file_name;

                            if ($_FILES["image"]["name"]) {
                              move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
                            }

                            $itemId = $_GET['iid'];
                            $orderID = $_GET['oid'];
                            $image = $file_name;
                            $rating = $_POST['rating'];
                            $review = $_POST['comment'];
                            $rdate = date('Y-m-d');

                            $add = "INSERT into item_review(item_id,ord_id,rating,image,review,date) values ($itemId,$orderID,$rating,'$image','$review','$rdate')";
                            $retval = mysqli_query($db,$add);

                            $ala = "SELECT * FROM sjtalacarte WHERE iid=".$_GET['iid'];
                            $res = mysqli_query($db,$ala);
                            $row = mysqli_fetch_array($res, MYSQLI_ASSOC);

                            $mailBody = "
                            Order No.: $orderID<br/>
                            Item Name: ".$row['name']."<br/>
                            Review: $review<br/>
                            Rating: $rating<br/>
                            <img src='' style='width: 200px'/>";

                            sendMail("cssonawane32@gmail.com", "Review for ".$row['name']." From Order No-".$_GET['oid'], $mailBody);
                        ?>
                        <script>
                            alert("Review submitted successfully.");
                            window.location.href="stordview.php";
                        </script>
                        <?php
                        }
                    ?>
                    <label for="image" style="font-family: 'Lato','Arial', sans-serif;font-weight: 300;font-size: 20px; margin-left:4vw;">Image</label>
                    <input type="file" id="image" name="image" style="margin:2vw 4vw;">
                    <br>
                    <label for="rating" style="font-family: 'Lato','Arial', sans-serif;font-weight: 300;font-size: 20px; margin-left:4vw;">Your Rating</label>
                    <select name="rating" id="rating" style="margin:2vw 4vw;">
                        <option value="0">0</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select><br>
                    <label for="comment" style="font-family: 'Lato','Arial', sans-serif;font-weight: 300;font-size: 20px; margin-left:4vw;">Your Feedback</label>
                    <input type="text" placeholder="Enter your feedback here" id="comment" name="comment" style="margin:2vw 4vw;" required>
                    <br>
                    <input type="submit" for="sjt" value="Submit" id="Submit" name="Submit" style="box-shadow: 4px 4px 10px rgba(12, 10, 72, 0.15); text-align: center; padding: 1%;border: 2px solid #18314f;background-color: #18314f; color: white; font-family: 'Lato','Arial', sans-serif;font-weight: 300;font-size: 20px;margin-left:35vw; margin-botton:4vw;"><br>
                </form>
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
                    <a style="text-decoration: none; color: white;" href="viewfeed.php">
                        <div class="col span-1-of-1" style="box-shadow: 4px 4px 10px rgba(12, 10, 72, 0.15); text-align: center; padding: 1%;border: 2px solid #18314f;background-color: #18314f;">
                            VIEW FEEDBACK
                        </div>
                    </a>
                </div>
            </div>
        </section>
   </body>
</html>
