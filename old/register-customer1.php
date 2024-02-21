<!DOCTYPE html>
<?php
    function random_strings($length_of_string)
    {
      $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
      return substr(str_shuffle($str_result), 0, $length_of_string);
    }
    
//  include("config.php");
    session_start();

    if($_SERVER["REQUEST_METHOD"] == "POST") {
    // username and password sent from form 
      define('DB_SERVER', 'localhost');
      define('DB_USERNAME', 'root');
      define('DB_PASSWORD', '');
      define('DB_DATABASE', 'canteenmgmt');
      $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);

      if(isset($_SESSION['OTP']) && $_SESSION['OTP'] == $_POST['code']) {
        $custid = strtoupper(random_strings(9));
        $fullname = mysqli_real_escape_string($db,$_POST['full_name']);
        $email = mysqli_real_escape_string($db,$_POST['email']);
        $phone = mysqli_real_escape_string($db,$_POST['phone']);
        $pwd = mysqli_real_escape_string($db,$_POST['pwd']);

        $sql = "INSERT into customer(custid,name,phone,email) values ('$custid','$fullname','$phone','$email')";
        $result = mysqli_query($db,$sql);

        $sql1 = "INSERT into sauth(custid,pwd) values ('$custid','$pwd')";
        $result1 = mysqli_query($db,$sql1);

        if($result) {
          echo "<script>alert('Register successful!');</script>";
          echo "<script>window.location.href='employee.php';</script>";
          //header("location: employee.php");
        }
      } else {
        echo "<script>alert('Invalid code!');</script>";
      }
    }
?>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>VIT Canteen</title>
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,600,700" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link rel="stylesheet" href="css/index.css" />
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
  </head>

  <body>

    <div class="mycontainer">
    <section id="mysection">
      <section id="section0">
        <div class="myrow">
          
          <div class="column1">
              <img id="loginimg" src="images/undraw2.png" />
          </div>

          <div class="column2">
            <div class="content2">
              <h1 class="mt-0">Register</h1>
              <div class="card">
                <nav class="nav-extended btncolor">
                    
                  <div class="nav-content ">
                    <ul class="tabs tabs-transparent">
                      <li class="tab"><a class="active">Customer</a></li>
                    </ul>
                  </div>
                </nav>
              
                <div id="test1" class="col s12 p-15">
                  <div>&nbsp;</div>
                    <div class="row">
                      <form class="col s12 register-form" method="POST" action = "<?php $_PHP_SELF ?>">
                        <div class="row">
                          <div class="input-field col s12">
                            <input id="full_name" type="text" class="validate" name="full_name" value="<?= isset($_POST['full_name'])?$_POST['full_name']:''; ?>" required>
                            <label for="full_name">Full Name</label>
                          </div>
                        </div>
                        <div class="row">
                          <div class="input-field col s12 verification_email">
                            <input id="email" type="email" class="validate" name="email" value="<?= isset($_POST['email'])?$_POST['email']:''; ?>" required>
                            <label for="email">Email</label>
                            <a href="#" id="verify-btn">Verify</a>
                          </div>
                        </div>
                        <div class="row">
                          <div class="input-field col s12">
                            <input id="code" type="text" class="validate" name="code" required>
                            <label for="code">Verification Code</label>
                          </div>
                        </div>
                        <div class="row">
                          <div class="input-field col s12">
                            <input id="phone" type="number" class="validate" name="phone" min="1000000000" max="9999999999" value="<?= isset($_POST['phone'])?$_POST['phone']:''; ?>" required>
                            <label for="phone">Phone</label>
                          </div>
                        </div>
                        <div class="row">
                          <div class="input-field col s12">
                            <input id="pwd" type="password" class="validate" name="pwd" required>
                            <label for="pwd">Password</label>
                          </div>
                        </div>
                        <input type="submit" value="REGISTER" class="waves-effejct waves-light btn btncolor center studentlogin">
                      </form>
                      <p>If you have account, <a href="employee.php">Login here</a>.</p>
                    </div>                             
                </div>
              </div>
            </div>
          </div>

        </div>
      </section>

    </section>

    <div>&nbsp;</div> 

    </div>    
    
    <script>
      $(document).ready(function(){
        $('#verify-btn').click(function(e){
          e.preventDefault();

          $.ajax({url: "sendOTP.php",
            type: "POST",
            data: "email="+$("#email").val(),
            success: function(result){
              alert("OTP sent to your email account.");
            }  
          });
        });
      });
    </script>

</body>
</html>
<!--  YELLOW #FAA41A  GREY #262626-->
