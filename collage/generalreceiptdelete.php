<?php session_start();
if(!isset($_SESSION['XUID']) || !isset($_SESSION['XUSRNM'])){session_destroy();header("location:login.php");}
//if(!in_array(1,$_SESSION['adrole'])){header("location:404.php");}
if($_SERVER['REQUEST_METHOD']!='GET' || empty($_GET)){header("location:404.php");}
require_once("db/conn.php");

$memberinfo=$connection->query("SELECT * FROM lad_mst_receipt WHERE rec_id=".$_GET['id']);
$memberinfodata=$memberinfo->fetch_assoc();
$memberinfo->free();


$delr=$connection->query("DELETE FROM lad_mst_receipt WHERE rec_id=".$_GET['id']);

$delr1=$connection->query("DELETE FROM lad_mst_receipt_sub WHERE rec_id=".$_GET['id']);

$connection->close();

if($delr1)$msg="delete_success";
else $msg="delete_error";
header("location:generalreceipt.php?msg=".$msg);
?>
