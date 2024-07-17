<?php session_start();
if(!isset($_SESSION['id']) || !isset($_SESSION['user'])){session_destroy();header("location:login.php");}
if(!in_array($_SESSION['role'],array('su','op'))){header("location:404.php");}
if($_SERVER['REQUEST_METHOD']!='GET')header("location:404.php");
require_once("db/conn.php");

$selrimg=$connection->query("SELECT docfile FROM lad_trn_inward WHERE inwardsrno=".$_GET['id']);
$selrowimg=$selrimg->fetch_assoc();
$selrimg->free();
if(!is_null($selrowimg['docfile']))@unlink("../uploads/inward/".$_GET['id'].".".$selrowimg['docfile']);

$delr=$connection->query("DELETE FROM lad_trn_inward WHERE inwardsrno=".$_GET['id']);
$connection->close();

if($delr)$msg="delete_success";
else $msg="delete_failed";
header("location:inward.php?msg=".$msg);
?>