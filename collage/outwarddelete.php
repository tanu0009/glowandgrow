<?php session_start();
if(!isset($_SESSION['XUID']) || !isset($_SESSION['XUSRNM'])){session_destroy();header("location:login.php");}
//if(!in_array(1,$_SESSION['adrole'])){header("location:404.php");}
if($_SERVER['REQUEST_METHOD']!='GET' || empty($_GET)){header("location:404.php");}
require_once("db/conn.php");

$selrimg=$connection->query("SELECT docfile FROM lad_trn_outward WHERE outwardsrno=".$_GET['id']);
$selrowimg=$selrimg->fetch_assoc();
$selrimg->free();
if(!is_null($selrowimg['docfile']))@unlink("../uploads/outward/".$_GET['id'].".".$selrowimg['docfile']);

$delr=$connection->query("DELETE FROM lad_trn_outward WHERE outwardsrno=".$_GET['id']);
$connection->close();

if($delr)$msg="delete_success";
else $msg="delete_failed";
header("location:outward.php?msg=".$msg);
?>