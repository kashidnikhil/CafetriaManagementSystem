<?php
include('sessioncust.php');

$cartArr = [];

if(isset($_SESSION['cart'])) {
  $cartArr = $_SESSION['cart'];
}

if($_POST['quantity'] != "") {
  $cartArr[$_POST['itemId']] = $_POST['quantity'];
} else {
  unset($cartArr[$_POST['itemId']]);
}

$_SESSION['cart'] = $cartArr;

$cartItemArr = [];

foreach($cartArr as $key => $value) {
  if($key != "undefined") {
    $iQuery = "SELECT * FROM sjtalacarte WHERE iid=".$key;
    $iRes = mysqli_query($db,$iQuery);
    $item = mysqli_fetch_array($iRes, MYSQLI_ASSOC);

    $cartItemArr[$key] = [
      'image' => $item['image'], 
      'name' => $item['name'],
      'price' => $item['price'],
      'quantity' => $value
    ];
  }
}

$response = [
  'result' => 'true',
  'count' => count($cartItemArr),
  'cart' => $cartItemArr
];

echo json_encode($response);
?>