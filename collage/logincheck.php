<?php
if($_SERVER['REQUEST_METHOD']!='POST' || empty($_POST)){echo "404.php";exit;}
require_once("db/conn.php");
$username=$connection->real_escape_string($_POST['username']);
$password=$connection->real_escape_string(trim($_POST['password']));
$ltype=$connection->real_escape_string(trim($_POST['ltype']));

if(empty($username) || empty($password) || empty($ltype)){echo "Invalid Username or Password";exit;}
else{
	//$loginq="SELECT * FROM lad_mst_users WHERE username='".$username."' AND password='".$password."'";
	if($ltype=='t'){
	
	$loginq="SELECT 	a.staff_id as log_id,
						CONCAT(a.fname,' ',a.lname) AS fname,
						a.address as addr,
						a.mobile_no as mobileno,
						a.desig_name,
						b.login_token,
						b.active,
						b.notification_key,
						b.user_name
			  FROM		lad_mst_teacher a,lad_mst_users b
			  WHERE 	b.user_name='".$username."'
			  AND		b.user_password='".$password."'
			  AND		a.staff_id=b.comman_id
			  AND		b.comman_role='ADIM'
			  AND		b.device_type='WB'";
	$loginr=$connection->query($loginq);
	}else if($ltype=='s'){
		
		$loginq="SELECT sid as log_id,
						sname as fname,
						username as user_name,
						username as mobileno,
						's' as desig_name
			  FROM		wr_mst_student
			  WHERE 	username='".$username."'
			  AND		userpassword='".$password."'
			  AND		isadmin='y'";
			  $loginr=$connection->query($loginq);
	}
	
	$loginrow=$loginr->fetch_assoc();
	$count=$loginr->num_rows;
	$loginr->free();
	if($count==1){
		/*if($loginrow['active']=='y'){*/
			
			session_start();
			$_SESSION['XUID']=$loginrow['log_id'];
			$_SESSION['XFULLNAME']=$loginrow['fname'];
			$_SESSION['XUSRNM']=$loginrow['user_name'];
			$_SESSION['XMOBILENO']=$loginrow['mobileno'];
			$_SESSION['XDESIG']=$loginrow['desig_name'];
			$_SESSION['XACYEAR']=2;

			echo "success";
		/*}
		else echo "User Account Disabled. Contact <strong>Admin</strong>.";*/
	}
	else echo "Invalid Username or Password";
}
$connection->close();
?>