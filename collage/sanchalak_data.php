<?php session_start();
require_once("db/conn.php");
//file used in contactadd.php, contactedit.php, contactcertificate.php
$response=array();
$listq="SELECT * FROM lad_mst_gallery WHERE active='y'  AND (gal_id like '".$_GET['gal_id']."%')";
//echo $listq;
$listr=$connection->query($listq);
$i=0;
while($listrow=$listr->fetch_assoc()){
	$response[$i] = array(
			"id" => $listrow['gal_id'],
			
			"value" => $listrow['gal_caption']
		);
	$i++;
}$listr->free();

echo json_encode($response);

$connection->close();
?>