<?php
session_start();
if(!isset($_SESSION['XUID']) || !isset($_SESSION['XUSRNM'])){session_destroy();header("location:login.php");}
//if(!in_array(1,$_SESSION['adrole'])){echo "404.php";exit;}
if($_SERVER['REQUEST_METHOD']!='POST' || empty($_POST)){echo "404.php";exit;}
require_once("db/conn.php");

$usr_fname=$_POST['usr_fname'];
$usr_mname=$_POST['usr_mname'];
$usr_lname=$_POST['usr_lname'];
$address=$_POST['address'];
$state_id=$_POST['state_id'];
$dist_id=$_POST['dist_id'];
/*$area_id=$_POST['area_id'];*/
$p_mobile=$_POST['p_mobile'];
$p_email=$_POST['p_email'];
$pincode=$_POST['pin_code1'];
/*$stud_reg_date=date('Y-m-d',strtotime($_POST['stud_reg_date']));*/
$gender=$_POST['gender'];

//Image upload
	$fname1=$_FILES['imgname']['name'];
	$file_name1="";
	if(!empty($fname1)){
		$ftype1=$_FILES['imgname']['type'];
		if($_FILES['imgname']['error']==1){echo "Image upload error.";exit;}
		else{
			if($_FILES['imgname']['size'] < 1*1024*1024){
				if($ftype1=="image/jpeg" || $ftype1=="image/pjpeg" || $ftype1=="image/gif" || $ftype1=="image/png"){
					$ext=explode('.',basename($fname1));
					$ext=end($ext);
					//$file_name1=substr(str_replace(' ','',$prodname),0,11).date('YmdHis').".".$ext;
				}else{echo "Image type error. Only JPG, PNG and GIF allowed.";exit;}
			}else{echo "Image size error. Max size is 1 MB.";exit;}
		}
	}else
	{
		$ext="";
	}


	
 $selr1=$connection->query("SELECT * FROM lad_mst_teacher WHERE mobile_no='".$p_mobile."'");

if($selr1->num_rows==0)
{
       $addq="INSERT INTO 	lad_mst_teacher
						   (
						    desig_name,
						    fname,
							mname,
							lname,
						   	address,
							pin_code,
							state_id,
							dist_id,
							mobile_no,
							gender,
							email_address,
							t_photo,
							date_of_birth,
							created_by,
							created_on)
				VALUES
							(
							'USER',
							'".$usr_fname."',
							'".$usr_mname."',
							'".$usr_lname."',
							'".$address."',
							'".$pincode."',
							'".$state_id."',
							'".$dist_id."',
							'".$p_mobile."',";
							if(!empty($gender)){$addq.="'".$gender."',";} else{ $addq.= "NULL".",";}
							if(!empty($p_email)){$addq.="'".$p_email."',";} else{ $addq.= "NULL".",";}
							if(!empty($ext)){$addq.="'".$ext."',";} else{ $addq.= "NULL".",";}
							if(!empty($_POST['date_of_birth'])){$addq.="'".date('Y-m-d',strtotime($_POST['date_of_birth']))."',";} else{ $addq.= "NULL".",";}
							$addq.="'".$_SESSION['XUID']."',
							'".date('Y-m-d H:i:s')."')";
	//echo $addq;exit;
$addr=$connection->query($addq);
if($addr){
	@move_uploaded_file($_FILES['imgname']['tmp_name'], "../uploads/user/".$connection->insert_id.".".$ext);
	$asd=$connection->insert_id;
	/*$sa='RACH'.$asd;
	$updateq="update quo_mst_customer SET stud_reg_id='".$sa."' where stud_id=".$connection->insert_id."";
$updater=$connection->query($updateq);*/
	
	$addusrq="INSERT INTO lad_mst_users(user_name,user_password,comman_id,comman_role,device_type,created_by,created_on) VALUES('".$p_mobile."','".$p_mobile."','".$asd."','USER','WB','".$_SESSION['XUID']."','".date('Y-m-d H:i:s')."')";
	 //echo $addusrq; exit; 
$addusr=$connection->query($addusrq);
	//$pqr=$connection->insert_id;
	
//	$addpassq="INSERT INTO sch_mst_class_student(class_id,stud_id,finyear_id ,created_by,created_on) VALUES(".$class_id.",'".$pqr."','".$_SESSION['XACYEAR']."','".$_SESSION['XQUOID']."','".date('Y-m-d H:i:s')."')";
	  
//$addpassr=$connection->query($addpassq);
if($addusr){	

	echo "success";exit;
}else echo "An unknown error occured. Please try again.";

}
else echo "An unknown error occured. Please try again.";
$connection->close();
}else {
    echo " Already Exists";
}
?>
			