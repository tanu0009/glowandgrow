<?php session_start();
if(!isset($_SESSION['XUID']) || !isset($_SESSION['XUSRNM'])){session_destroy();header("location:login.php");}
//if(!in_array(1,$_SESSION['adrole'])){echo "404.php";exit;}
if($_SERVER['REQUEST_METHOD']!='POST' || empty($_POST)){echo "404.php";exit;}
require_once("db/conn.php");
$staff_id=$_POST['staff_id'];
$user_fname=$_POST['user_fname'];
$user_mname=$_POST['user_mname'];
$user_lname=$_POST['user_lname'];

$address=$_POST['address'];
$state_id=$_POST['state_id'];
$dist_id=$_POST['dist_id'];
//$city_name=$_POST['area_id'];
$pin_code=$_POST['pin_code1'];

$p_mobile=$_POST['p_mobile'];
//$user_password=$_POST['user_password'];
$p_email=$_POST['p_email'];

$date_of_birth=$_POST['date_of_birth'];
$gender=$_POST['gender'];
$oldprodimg=$_POST['oldprodimg'];

//Image upload
	$fname1=$_FILES['imgname']['name'];
	if(!empty($fname1)){
		$ftype1=$_FILES['imgname']['type'];	
		if($_FILES['imgname']['error']==1){echo "Image upload error.";exit;}
		else{
			if($_FILES['imgname']['size'] < 1*1024*1024){
				if($ftype1=="image/jpeg" || $ftype1=="image/pjpeg" || $ftype1=="image/gif" || $ftype1=="image/png"){
					$ext=explode('.',basename($fname1));
					$ext=end($ext);
					if($ext!=$oldprodimg)@unlink("../uploads/user/".$staff_id.".".$ext);
				}else{echo "Image type error. Only JPG, PNG and GIF allowed.";exit;}
			}else{echo "Image size error. Max size is 1 MB.";exit;}
		}
	}
	else $ext=$oldprodimg;


$selr1=$connection->query("SELECT * FROM lad_mst_teacher WHERE mobile_no='".$p_mobile."' and staff_id!='".$staff_id."' ");

if($selr1->num_rows==0)
{
 $updateq="	UPDATE 	lad_mst_teacher 
 			SET 	fname='".$user_fname."',
					mname='".$user_mname."',
					lname='".$user_lname."',
					desig_name='".$_POST['cust_type']."',
					address='".$address."',
					pin_code='".$pin_code."',
					state_id='".$state_id."',
					dist_id='".$dist_id."',
					mobile_no='".$p_mobile."',
					email_address='".$p_email."',";
					
					if(!empty($gender)){$updateq.=" gender='".$gender."',";} else{ $updateq.= " gender=NULL".",";}
					if(!empty($ext)){$updateq.=" t_photo='".$ext."',";} else{ $updateq.= " t_photo=NULL".",";}
					if(!empty($date_of_birth)){$updateq.=" date_of_birth='".date('Y-m-d',strtotime($date_of_birth))."',";} else{ $updateq.= " date_of_birth=NULL".",";}
                    $updateq.="modified_by='".$_SESSION['XUID']."',modified_on='".date('Y-m-d H:i')."' WHERE staff_id=".$staff_id;
 
 echo  $updateq;
 
$updater=$connection->query($updateq);
if($updater){
	if(!empty($fname1))@move_uploaded_file($_FILES['imgname']['tmp_name'], "../uploads/user/".$staff_id.".".$ext);
       
	 $userup="UPDATE lad_mst_users set user_name='".$p_mobile."',user_password='".$p_mobile."'";
	/* if(!empty($user_password)){$userup.=" user_password='".$user_password."',";}*/
	 
	 $userup.=" comman_role='USER' where comman_role='USER' AND comman_id=".$staff_id;
if($updaterpass=$connection->query($userup)){
	echo "success";
}else{
 echo "An unknown error occured. Please try again.";
}
}
else echo "An unknown error occured. Please try again.";
}else {
    echo " Already Exists";
}
$connection->close();

?>