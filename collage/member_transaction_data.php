<?php session_start();
require_once("db/conn.php");

//file used in contactadd.php, contactedit.php, contactcertificate.php

$response=array();

$listq="SELECT * FROM lad_member WHERE active='y' AND commid=1 AND mem_status!='Dead' AND (first_name like '".$_GET['term']."%' OR last_name like '".$_GET['term']."%' OR mem_no like '".$_GET['term']."%')";
$listr=$connection->query($listq);
$i=0;
while($listrow=$listr->fetch_assoc()){
	$response[$i] = array(
			"id" => $listrow['mem_id'],
			"memshiptype" => $listrow['mem_status'],
			"value" => $listrow['first_name']." ".$listrow['last_name']." (".$listrow['mem_no'].")"
		);
	$i++;
}$listr->free();

echo json_encode($response);

$connection->close();
?>