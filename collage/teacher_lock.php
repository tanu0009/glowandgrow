<?php session_start();
if(!isset($_SESSION['XUID']) || !isset($_SESSION['XUSRNM'])){session_destroy();echo "login.php";exit;}
//if(!in_array(4,$_SESSION['adrole'])){echo "404.php";exit;}
if($_SERVER['REQUEST_METHOD']!='POST' || empty($_POST)){echo "404.php";exit;}
require_once("db/conn.php");

$action=$_POST['action'];
$id=$_POST['id'];
$r=$connection->query("UPDATE wr_mst_teacher SET active='$action',modified_by='".$_SESSION['XUID']."',modified_on='".date('Y-m-d H:i')."' WHERE tid=".$id);
$connection->close();

if($r)echo $action;
else echo "An Unknown error occured. Please try again.";
?>