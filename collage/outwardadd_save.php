<?php session_start();
if(!isset($_SESSION['XUID']) || !isset($_SESSION['XUSRNM'])){session_destroy();header("location:login.php");}
if($_SERVER['REQUEST_METHOD']!='POST' || empty($_POST)){echo "404.php";exit;}
require_once("db/conn.php");
//print_r($_POST); exit;

$inwardsrno=$_POST['inwardsrno'];
$staffsrno=$_POST['staffsrno'];
$outtype=$_POST['outtype'];
$mem_trn_id=$_POST['mem_trn_id'];
if($outtype=='c')$consrno=$_POST['consrno1'];
if($outtype=='o')$outto=$_POST['outto'];
if(isset($_POST['personname']))$personname=$_POST['personname'];
$docname=$_POST['docname'];
$doctype=$_POST['doctype'];
$place_txt=$_POST['place_txt'];
$outdate=date('Y-m-d',strtotime($_POST['outdate']));
$returnable=$_POST['returnable'];
$fname1=$_FILES['docfile']['name'];
if(!empty($fname1)){
	$ftype1=$_FILES['docfile']['type'];
	if($_FILES['docfile']['error']==1){echo "Image upload error.";exit;}
	else{
		if($_FILES['docfile']['size'] < 2*1024*1024){
			
				$ext=explode('.',basename($fname1));
				$ext=end($ext);
				$file_name=date('YmdHis').".".$ext;
			
		}else{echo "Image size error. Max size is 2 MB.";exit;}
	}
}else $ext="";

$addq="INSERT INTO lad_trn_outward(inwardsrno,staffsrno,con_sr_no,outto,mem_trn_id,personname,place_txt,docname,doctype,outdate,docfile,returnable,active,create_dt,create_by) VALUES(";
if(!empty($inwardsrno)){$addq.="'$inwardsrno',";}else{ $addq.="NULL,";}
$addq.="'$staffsrno',";
if(!empty($inwardsrno))$addq.="NULL,NULL,NULL,";
if($outtype=='c')$addq.="'".$_POST['consrno1']."',NULL,NULL,";
if($outtype=='o')$addq.="NULL,'$outto',NULL,";
if($outtype=='t')$addq.="NULL,NULL,'$mem_trn_id',";

if(isset($personname))$addq.="'$personname',";else $addq.="NULL,";
if(isset($place_txt))$addq.="'$place_txt',";else $addq.="NULL,";
$addq.="'$docname','$doctype','$outdate',";
if(!empty($ext))$addq.="'$file_name',";else $addq.="NULL,";
 $addq.="'".$returnable."','".y."','".date('Y-m-d H:i:s')."','".$_SESSION['XUID']."')";
//echo $addq;exit;
$addr=$connection->query($addq);
$getid=$connection->insert_id;
if($addr){
	@move_uploaded_file($_FILES['docfile']['tmp_name'],"../uploads/outward/".$file_name);
	
	echo "success";
}
else echo "An unknown error occured. Please try again.";
$connection->close();
?>