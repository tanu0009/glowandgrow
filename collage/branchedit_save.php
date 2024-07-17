<?php session_start();
if(!isset($_SESSION['XUID']) || !isset($_SESSION['XUSRNM'])){session_destroy();echo "login.php";exit;}
//if(!in_array(4,$_SESSION['adrole'])){echo "404.php";exit;}
if($_SERVER['REQUEST_METHOD']!='POST' || empty($_POST)){echo "404.php";exit;}
require_once("db/conn.php");

$uid=$_POST['uid'];

	$updateq="UPDATE lad_mst_branch SET cat_name='".$_POST['gal_caption']."',address='".$_POST['address']."',goaddress='".$_POST['goaddress']."',sortby='".$_POST['sortby']."' WHERE cat_id=".$uid;
	
	$updater=$connection->query($updateq);
	if($updater){
		echo "success";
	}
	else echo "An unknown error occured. Please try again.";
$connection->close();
?>