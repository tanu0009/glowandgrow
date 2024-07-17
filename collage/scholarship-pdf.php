<?php 
require_once("db/conn.php");
$report_type=$_GET['report_type'];
$user_id=$_GET['user_id'];
$fdate=date('Y-m-d',strtotime($_GET['fdate']));
$todate=date('Y-m-d',strtotime($_GET['tdate']));

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

 <h3><b>Scholarship Report</b></h3>

<br>

<?php 
if($report_type=='SU')
{
	$selectplist="SELECT * FROM lad_trn_member WHERE schem_id='sch' AND trn_date >= '".$fdate."' AND trn_date <='".$todate."' ";
	if($user_id!='ALL'){
		$selectplist.="AND sub_scheme_id =".$user_id." ";
	}
	
	$selectplist.="order by `trn_date` asc";
	
	$selpacontp=$connection->query($selectplist);	
	$count=$selpacontp->num_rows;
	?>
<table cellspacing="0" cellpadding="3" border="1" width="100%" style="border-collapse:collapse" class="font">

    <tr bgcolor="#dddddd" class="font">

		 <td colspan="5" style="border:none !important ; text-align:center;"  class="font" ><p><b/> From : <?php echo date('d-m-y',strtotime($fdate)); ?> </b><b>  To:  <?php  echo date('d-m-y',strtotime($todate)); ?>    </b></td>

	</tr>

    <tr bgcolor="#dddddd" class="font">

        <th class="font" align="left" >Sr.no</th>

		<th align="left">Name</th>

        <th align="left">Date</th>

        <th align="right">Amount</th> 

		<th align="right">Balance</th>
	</tr>

	<?php

	$srno=1;

	while($listrowptp=$selpacontp->fetch_assoc()) 
	{
		$scq="SELECT stud_name FROM lad_mst_scholar where sch_id=".$listrowptp['sub_scheme_id']."";
		$scr=$connection->query($scq);
		$scrow=$scr->fetch_assoc();
		$scr->free();
		
		$recq="SELECT sum(tapshil_amount) as samt FROM lad_mst_receipt where tapshil_id='sch' AND mem_id=".$listrowptp['sub_scheme_id']."";
		$recr=$connection->query($recq);
		$recrow=$recr->fetch_assoc();
		$recr->free();
		$bal=($listrowptp['trn_amt']-$recrow['samt']);
		?>
    <tr>
    <td><?php echo $srno;?></td>
    <td><?php echo $scrow['stud_name'];?></td>
    <td><?php echo date("d-m-Y", strtotime($listrowptp['trn_date']));?></td>
    <td align="right"><?php echo $listrowptp['trn_amt'];?></td>
    <td align="right"><?php echo $bal;?></td>
    </tr>
    
    
	<?php 	$srno++;	
	}
	 }else
	 {
		 $selectplist="SELECT * FROM lad_mst_receipt WHERE tapshil_id='sch' AND mem_id=".$user_id." AND rec_date >= '".$fdate."' AND rec_date <='".$todate."' ";
	
	$selectplist.="order by `rec_date` asc";
	//echo $selectplist; exit;
	$selpacontp=$connection->query($selectplist);	
	$count=$selpacontp->num_rows;
	 /*if($count >0)

	 {
*/?>
<table cellspacing="0" cellpadding="3" border="1" width="100%" style="border-collapse:collapse" class="font">

    <tr bgcolor="#dddddd" class="font">

		 <td colspan="4" style="border:none !important ; text-align:center;"  class="font" ><p><b/> From : <?php echo date('d-m-y',strtotime($fdate)); ?> </b><b>  To:  <?php  echo date('d-m-y',strtotime($todate)); ?>    </b></td>

	</tr>

    <tr bgcolor="#dddddd" class="font">

        <th class="font" align="left">Sr.no</th>

		<th align="left">Name</th>

        <th align="left">Date</th>

        <th align="right">Amount</th>
        <!--<th>Balance</th>--> 
</tr>

	<?php

	$srno=1;

	while($listrowptp=$selpacontp->fetch_assoc()) 
	{
		$scq="SELECT stud_name FROM lad_mst_scholar where sch_id=".$listrowptp['mem_id']."";
		$scr=$connection->query($scq);
		$scrow=$scr->fetch_assoc();
		$scr->free();
		
		/*$recq="SELECT sum(tapshil_amount) as samt FROM lad_mst_receipt where tapshil_id='sch' AND mem_id=".$listrowptp['sub_scheme_id']."";
		$recr=$connection->query($recq);
		$recrow=$recr->fetch_assoc();
		$recr->free();
		$bal=($listrowptp['trn_amt']-$recrow['samt']);*/
		?>
    <tr>
    <td><?php echo $srno;?></td>
    <td><?php echo $scrow['stud_name'];?></td>
    <td><?php echo date("d-m-Y", strtotime($listrowptp['rec_date']));?></td>
    <td  align="right"><?php echo $listrowptp['tapshil_amount'];?></td>
    <!--<td><?php //echo $bal;?></td>-->
    </tr>
    
    
	<?php 	$srno++;	
	}
	 }
	 

?>



