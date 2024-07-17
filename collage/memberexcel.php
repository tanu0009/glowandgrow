<?php 
require_once("db/conn.php");
if(!empty($_GET['fdate'])){$fdate=date('Y-m-d',strtotime($_GET['fdate']));}else { $fdate="";}
if(!empty($_GET['tdate'])){$todate=date('Y-m-d',strtotime($_GET['tdate']));}else { $todate="";}
$type=$_GET['type'];


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

$file = 'member_Excel_Report';

$csv_output .="<h1 style='color:brown; text-align:center !important'>Member Report</h1>";

$csv_output .="<br>";


 $selectplist="SELECT * FROM lad_member WHERE mem_type='".$type."' ";
 if(!empty($fdate) && !empty($todate)){
 $selectplist.=" AND mem_create_date >= '".$fdate."' AND mem_create_date <='".$todate."' ";
 }
	
	$selectplist.="order by `mem_no` asc";
	//echo $selectplist; 
	$selpacontp=$connection->query($selectplist);	
	$count=$selpacontp->num_rows;
	
$csv_output .='<table cellspacing="0" cellpadding="3" border="1" width="100%" style="border-collapse:collapse" class="font">';
 if(!empty($fdate) && !empty($todate)){
    $csv_output .='<tr bgcolor="#dddddd" class="font">

		 <td colspan="6" style="border:none !important ; text-align:center;"  class="font" ><p><b/> From : '.date('d-m-y',strtotime($fdate)).'</b><b>  To:  '.date('d-m-y',strtotime($todate)).'</b></td>

	</tr>';
     }

    $csv_output .='<tr bgcolor="#dddddd" class="font">

        <th class="font" align="left">Sr.no</th>
        <th align="left">Name</th>
        <th align="left">Referred by name</th>
        <th align="left">Mobile no</th>
        <th align="left">Gender</th>
        <th align="left">Blood group</th>
        <th align="left">State</th>
        <th align="left">District</th>
        <th>Taluka</th> 
        <th>Village</th> 
        <th>Pincode</th> 
</tr>';

	

	$srno=1;

	while($listrowptp=$selpacontp->fetch_assoc()) 
	{
	if(!empty($listrowptp['state_id'])){
		$scq="SELECT state_name FROM lad_mst_state where state_id=".$listrowptp['state_id']."";
		$scr=$connection->query($scq);
		$scrow=$scr->fetch_assoc();
		$scr->free();
		$sname=$scrow['state_name'];
	}else
	{
		$sname="--";
	}
		
		
		if(!empty($listrowptp['dist_id'])){
		$distq="SELECT dist_name FROM lad_mst_district where dist_id=".$listrowptp['dist_id']."";
		$distr=$connection->query($distq);
		$distrow=$distr->fetch_assoc();
		$distr->free();
		$dname=$distrow['dist_name'];
		}else
		{
			$dname="--";
		}
		
		
    $csv_output .='<tr>
    <td>'.$srno.'</td>
    <td>'.$listrowptp['first_name']." ".$listrowptp['middle_name']." ".$listrowptp['last_name'].'</td>
     <td>'; if(!empty($listrowptp['refby'])){ $csv_output .=$listrowptp['refby'];} else { $csv_output .="--";}$csv_output .='</td>
      <td>'.$listrowptp['mobile_no'].'</td>
      <td>'; if($listrowptp['gender']=='m'){ $csv_output .="Male";}else { $csv_output .="Female";} $csv_output .='</td>
   
  	<td>'; if(!empty($listrowptp['blood_group'])){ $csv_output .=$listrowptp['blood_group'];} else { $csv_output .="--";} $csv_output .='</td>
     <td>'.$sname.'</td>
     <td>'.$dname.'</td>
     <td>'.$listrowptp['tal_id'].'</td>
     <td>'.$listrowptp['mem_city'].'</td>
      <td>'.$listrowptp['pincode'].'</td>
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

	</html>'

;



?>

<?php

exit;

?>

