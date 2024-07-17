<?php session_start();
if(!isset($_SESSION['XUID']) || !isset($_SESSION['XUSRNM'])){session_destroy();header("location:login.php");}
//if(!in_array(4,$_SESSION['adrole'])){echo "404.php";exit;}
if($_SERVER['REQUEST_METHOD']!='POST' || empty($_POST)){echo "404.php";exit;}
require_once("db/conn.php");


	$addq="INSERT INTO lad_mst_branch(cat_name,address,sortby,goaddress,created_by,created_on) VALUES('".$_POST['gal_caption']."','".$_POST['address']."','".$_POST['sortby']."','".$_POST['goaddress']."','".$_SESSION['XUID']."','".date('Y-m-d H:i')."')";
	$addr=$connection->query($addq);
	if($addr){
		echo "success";
	}
	else echo "An unknown error occured. Please try again.";
$connection->close();
?>