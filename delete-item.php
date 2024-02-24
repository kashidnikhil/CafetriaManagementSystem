<<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pannash Greens</title>
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Kaushan+Script&display=swap" rel="stylesheet"> 
    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans:100,100i,300,300i,400,400i,600,600i,700,700i&display=swap" rel="stylesheet"> 
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i&display=swap" rel="stylesheet">    
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    <link rel="stylesheet" href="assets/sweetalert/sweetalert2.min.css">

    <!--Sweet alert script-->
    <script src="assets/sweetalert/sweetalert2.min.js"></script>

    <script>
        const simpleModal = (message, redirect='') => {
            Swal.fire({
                text: message,
            }).then(() => {
                if(redirect != '') {
                    window.location.href = redirect;
                }
            });
        }
    </script>
</head>
<body>
<?php
    include('config.php');
    $iid = $_GET['iid'];

    $del = "DELETE FROM sjtalacarte WHERE iid=$iid";
    $retval = mysqli_query($db,$del);
    if($retval) {
    ?>
    <script>
        simpleModal("Item deleted successfully.", "items-list.php");
    </script>
    <?php
    }
?>
</body>
</html>
