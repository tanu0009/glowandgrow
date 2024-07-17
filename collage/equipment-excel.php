<?php 
require_once("db/conn.php");
$report_type=$_GET['report_type'];
$user_id=$_GET['user_id'];
$fdate=date('Y-m-d',strtotime($_GET['fdate']));
$todate=date('Y-m-d',strtotime($_GET['tdate']));


$csv_output .='

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7">

<title>SANMITRA</title>

</head>

<style type="text/css">

	<html>

	<body>



 <style>

 .font

 {

   font-size: 12px !important;

 }

 .capital

 {

   text-transform:capitalize;

 }

 </style>';

$file = 'Equipment_Excel_Report';

$csv_output .="<h1 style='color:brown; text-align:center !important'>Equipment Report</h1>";

$csv_output .="<br>";


 if($report_type=='SU')
{
	$selectplist="SELECT * FROM lad_trn_member WHERE schem_id='1' AND trn_date >= '".$fdate."' AND trn_date <='".$todate."' ";
	if($user_id!='ALL'){
		$selectplist.="AND sub_scheme_id =".$user_id." ";
	}
	
	$selectplist.="order by `trn_date` asc";
	
	$selpacontp=$connection->query($selectplist);	
	$count=$selpacontp->num_rows;
	
$csv_output .='<table cellspacing="0" cellpadding="3" border="1" width="100%" style="border-collapse:collapse" class="font">

    <tr bgcolor="#dddddd" class="font">

		 <td colspan="5" style="border:none !important ; text-align:center;"  class="font" ><p><b/> From : '.date('d-m-y',strtotime($fdate)).'</b><b>  To:  '.date('d-m-y',strtotime($todate)).'</b></td>

	</tr>

    <tr bgcolor="#dddddd" class="font">

        <th class="font" align="left" >Sr.no</th>

		<th align="left">Name</th>

        <th align="left">Date</th>

        <th align="right">Amount</th> 

		<th align="right">Balance</th>
	</tr>';

	

	$srno=1;

	while($listrowptp=$selpacontp->fetch_assoc()) 
	{
		$scq="SELECT sub_scheme_name FROM lad_sub_scheme where sub_scheme_id=".$listrowptp['sub_scheme_id']."";
		$scr=$connection->query($scq);
		$scrow=$scr->fetch_assoc();
		$scr->free();
		
		$recq="SELECT sum(tapshil_amount) as samt FROM lad_mst_receipt where tapshil_id='me' AND mem_id=".$listrowptp['sub_scheme_id']."";
		$recr=$connection->query($recq);
		$recrow=$recr->fetch_assoc();
		$recr->free();
		$bal=($listrowptp['trn_amt']-$recrow['samt']);
		
    $csv_output .='<tr>
    <td>'.$srno.'</td>
    <td>'.$scrow['sub_scheme_name'].'</td>
    <td>'.date("d-m-Y", strtotime($listrowptp['trn_date'])).'</td>
    <td align="right">'.$listrowptp['trn_amt'].'</td>
    <td align="right">'.$bal.'</td>
    </tr>';
    $srno++;	
	}
	 }else
	 {
		 $selectplist="SELECT * FROM lad_mst_receipt WHERE tapshil_id='me' AND mem_id=".$user_id." AND rec_date >= '".$fdate."' AND rec_date <='".$todate."' ";
	
	$selectplist.="order by `rec_date` asc";
//	echo $selectplist; 
	$selpacontp=$connection->query($selectplist);	
	$count=$selpacontp->num_rows;
	 
$csv_output .='<table cellspacing="0" cellpadding="3" border="1" width="100%" style="border-collapse:collapse" class="font">

    <tr bgcolor="#dddddd" class="font">

		 <td colspan="4" style="border:none !important ; text-align:center;"  class="font" ><p><b/> From : '.date('d-m-Y',strtotime($fdate)).'</b><b>  To: '.date('d-m-Y',strtotime($todate)).'</b></td>

	</tr>

    <tr bgcolor="#dddddd" class="font">

        <th class="font" align="left">Sr.no</th>

		<th align="left">Name</th>

        <th align="left">Date</th>

        <th align="right">Amount</th>
        <!--<th>Balance</th>--> 
</tr>';

	

	$srno=1;

	while($listrowptp=$selpacontp->fetch_assoc()) 
	{
		
		$scq="SELECT sub_scheme_name FROM lad_sub_scheme where sub_scheme_id=".$listrowptp['mem_id']."";
		$scr=$connection->query($scq);
		$scrow=$scr->fetch_assoc();
		$scr->free();
		
    $csv_output .='<tr>
    <td>'.$srno.'</td>
    <td>'.$scrow['sub_scheme_name'].'</td>
    <td>'.date("d-m-Y", strtotime($listrowptp['rec_date'])).'</td>
    <td  align="right">'.$listrowptp['tapshil_amount'].'</td>
    </tr>';
    $srno++;	
	}
	 }

$connection->close();



$filename = $file."_".date("Y-m-d_H-i",time());

header("Content-type: application/x-msdownload");

header("Content-Disposition: attachment; filename=".$filename.".xls");

header("Pragma: no-cache");

header("Expires: 0");

echo $csv_output.='</body>

	</html>';
exit;

?>

