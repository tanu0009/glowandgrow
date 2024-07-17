<?php session_start();

if(!isset($_SESSION['XUID']) || !isset($_SESSION['XUSRNM'])){session_destroy();header("location:login.php");}


if($_SERVER['REQUEST_METHOD']!='POST' || empty($_POST)){echo "404.php";exit;}

require_once("db/conn.php");

$uid=$_POST['uid'];

$updateq="UPDATE wr_mst_student SET sname='".$_POST['sname']."',branch='".$_POST['branch']."',class='".$_POST['class']."',modified_by='".$_SESSION['XUID']."',modified_on='".date('Y-m-d H:i')."' WHERE sid=".$uid;
	
$updater=$connection->query($updateq);
if($updater){
		echo "success";
	}
	else echo "An unknown error occured. Please try again.";

$connection->close();

?>