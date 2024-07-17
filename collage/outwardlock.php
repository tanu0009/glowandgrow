<?php session_start();
if(!isset($_SESSION['XUID']) || !isset($_SESSION['XUSRNM'])){session_destroy();header("location:login.php");}
//if(!in_array($_SESSION['role'],array('su','op'))){header("location:404.php");exit;}
if($_SERVER['REQUEST_METHOD']!='POST' || empty($_POST)){echo "404.php";exit;}
require_once("db/conn.php");
$action=$_POST['action'];
$id=$_POST['id'];
$r=$connection->query("UPDATE lad_trn_outward SET active='$action',modified_by='".$_SESSION['XUID']."',modified_on='".date('Y-m-d H:i')."' WHERE outwardsrno=".$id);
$connection->close();

if($r)echo $action;
else echo "An Unknown error occured. Please try again.";


//$action=$_POST['action'];
/*$id=$_GET['id'];

$r=$connection->query("UPDATE lad_trn_outward SET active='n' WHERE outwardsrno=".$id);
$connection->close();

if($r)$msg="delete_success";
else $msg="delete_failed";*/
header("location:outward.php?msg=".$msg);

?>