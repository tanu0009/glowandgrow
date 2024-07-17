<?php 
require_once("db/conn.php");
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

$file = 'receipt_Excel_Report';

$csv_output .="<h1 style='color:brown; text-align:center !important'>Receipt Report</h1>";

$csv_output .="<br>";


 $selectplist="SELECT * FROM lad_mst_receipt WHERE rec_date >= '".$fdate."' AND rec_date <='".$todate."' ";
	
	$selectplist.="order by `rec_date` asc";
//	echo $selectplist; 
	$selpacontp=$connection->query($selectplist);	
	$count=$selpacontp->num_rows;
	
$csv_output .='<table cellspacing="0" cellpadding="3" border="1" width="100%" style="border-collapse:collapse" class="font">

    <tr bgcolor="#dddddd" class="font">

		 <td colspan="5" style="border:none !important ; text-align:center;"  class="font" ><p><b/> From : '.date('d-m-y',strtotime($fdate)).'</b><b>  To:  '.date('d-m-y',strtotime($todate)).'</b></td>

	</tr>

    <tr bgcolor="#dddddd" class="font">

        <th class="font" align="left">Sr.no</th>
		<th align="left">Type</th>
		<th align="left">Name</th>
		<th align="left">Date</th>
		<th align="right">Amount</th>
  </tr>';

	$srno=1;

	while($listrowptp=$selpacontp->fetch_assoc()) 
	{
		if($listrowptp['tapshil_id']=='sch'){
		$scq="SELECT stud_name FROM lad_mst_scholar where sch_id=".$listrowptp['mem_id']."";
		$scr=$connection->query($scq);
		$scrow=$scr->fetch_assoc();
		$scr->free();
		$name=$scrow['stud_name'];
		$mytype='Scholarship';
		
		}else if($listrowptp['tapshil_id']=='me'){
		$scq="SELECT sub_scheme_name FROM lad_sub_scheme where sub_scheme_id=".$listrowptp['mem_id']."";
		$scr=$connection->query($scq);
		$scrow=$scr->fetch_assoc();
		$scr->free();
		$name=$scrow['sub_scheme_name'];
		$mytype='Medical Equipment';
		}else
		{
			$scq="SELECT first_name,middle_name,last_name FROM lad_member where mem_id=".$listrowptp['mem_id']."";
		$scr=$connection->query($scq);
		$scrow=$scr->fetch_assoc();
		$scr->free();
		
		$sc1q="SELECT tapshil_name FROM lad_mst_tapshil where tapshil_id=".$listrowptp['tapshil_id']."";
		$sc1r=$connection->query($sc1q);
		$sc1row=$sc1r->fetch_assoc();
		$sc1r->free();
		$name=$scrow['first_name']." ".$scrow['middle_name']." ".$scrow['last_name'];
		$mytype='Member ('.$sc1row['tapshil_name'].')';
		}
		 
		
    $csv_output .='<tr>
    <td>'.$srno.'</td>
   
    <td>'.$mytype.'</td>
    <td>'.$name.'</td>
    <td>'.date("d-m-Y", strtotime($listrowptp['rec_date'])).'</td>
    <td  align="right">'.$listrowptp['tapshil_amount'].'</td>
    </tr>';
    $srno++;	
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

