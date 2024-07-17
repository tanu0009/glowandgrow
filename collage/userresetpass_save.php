<?php session_start();
if(!isset($_SESSION['adid']) || !isset($_SESSION['aduser'])){session_destroy();echo "login.php";exit;}
//if(!in_array(2,$_SESSION['adrole'])){echo "404.php";exit;}
if($_SERVER['REQUEST_METHOD']!='POST' || empty($_POST)){echo "404.php";exit;}
require_once("db/conn.php");

$uid=$_POST['uid'];
$password=md5($connection->real_escape_string(trim($_POST['password_confirmation'])));
$password2=md5($connection->real_escape_string(trim($_POST['password'])));

if($password==$password2){
	$updateq="UPDATE vp_mst_users SET password='$password',modifiedby='".$_SESSION['adid']."' WHERE usersrno=".$uid;
	$updater=$connection->query($updateq);
	if($updater)echo "success";
	else echo "An unknown error occured. Please try again.";
}
else echo "Passwords DO NOT match.";
$connection->close();
?>