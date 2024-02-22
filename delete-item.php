<?php
include('config.php');
$iid = $_GET['iid'];

$del = "DELETE FROM sjtalacarte WHERE iid=$iid";
$retval = mysqli_query($db,$del);
if($retval) {
?>
    <script>
        alert("Item deleted successfully.");
        window.location.href="items-list.php";
    </script>
<?php
}
?>