<!DOCTYPE html>
<html>
<head>
	<title>signup</title>
</head>
<body>

<form action="" method="POST">
	<input type="text" name="main_username" placeholder="username" required=""><br><br>
	<input type="password" name="main_password" placeholder="password" required=""><br><br>
	<input type="submit" name="signup" value="Signup">
</form>
</body>
</html>

<?php
include("database/database_connection.php");
//include("database/database_connection1.php");
include("database/database_connection2.php");
//error_reporting(0);
$sql="SELECT count(id) AS total FROM main_login";
$result=mysqli_query($con,$sql);
$values=mysqli_fetch_assoc($result);
$num_row=$values['total'];
//echo ($num_row);
if ($num_row==0) {

	$main_username = $_POST['main_username'];
	$main_password = $_POST['main_password'];
	$main_password = md5($main_username.$main_password);

$pdo_add = $con->prepare("INSERT INTO main_login (main_username,main_password) VALUES (:main_username,:main_password)");
$pdo_add->bindparam(':main_username',$main_username);
$pdo_add->bindparam(':main_password',$main_password);
$pdo_add->execute();
}
else{

?>
<script >
alert("signup failes");
location= "login.php";
</script>
<?php

} ?>