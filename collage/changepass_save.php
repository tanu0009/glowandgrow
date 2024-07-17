<?php session_start();
if(!isset($_SESSION['XUID']) || !isset($_SESSION['XUSRNM'])){session_destroy();echo "login.php";exit;}
if($_SERVER['REQUEST_METHOD']!='POST' || empty($_POST)){echo "404.php";exit;}
require_once("db/conn.php");

$cur_pass=$connection->real_escape_string(trim($_POST['cur_pass']));
$password=$connection->real_escape_string(trim($_POST['password_confirmation']));
$password2=$connection->real_escape_string(trim($_POST['password']));

if($password==$password2){
	
	$passr=$connection->query("SELECT user_password FROM lad_mst_users WHERE user_password='".$cur_pass."' AND u_id=".$_SESSION['XUID']);
	if($passr->num_rows==1){
		$upassr=$connection->query("UPDATE lad_mst_users SET user_password='".$password."' WHERE u_id=".$_SESSION['XUID']);
		echo "success";
	}
	else echo "Incorrect Current Password";
	$passr->free();
}
else echo "Passwords do NOT match";
$connection->close();
?>