<?php
require_once("db/conn.php");

$email=filter_var(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL), FILTER_VALIDATE_EMAIL);

$loginq="SELECT 	a.staff_id as log_id,
						CONCAT(a.fname,' ',a.lname) AS fname,
						a.mobile_no as mobileno,
						a.desig_name,
						b.active,
						a.email_address,
						b.u_id,
						b.user_name,
						b.user_password
			  FROM		lad_mst_teacher a,lad_mst_users b
			  WHERE 	a.email_address='".$email."'
			  AND		a.staff_id=b.comman_id
			  AND		b.comman_role='ADIM'
			  AND		b.device_type='WB'";
			 
//"SELECT usersrno,username,password,active FROM gr_mst_users WHERE email='".$email."'"
$chkr=$connection->query($loginq);
$count=$chkr->num_rows;
$chkrow=$chkr->fetch_assoc();
$chkr->free();
if($count==1){
	if($chkrow['active']=='y'){
		$newpass=substr(time(),0,8);
		$newpassr=$connection->query("UPDATE lad_mst_users SET user_password='".$newpass."' WHERE u_id=".$chkrow['u_id']);
	
		if($newpassr){//now sending email containing new password
			$email_subject="Password Reset";
			$company_email="support@ultraliant.com";
			$email_body = "Hello!!!\n\nYour password has been successfully reset. New password for your Account is as follows:\n\n------------------------------\nUsername: ".$chkrow['user_name']."\nPassword: ".$newpass."\n------------------------------\n\n-------------------------------------------------------\n<strong>This is an automated message, please do not reply.</strong>";
			$headers = "From: School Admin <$company_email>\n";
			$headers .= "Reply-To: $company_email";
			if(mail($email,$email_subject,$email_body,$headers)){
				header("location:login.php?msg=reset_pass");
				exit;
			}
			else{
				$newpassq=$connection->query("UPDATE lad_mst_users SET user_password='".$chkrow['user_password']."' WHERE u_id=".$chkrow['u_id']);
				$error="reset_failed";
			}
		}
		else $error="reset_failed";
	}
	else $error="user_account_disabled";
}
else $error="invalid_email";
	
$connection->close();
header("location:forgotpass.php?msg=".$error);
exit;
?>