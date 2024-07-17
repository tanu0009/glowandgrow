<?php  session_start();
//if(!isset($_SESSION['XUID']) || !isset($_SESSION['XUSRNM'])){session_destroy();header("location:login.php");}
if($_SERVER['REQUEST_METHOD']!='POST' || empty($_POST)){echo "404.php";exit;}
require_once("db/conn.php");
$mob_no=$_POST['mob_no'];
$addr=$_POST['addr'];
$listq="SELECT mem_no,first_name,middle_name,last_name,mobile_no,address FROM lad_member WHERE mem_id='".$_POST['mem_no']."'  
ORDER BY mem_no asc";
//echo $listq;
$listr=$connection->query($listq);
?>
<?php
//$price_cnt=$listr->num_rows;
$listrow=$listr->fetch_assoc();
//if($price_cnt!=0){
	
	//echo $listrow['mobile_no'];
	//echo $listrow['address'];
//}else
$listr->free();
$connection->close();
echo $listrow['first_name'].' '.$listrow['middle_name'].' '.$listrow['last_name']."~".$listrow['mobile_no']."~".$listrow['address']; exit;
?>