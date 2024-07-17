<?php session_start();
if($_GET['action']=="logout_user_session" && isset($_GET['user'])){
	session_destroy();
	header("location:login.php?msg=user_logout_success&user=".$_GET['user']);
}
else header("location:404.php");
?>