<?php
include('sessionemp.php');

$ordArr = [];
if(isset($_SESSION['counter_user'])) {
  $uname = $_SESSION['counter_user'];
  $sql = "SELECT ord.oid, ord.cid, ord.odate, ord.cost FROM ord LEFT JOIN orderdet ON ord.oid=orderdet.oid LEFT JOIN sjtalacarte AS sjt ON sjt.iid=orderdet.iid LEFT JOIN food_category AS fc ON fc.id=sjt.category WHERE fc.username='$uname'";
  $result = mysqli_query($db,$sql);
  while($ord = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
    $ordArr[] = [
      'oid' => $ord['oid'],
      'cid' => $ord['cid'],
      'odate' => $ord['odate'],
      'cost' => $ord['cost']
    ];
  }
} else {
  $sql = "SELECT oid, cid, odate, cost FROM ord";
  $result = mysqli_query($db,$sql);
  while($ord = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    $ordArr[] = [
      'oid' => $ord['oid'],
      'cid' => $ord['cid'],
      'odate' => $ord['odate'],
      'cost' => $ord['cost']
    ];
  }
}

echo json_encode($ordArr);
?>