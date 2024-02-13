<!DOCTYPE html>
<?php 
    include('sessioncust.php');

    $uname = $_SESSION['login_user'];
    $sql = "SELECT * from employee where eid='$uname'";
    $result = mysqli_query($db,$sql);
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
?>
<html>
    <head>
        <title>SJT Canteen</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="css/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="css/grid.css">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    </head>
    <body>
        <section class="section-plans">
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
        <section class="section-cant">
            <div class="row">
                <h2>Food Category</h2>
            </div>
            <div class="row">
                <form method="post" id="sjt" name="sjt" class="custom-form" action="<?php $_PHP_SELF ?>" enctype="multipart/form-data">
                    <?php
                        $catQuery = "select * from food_category";
                        $catMQ = mysqli_query($db,$catQuery);

                        if(isset($_POST['Submit'])){
                            $target_dir = "uploads/";
                            $extension = explode(".", $_FILES["image"]["name"]);
                            $file_name = time(). "." .end($extension);
                            $target_file = $target_dir . $file_name;

                            if ($_FILES["image"]["name"]) {
                              move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
                            }

                            $image = $file_name;
                            $item = $_POST['item'];
                            $category = $_POST['category'];
                            $price = $_POST['price'];
                            $time = $_POST['time'];

                            $add = "INSERT into sjtalacarte(name,category,image,price,time) values ('$item','$category','$image','$price','$time')";
                            $retval = mysqli_query($db,$add);
                            if($retval) {
                        ?>
                        <script>
                            alert("Item added successfully.");
                            window.location.href="items-list.php";
                        </script>
                    <?php
                            }
                        }
                    ?>
                    <label for="image" style="font-family: 'Lato','Arial', sans-serif;font-weight: 300;font-size: 20px; margin-left:4vw;">Image</label>
                    <input type="file" id="image" name="image" style="margin:2vw 4vw;" required>
                    <br>
                    <label for="item" style="font-family: 'Lato','Arial', sans-serif;font-weight: 300;font-size: 20px; margin-left:4vw;">Item Name</label>
                    <input type="text" id="item" name="item" style="margin:2vw 4vw;" required>
                    <br>
                    <label for="category" style="font-family: 'Lato','Arial', sans-serif;font-weight: 300;font-size: 20px; margin-left:4vw;">Item Name</label>
                    <select name="category" id="category" style="margin:2vw 4vw;" required>
                        <?php
                            while($cat = mysqli_fetch_array($catMQ, MYSQLI_ASSOC)){
                                echo "<option value='".$cat['id']."'>".$cat['category']."</option>";
                            }
                        ?>                        
                    </select>
                    <br>
                    <label for="price" style="font-family: 'Lato','Arial', sans-serif;font-weight: 300;font-size: 20px; margin-left:4vw;">Price</label>
                    <input type="number" id="price" name="price" style="margin:2vw 4vw;" required>
                    <br>
                    <label for="time" style="font-family: 'Lato','Arial', sans-serif;font-weight: 300;font-size: 20px; margin-left:4vw;">Time</label>
                    <input type="number" id="time" name="time" style="margin:2vw 4vw;" required>
                    <br>
                    <input type="submit" for="sjt" value="Submit" id="Submit" name="Submit" style="box-shadow: 4px 4px 10px rgba(12, 10, 72, 0.15); text-align: center; padding: 1%;border: 2px solid #18314f;background-color: #18314f; color: white; font-family: 'Lato','Arial', sans-serif;font-weight: 300;font-size: 20px;margin-left:35vw; margin-botton:4vw;"><br>
                </form>
            </div>
        </section>
        <section class="section-plans">
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
                    <a style="text-decoration: none; color: white;" href="items-list.php">
                        <div class="col span-1-of-1" style="box-shadow: 4px 4px 10px rgba(72, 39, 10, 0.15); text-align: center; padding: 1%;border: 2px solid #18314f;background-color: #18314f;">
                            View Items
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
