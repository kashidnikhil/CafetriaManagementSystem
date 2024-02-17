<?php
session_start();

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

//print_r($_SESSION['cart']);
echo "true";
?>