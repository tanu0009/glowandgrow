<?php session_start();
if(!isset($_SESSION['XUID']) || !isset($_SESSION['XUSRNM'])){session_destroy();header("location:login.php");}
if($_SERVER['REQUEST_METHOD']!='POST' || empty($_POST)){echo "404.php";exit;}
require_once("db/conn.php");
//print_r($_POST);exit;
$inwtype=$_POST['inwtype'];
if($inwtype=='c')$consrno=$_POST['consrno1'];
if($inwtype=='o')$inwfrom=$_POST['inwfrom'];
if(isset($_POST['personname']))$personname=$_POST['personname'];
$staffsrno=$_POST['staffsrno'];
$docname=$_POST['docname'];
$doctype=$_POST['doctype'];
$place_txt=$_POST['place_txt'];
$inwdate=date('Y-m-d',strtotime($_POST['inwdate']));
$returnable=$_POST['returnable'];
$outwardsrno=$_POST['outwardsrno'];
$fname1=$_FILES['docfile']['name'];
if(!empty($fname1)){
	$ftype1=$_FILES['docfile']['type'];
	if($_FILES['docfile']['error']==1){echo "Image upload error.";exit;}
	else{
		if($_FILES['docfile']['size'] < 2*1024*1024){
			//if($ftype1=="image/jpeg" || $ftype1=="image/pjpeg" || $ftype1=="image/gif" || $ftype1=="image/png"){
				$ext=explode('.',basename($fname1));
				$ext=end($ext);
			//}else{echo "Image type error. Only JPG, PNG and GIF allowed.";exit;}
		}else{echo "Image size error. Max size is 2 MB.";exit;}
	}
}else $ext="";

$addq="INSERT INTO lad_trn_inward(con_sr_no,inwfrom,outwardsrno,personname,place_txt,staffsrno,docname,doctype,inwdate,docfile,returnable,active,create_dt,create_by) VALUES(";
if($inwtype=='c')$addq.="'$consrno',NULL,";else $addq.="NULL,'$inwfrom',";
if(!empty($outwardsrno))$addq.="'$outwardsrno',";else $addq.="NULL,";
if(isset($personname))$addq.="'$personname',";else $addq.="NULL,";
if(isset($place_txt))$addq.="'$place_txt',";else $addq.="NULL,";
$addq.="'$staffsrno','$docname','$doctype','$inwdate',";
if(!empty($ext))$addq.="'$ext',";else $addq.="NULL,";
$addq.="'$returnable','y','".date('Y-m-d H:i:s')."','".$_SESSION['XUID']."')";
//echo $addq;exit;
$addr=$connection->query($addq);
$getid=$connection->insert_id;
if($addr){
	@move_uploaded_file($_FILES['docfile']['tmp_name'],"../uploads/inward/".$getid.".".$ext);
	echo "success";
	
}
else echo "An unknown error occured. Please try again.";
$connection->close();
?>