<?php
include('sendmail.php');
session_start();

function random_strings($length_of_string)
{
  $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
  return substr(str_shuffle($str_result), 0, $length_of_string);
}

$_SESSION['OTP'] = random_strings(6);

$mailBody = "Verification OTP: ".$_SESSION['OTP'].".";

echo sendMail($_POST['email'], "Pannash Greens - Verification OTP", $mailBody);
?>