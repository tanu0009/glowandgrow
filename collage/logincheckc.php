<?php
//if($_SERVER['REQUEST_METHOD']!='POST' || empty($_POST)){echo "404.php";exit;}
require_once("db/conn.php");
//print_r($_POST);exit;
echo $username=$connection->real_escape_string($_POST['username']);
echo $password=$connection->real_escape_string(trim($_POST['password']));

if(empty($username) || empty($password)){
	header("location:../index.php?msg=fail1");
	}
else{
	$loginq="SELECT * FROM vp_mst_users WHERE username='".$username."' AND password='".$password."'";
	$loginr=$connection->query($loginq);
	$loginrow=$loginr->fetch_assoc();
	$count=$loginr->num_rows;
	$loginr->free();
	if($count==1){
		if($loginrow['active']=='y'){
			session_start();
			$_SESSION['adid']=$loginrow['usersrno'];
			$_SESSION['aduser']=$loginrow['username'];
			$_SESSION['adname']=$loginrow['name'];
			$_SESSION['adrole']=$loginrow['role'];

			header("location:../index.php?msg=success");
		}
		else {
			header("location:../index.php?msg=exists");

		}
	}
	else{
		header("location:../index.php?msg=fail");
	}
}
$connection->close();
?>