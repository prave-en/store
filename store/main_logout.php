	<?php
session_start(['main_login_session']);
unset($_SESSION["main_login_session"]);
header("Location: login.php");
?>