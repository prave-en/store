<?php
include('../main_session.php');
if(!isset($_SESSION['main_login_session'])){
header("location: ../login.php"); // Redirecting To Home Page
}
$a = $_SESSION['start_time'];
$b = time() - $a;
if(isset($_SESSION['main_login_session'])){
  if ($b > 36000) {
   unset($_SESSION["main_login_session"]);
  }}
?>
