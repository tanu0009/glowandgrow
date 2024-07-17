<?php session_start();
if(!isset($_SESSION['XUID']) || !isset($_SESSION['XUSRNM'])){session_destroy();header("location:login.php");}
require_once("db/conn.php");

$listq="SELECT * FROM lad_trn_outward WHERE outwardsrno=".$_POST['outwardsrno'];
$listr=$connection->query($listq);
$listrow=$listr->fetch_assoc();
$listr->free();
if(!is_null($listrow['personname']))echo "o{#}".$listrow['personname'];else echo "s{#}";

echo $listrow['docname']."{#}".$listrow['doctype']."{#}".$listrow['outdate'];
$connection->close();
?>