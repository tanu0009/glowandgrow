<?php session_start();
if(!isset($_SESSION['XUID']) || !isset($_SESSION['XUSRNM'])){session_destroy();header("location:login.php");}
//if(!in_array(1,$_SESSION['adrole'])){header("location:404.php");}
if($_SERVER['REQUEST_METHOD']!='GET' || empty($_GET)){header("location:404.php");}
require_once("db/conn.php");

$memberinfo=$connection->query("SELECT * FROM lad_mst_medical_emergency WHERE meid=".$_GET['id']);
$memberinfodata=$memberinfo->fetch_assoc();
$memberinfo->free();


$delr=$connection->query("DELETE FROM lad_mst_medical_emergency WHERE meid=".$_GET['id']);

$connection->close();
@unlink('../uploads/me-photo/'.$memberinfodata['meid'].".".$memberinfodata['me_photo']);
if($delr)$msg="delete_success";

else $msg="delete_error";
header("location:medical-emergency.php?msg=".$msg);
?>
