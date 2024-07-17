<?php session_start();

if(!isset($_SESSION['XUID']) || !isset($_SESSION['XUSRNM'])){session_destroy();header("location:login.php");}


if($_SERVER['REQUEST_METHOD']!='POST' || empty($_POST)){echo "404.php";exit;}

require_once("db/conn.php");

$uid=$_POST['uid'];

$updateq="UPDATE lad_sub_scheme SET schem_id='".$_POST['schem_id']."',sub_scheme_name='".$_POST['sub_scheme_name']."',sub_scheme_amnt='".$_POST['sub_scheme_amnt']."',modified_by='".$_SESSION['XUID']."',modified_on='".date('Y-m-d H:i')."' WHERE sub_scheme_id=".$uid;
	
$updater=$connection->query($updateq);
if($updater){
		echo "success";
	}
	else echo "An unknown error occured. Please try again.";

$connection->close();

?>