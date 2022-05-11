<?php
// mysqli_connect() function opens a new connection to the MySQL server.
include ('database/database_connection2.php');
session_start();// Starting Session
// Storing Session
$user_check = $_SESSION['main_login_session'];
// SQL Query To Fetch Complete Information Of User
$query = "SELECT main_username from main_login where main_username = '$user_check'";
$ses_sql = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($ses_sql);
$login_session = $row['main_username'];
?>
