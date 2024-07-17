<?php session_start();

if(!isset($_SESSION['XUID']) || !isset($_SESSION['XUSRNM'])){session_destroy();header("location:login.php");}

//if(!in_array(4,$_SESSION['adrole'])){echo "404.php";exit;}

if($_SERVER['REQUEST_METHOD']!='POST' || empty($_POST)){echo "404.php";exit;}

require_once("db/conn.php");

$addq="INSERT INTO lad_sub_scheme(schem_id,sub_scheme_name,sub_scheme_amnt,refund_flag,created_by,created_on) VALUES('".$_POST['schem_id']."','".$_POST['sub_scheme_name']."','".$_POST['sub_scheme_amnt']."','".$_POST['refund_flag']."','".$_SESSION['XUID']."','".date('Y-m-d H:i')."')";

//echo $addq;
		
$addr=$connection->query($addq);
if($addr){
		echo "success";
	}
	else echo "An unknown error occured. Please try again.";

$connection->close();



?>