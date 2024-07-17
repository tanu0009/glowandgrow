<?php session_start();
if(!isset($_SESSION['XUID']) || !isset($_SESSION['XUSRNM'])){session_destroy();header("location:login.php");}
if($_SERVER['REQUEST_METHOD']!='POST' || empty($_POST)){echo "404.php";exit;}
require_once("db/conn.php");

$uid=$_POST['uid'];
$inwardsrno=$_POST['inwardsrno'];
$staffsrno=$_POST['staffsrno'];
$outtype=$_POST['outtype'];
if($outtype=='c')$consrno=$_POST['consrnol'];
if($outtype=='o')$outto=$_POST['outto'];
if($outtype=='t')$mem_trn_id=$_POST['mem_trn_id'];
$docname=$_POST['docname'];
$doctype=$_POST['doctype'];
$outdate=date('Y-m-d',strtotime($_POST['outdate']));
$returnable=$_POST['returnable'];
$fname1=$_FILES['docfile']['name'];
if(!empty($fname1)){
	$ftype1=$_FILES['docfile']['type'];
	if($_FILES['docfile']['error']==1){echo "Image upload error.";exit;}
	else{
		if($_FILES['docfile']['size'] < 2*1024*1024){
			//if($ftype1=="image/jpeg" || $ftype1=="image/pjpeg" || $ftype1=="image/gif" || $ftype1=="image/png"){
				$ext=explode('.',basename($fname1));
				$ext=end($ext);
				$file_name=date('YmdHis').".".$ext;
				if($file_name!=$_POST['olddocfile'])@unlink("../uploads/outward/".$_POST['olddocfile']);
			//}else{echo "Image type error. Only JPG, PNG and GIF allowed.";exit;}
		}else{echo "Image size error. Max size is 2 MB.";exit;}
	}
}else $ext=$_POST['olddocfile'];

$updateq="UPDATE lad_trn_outward SET staffsrno='$staffsrno',";
if(!empty($inwardsrno))$updateq.="inwardsrno='$inwardsrno',";else $updateq.="inwardsrno=NULL,";
if(isset($inwardsrno))
$updateq.="con_sr_no=NULL,outto=NULL,mem_trn_id=NULL,";else 
if($outtype=='c')$updateq.="con_sr_no='$consrno',outto=NULL,mem_trn_id=NULL,";
if($outtype=='t')$updateq.="con_sr_no=NULL,outto=NULL,mem_trn_id='$mem_trn_id',"; 
if($outtype=='o')$updateq.="con_sr_no=NULL,outto='$outto',mem_trn_id=NULL,";
$updateq.="returnable='$returnable',docname='$docname',doctype='$doctype',outdate='$outdate',docfile='$file_name',update_dt='".date("Y-m-d H:i:s")."',update_by='".$_SESSION['XUID']."' WHERE outwardsrno='".$uid."'";
//echo $updateq;
$updater=$connection->query($updateq);
if($updater){
	if(!empty($fname1))@move_uploaded_file($_FILES['docfile']['tmp_name'],"../uploads/outward/".$file_name);
	echo "success";
}
else echo "An unknown error occured. Please try again.";
$connection->close();
?>