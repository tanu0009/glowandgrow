<?php session_start();

if(!isset($_SESSION['XUID']) || !isset($_SESSION['XUSRNM'])){session_destroy();header("location:login.php");}

//if(!in_array(4,$_SESSION['adrole'])){echo "404.php";exit;}

if($_SERVER['REQUEST_METHOD']!='POST' || empty($_POST)){echo "404.php";exit;}

require_once("db/conn.php");
if(!empty($_POST['proposer'])){
if(!empty($_POST['mem_trn_id'])){
	$mem_trn_id=$_POST['mem_trn_id'];
}else
{
	$mem_trn_id="";
}

if(isset($_POST['subschem_id'])){
	$subschemid=$_POST['subschem_id'];
}else
{
	$subschemid="";
}

if(isset($_POST['chqno'])){$chqno=$_POST['chqno'];}else{$chqno='';}if(isset($_POST['bankname'])){$bankname=$_POST['bankname'];}else{$bankname='';}

$addq="INSERT INTO lad_mst_receipt(tapshil_id,mem_id,paymode,rec_date,bid,tapshil_amount,chqno,bankname,chqdate,mem_trn_id,subschem_id,recflag,created_by,created_on) VALUES('gr','".$_POST['proposer']."','".$_POST['paymode']."','".$_POST['rec_date']."','".$_POST['bid']."','".$_POST['total_amount']."',"; 
		if(!empty($chqno)){$addq.="'".$chqno."',";} else{ $addq.= "NULL".",";}
		if(!empty($bankname)){$addq.="'".$bankname."',";} else{ $addq.= "NULL".",";}
		if(!empty($_POST['chqdate'])){$addq.="'".date('Y-m-d',strtotime($_POST['chqdate']))."',";} else{ $addq.= "NULL".",";}
		if(!empty($mem_trn_id)){$addq.="'".$mem_trn_id."',";} else{ $addq.= "NULL".",";}
		if(!empty($subschemid)){$addq.="'".$subschemid."',";} else{ $addq.= "NULL".",";}
		$addq.="'y','".$_SESSION['XUID']."','".date('Y-m-d H:i')."')";
		//print_r($addq);
		//echo $addq;

	$addr=$connection->query($addq);
	if($addr){
		$uid=$connection->insert_id;
		$addq2="INSERT INTO lad_mst_receipt_sub(rec_id,tapshil_id,tapshil_amount,created_by,created_on) VALUES";
	for($i=1;$i<=$_POST['prodcount'];$i++){
		
		if(!empty($_POST['tapshil_amount'.$i]))
			$addq2.="('$uid','".$_POST['tapshil_id'.$i]."','".$_POST['tapshil_amount'.$i]."','".$_SESSION['XUID']."','".date('Y-m-d H:i:s')."'),";
	}		
	$addq2=rtrim($addq2,',');
	$addr2=$connection->query($addq2);
		
		
	echo "success";

	}

	else echo "An unknown error occured. Please try again.";
}else
echo "Please select member.";
$connection->close();



?>