<?php
//error_reporting(0);
// Includes Login Script
if(isset($_SESSION['main_login_session'])){
header("location: index.php"); // Redirecting To Profile Page
}
?>

<?php
session_start(['main_login_session']); // Starting Session
$error = ''; // Variable To Store Error Message
if (isset($_POST['main_login'])) {
if (empty($_POST['main_username']) || empty($_POST['main_password'])) {
$error = "Username or Password is invalid";
}
else{
// Define $username and $password
$main_username = $_POST['main_username'];
$main_password = $_POST['main_password'];
$main_password = md5($main_username.$main_password);
//$main_password = md5($main_username.$main_password);
$_SESSION['start_time'] = time();
// mysqli_connect() function opens a new connection to the MySQL server.
include ('database/database_connection1.php');
// SQL query to fetch information of registerd users and finds user match.
$query = "SELECT main_username, main_password from main_login where main_username=? AND main_password=? LIMIT 1";
// To protect MySQL injection for Security purpose
$stmt = $con->prepare($query);
$stmt->bind_param("ss", $main_username, $main_password);
$stmt->execute();
$stmt->bind_result($main_username, $main_password);
$stmt->store_result();
if($stmt->fetch()) //fetching the contents of the row {
$_SESSION['main_login_session'] = $main_username; // Initializing Session
header("location: index.php"); // Redirecting To Profile Page
}
mysqli_close($con); // Closing Connection
}
?>

<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="css/main.css">
  <link rel="stylesheet" type="text/css" href="css/login.css">
  <title>login</title>
  <style type="text/css"> 
  </style>
</head>
<body>
  <img class="lnimg" src="image/final logo.png">
  <h3 class="lntitle"><font color="#0B203E"> AAISELU / STORE </font></h3>
<hr class="hr1">
<table border="0" class="box" align="center">
  <tr height="400px">
      <td width="400px" align="center">
        <form action="" method="post" autocomplete="off">
      <b>LOGIN</b><br><br><br>
      Username<br>
      <input type="text" name="main_username" required=""><br><br>
      Password<br>
      <input type="password" name="main_password" required=""><br><br><br>
      <input type="submit" name="main_login" value="LOGIN" class="entrybtn"><br><br>
      <a href="signup.php">Signup</a>
      </form>
        </td></tr>
  </table>
  <div class="hr2"><hr></div>
  <h5 align="center"><i>&copy copyright 2020</i></h5>
 
</body>
</html>