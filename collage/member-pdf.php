<?php 
require_once("db/conn.php");
if(!empty($_GET['fdate'])){$fdate=date('Y-m-d',strtotime($_GET['fdate']));}else { $fdate="";}
if(!empty($_GET['tdate'])){$todate=date('Y-m-d',strtotime($_GET['tdate']));}else { $todate="";}
$type=$_GET['type'];
?>



 <style>

 .font

 {

   font-size: 12px !important;

 }

 .capital

 {

   text-transform:capitalize;

 }

 </style>

 <h3><b>Member Report</b></h3>

<br>

<?php 
 $selectplist="SELECT * FROM lad_member WHERE mem_type='".$type."' ";
 if(!empty($fdate) && !empty($todate)){
 $selectplist.=" AND mem_create_date >= '".$fdate."' AND mem_create_date <='".$todate."' ";
 }
	
	$selectplist.="order by `mem_no` asc";
	//echo $selectplist; 
	$selpacontp=$connection->query($selectplist);	
	$count=$selpacontp->num_rows;
	 ?>
<table cellspacing="0" cellpadding="3" border="1" width="100%" style="border-collapse:collapse" class="font">
<?php if(!empty($fdate) && !empty($todate)){?>
    <tr bgcolor="#dddddd" class="font">

		 <td colspan="6" style="border:none !important ; text-align:center;"  class="font" ><p><b/> From : <?php echo date('d-m-y',strtotime($fdate)); ?> </b><b>  To:  <?php  echo date('d-m-y',strtotime($todate)); ?>    </b></td>

	</tr>
    <?php }?>

    <tr bgcolor="#dddddd" class="font">

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
</tr>

	<?php

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
		
		?>
    <tr>
    <td><?php echo $srno;?></td>
    <td><?php echo $listrowptp['first_name']." ".$listrowptp['middle_name']." ".$listrowptp['last_name'];?></td>
     <td><?php if(!empty($listrowptp['refby'])){echo $listrowptp['refby'];} else { echo "--";}?></td>
      <td><?php echo $listrowptp['mobile_no'];?></td>
      <td><?php if($listrowptp['gender']=='m'){echo "Male";}else { echo "Female";}?></td>
   
  
    <td><?php if(!empty($listrowptp['blood_group'])){echo $listrowptp['blood_group'];} else { echo "--";}?></td>
     <td><?php echo $sname;?></td>
     <td><?php echo $dname;?></td>
     <td><?php echo $listrowptp['tal_id'];?></td>
     <td><?php echo $listrowptp['mem_city'];?></td>
      <td><?php echo $listrowptp['pincode'];?></td>
    
  
    </tr>
    
    
	<?php 	$srno++;	
	}
	
	 

?>



