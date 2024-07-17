<?php session_start();

if(!isset($_SESSION['XUID']) || !isset($_SESSION['XUSRNM'])){session_destroy();header("location:login.php");}

//if(!in_array(4,$_SESSION['adrole'])){echo "404.php";exit;}

if($_SERVER['REQUEST_METHOD']!='POST' || empty($_POST)){echo "404.php";exit;}

require_once("db/conn.php");



$addq="INSERT INTO wr_mst_project(project_name,mtype,tid,support_type,duration,otherdata,created_by,created_on) 
VALUES('".$_POST['project_name']."','".$_POST['mtype']."','".$_POST['tid']."','".$_POST['support_type']."','".$_POST['duration']."','".$_POST['otherdata']."','".$_SESSION['XUID']."','".date('Y-m-d H:i')."')";
	//	echo $addq;

	$addr=$connection->query($addq);
	if($addr){
		$uid=$connection->insert_id;
		$addq2="INSERT INTO wr_mst_project_sub(rec_id,tapshil_id,created_by,created_on) VALUES";
	for($i=1;$i<=$_POST['prodcount'];$i++){
		
		if(!empty($_POST['tapshil_id'.$i]))
			$addq2.="('".$uid."','".$_POST['tapshil_id'.$i]."','".$_SESSION['XUID']."','".date('Y-m-d H:i:s')."'),";
	}		
	$addq2=rtrim($addq2,',');
	//echo $addq2; exit;
	$addr2=$connection->query($addq2);
		
		
	echo "success";

	}

	else echo "An unknown error occured. Please try again.";
$connection->close();



?>