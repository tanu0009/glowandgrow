<?php session_start();
if(!isset($_SESSION['XUID']) || !isset($_SESSION['XUSRNM'])){session_destroy();header("location:login.php");}
if($_SERVER['REQUEST_METHOD']!='POST' || empty($_POST)){echo "404.php";exit;}
require_once("db/conn.php");
//print_r($_POST);
$uid=$_POST['uid'];
$inwtype=$_POST['inwtype'];
if($inwtype=='c')$consrno=$_POST['consrnol'];
if($inwtype=='o')$inwfrom=$_POST['inwfrom'];
if(isset($_POST['personname']))$personname=$_POST['personname'];
$staffsrno=$_POST['staffsrno'];
$docname=$_POST['docname'];
$doctype=$_POST['doctype'];
$returnable=$_POST['returnable'];
$inwdate=date('Y-m-d',strtotime($_POST['inwdate']));
$place_txt=$_POST['place_txt'];
$chk_dt=$_POST['chk_dt'];

$fname1=$_FILES['docfile']['name'];
if(!empty($fname1)){
	$ftype1=$_FILES['docfile']['type'];
	if($_FILES['docfile']['error']==1){echo "Image upload error.";exit;}
	else{
		if($_FILES['docfile']['size'] < 2*1024*1024){
			//if($ftype1=="image/jpeg" || $ftype1=="image/pjpeg" || $ftype1=="image/gif" || $ftype1=="image/png"){
				$ext=explode('.',basename($fname1));
				$ext=end($ext);
				if($ext!=$_POST['olddocfile'])@unlink("../uploads/inward/".$uid.$_POST['olddocfile']);
			//}else{echo "Image type error. Only JPG, PNG and GIF allowed.";exit;}
		}else{echo "Image size error. Max size is 2 MB.";exit;}
	}
}else $ext=$_POST['olddocfile'];

$updateq="UPDATE lad_trn_inward SET ";
if($inwtype=='c')$updateq.="con_sr_no='$consrno',inwfrom=NULL,";else $updateq.="con_sr_no=NULL,inwfrom='$inwfrom',";
if(isset($personname))$updateq.="personname='$personname',";else $updateq.="personname=NULL,";
if(!empty($place_txt))$updateq.="place_txt='$place_txt',";else $updateq.="place_txt=NULL,";
if(!empty($chk_dt))$updateq.="chk_dt='$chk_dt',";else $updateq.="chk_dt=NULL,";
$updateq.="staffsrno='$staffsrno',returnable='$returnable',docname='$docname',doctype='$doctype',inwdate='$inwdate',docfile='$ext',update_dt='".date("Y-m-d H:i:s")."',update_by='".$_SESSION['XUID']."' WHERE inwardsrno=".$uid;
//echo "$updateq";
$updater=$connection->query($updateq);
if($updater){
	if(!empty($fname1))@move_uploaded_file($_FILES['docfile']['tmp_name'],"../uploads/inward/".$uid.".".$ext);
	echo "success";
}
else echo "An unknown error occured. Please try again.";
$connection->close();
?>