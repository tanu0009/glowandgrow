<?php 
require_once("db/conn.php");
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

 <h3><b>Receipt Report</b></h3>

<br>

<?php 
 $selectplist="SELECT * FROM lad_mst_receipt WHERE rec_date >= '".$fdate."' AND rec_date <='".$todate."' ";
	
	$selectplist.="order by `rec_date` asc";
//	echo $selectplist; 
	$selpacontp=$connection->query($selectplist);	
	$count=$selpacontp->num_rows;
	 ?>
<table cellspacing="0" cellpadding="3" border="1" width="100%" style="border-collapse:collapse" class="font">

    <tr bgcolor="#dddddd" class="font">

		 <td colspan="5" style="border:none !important ; text-align:center;"  class="font" ><p><b/> From : <?php echo date('d-m-y',strtotime($fdate)); ?> </b><b>  To:  <?php  echo date('d-m-y',strtotime($todate)); ?>    </b></td>

	</tr>

    <tr bgcolor="#dddddd" class="font">

        <th class="font" align="left">Sr.no</th>
		<th align="left">Type</th>
		<th align="left">Name</th>
		<th align="left">Date</th>
		<th align="right">Amount</th>
        <!--<th>Balance</th>--> 
</tr>

	<?php

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
		 
		//print_r($scrow); exit;
		/*$recq="SELECT sum(tapshil_amount) as samt FROM lad_mst_receipt where tapshil_id='sch' AND mem_id=".$listrowptp['sub_scheme_id']."";
		$recr=$connection->query($recq);
		$recrow=$recr->fetch_assoc();
		$recr->free();
		$bal=($listrowptp['trn_amt']-$recrow['samt']);*/
		?>
    <tr>
    <td><?php echo $srno;?></td>
   
    <td><?php echo $mytype;?></td>
    <td><?php echo $name;?></td>
    <td><?php echo date("d-m-Y", strtotime($listrowptp['rec_date']));?></td>
    <td  align="right"><?php echo $listrowptp['tapshil_amount'];?></td>
    <!--<td><?php //echo $bal;?></td>-->
    </tr>
    
    
	<?php 	$srno++;	
	}
	
	 

?>



