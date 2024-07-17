<?php session_start();

if(!isset($_SESSION['XUID']) || !isset($_SESSION['XUSRNM'])){session_destroy();header("location:login.php");}


if($_SERVER['REQUEST_METHOD']!='POST' || empty($_POST)){echo "404.php";exit;}

require_once("db/conn.php");

$uid=$_POST['uid'];

$updateq="UPDATE lad_mst_bank SET bname='".$_POST['bname']."',bbranch='".$_POST['bbranch']."',bankac='".$_POST['bankac']."',bmicr='".$_POST['bmicr']."',bactype='".$_POST['bactype']."',bifsc='".$_POST['bifsc']."',modified_by='".$_SESSION['XUID']."',modified_on='".date('Y-m-d H:i')."' WHERE bid=".$uid;
	
$updater=$connection->query($updateq);
if($updater){
		echo "success";
	}
	else echo "An unknown error occured. Please try again.";

$connection->close();

?>