<?php session_start();
if(!isset($_SESSION['XUID']) || !isset($_SESSION['XUSRNM'])){session_destroy();header("location:login.php");}
require_once("db/conn.php");
include "dompdf/autoload.inc.php";

use Dompdf\Dompdf;
use Dompdf\Options;	

$options = new Options();
$options->set('defaultFont', 'Times New Roman','sans-serif','Arial','Calibri');

//$options->set('defaultFont', 'calibri');
$recq="SELECT * FROM lad_mst_receipt where rec_id=".base64_decode($_GET['id'])."";
$recqr=$connection->query($recq);
$recqrow=$recqr->fetch_assoc();
$recqr->free();

/*$quoq="SELECT * FROM lad_member WHERE mem_id=".$recqrow['mem_id'];
$quor=$connection->query($quoq);
$quorow=$quor->fetch_assoc();
$quor->free();*/

			$scq="SELECT first_name,middle_name,last_name,mem_no,address,state_id,dist_id,tal_id,mem_city,pincode,mobile_no,email,aadharno,panno FROM lad_member where mem_id=".$recqrow['mem_id']."";
		$scr=$connection->query($scq);
		$scrow=$scr->fetch_assoc();
		$scr->free();
		
		/*$sc1q="SELECT tapshil_name FROM lad_mst_tapshil where tapshil_id=".$recqrow['tapshil_id']."";
		$sc1r=$connection->query($sc1q);
		$sc1row=$sc1r->fetch_assoc();
		$sc1r->free();*/
		$name=$scrow['first_name']." ".$scrow['middle_name']." ".$scrow['last_name'];
		$mytype='GENERAL RECEIPT';
		//$mytype='Member ('.$sc1row['tapshil_name'].')';
		$addr=$scrow['address'];
		$state=$scrow['state_id'];
		$dist_id=$scrow['dist_id'];
		$tal_id=$scrow['tal_id'];
		$mem_city=$scrow['mem_city'];
		$pincode=$scrow['pincode'];
		$mobile=$scrow['mobile_no'];
		$email=$scrow['email'];
		$adhar=$scrow['aadharno'];
		$pan=$scrow['panno'];
		$memno=$scrow['mem_no'];
		

$stateq="SELECT state_name FROM lad_mst_state WHERE state_id=".$state."";
$stater=$connection->query($stateq);
$staterow=$stater->fetch_assoc();
$stater->free();


$distq="SELECT dist_name FROM lad_mst_district WHERE dist_id=".$dist_id."";
$distr=$connection->query($distq);
$distrow=$distr->fetch_assoc();
$distr->free();

$myaddress=$addr.", ".$staterow['state_name'].", ".$distrow['dist_name'].", ".$mem_city.", ".$pincode;

function number_to_word($number){
	$no=floor($number);
	$point=round($number-$no,2)*100;
	$hundred=null;
	$digits_1=strlen($no);
	$i=0;
	$str=array();
	$words=array('0'=>'','1'=>'one','2'=>'two','3'=>'three','4'=>'four','5'=>'five','6'=>'six','7'=>'seven','8'=>'eight','9'=>'nine','10'=>'ten','11'=>'eleven','12'=>'twelve','13'=>'thirteen','14'=>'fourteen','15'=>'fifteen','16'=>'sixteen','17'=>'seventeen','18'=>'eighteen','19'=>'nineteen','20'=>'twenty','30'=>'thirty','40'=>'forty','50'=>'fifty','60'=>'sixty','70'=>'seventy','80'=>'eighty','90'=>'ninety');
	$digits=array('','hundred','thousand','lakh');
	while($i<$digits_1){
		$divider=($i==2) ? 10 : 100;
		$number=floor($no%$divider);
		$no=floor($no/$divider);
		$i+=($divider==10) ? 1 : 2;
		if($number){
			$plural=(($counter=count($str)) && $number>9) ? 's' : null;
			$hundred=($counter==1 && $str[0]) ? '' : null;
			$str[]=($number<21) ? $words[$number]." ".$digits[$counter].$plural." ".$hundred : $words[floor($number/10)*10]." ".$words[$number%10]." ".$digits[$counter].$plural." ".$hundred;
		}
		else $str[]=null;
	}
	
	$str=array_reverse($str);
	$result=implode('',$str);
	//if decimal exists, adding it to result
	$result.=($point) ? "and ".$words[$point-($point%10)]." ".$words[$point%10].' Paise' : "";

	return "Rupees ".$result;
}


//print_r($quorow);exit;
	$html='<html>
<style>
@page {
  size: A4;
	margin:5%;
}
@media print {
  html, body {
    width: 210mm;
    height: 297mm;
	font-family: Helvetica Neue,Helvetica,"Arial",sans-serif;
	
  }
}
td
{
	padding-left: 1%;
}
tr.highlight td {
  padding-top: 10px; 
  padding-bottom:10px
}
</style>

<body style="text-align:left;">
	<div style="margin:2%,2%,5%,2% !important">';
	$html.='<table cellspacing="0" cellpadding="0" border="1" width="100%" style="border-collapse:collapse">
	<tr><td colspan="3"><img src="../images/aabhar.jpg" width="100%" style="margin-left: -1%;"></td></tr>
	<tr><td colspan="3">&nbsp;</center></td></tr>
  <tr style="height: 35px;">
<td style="font-size:15px"><strong>Rec No. :</strong> '.$recqrow['rec_id'].'</u></td>
	<td style="font-size:15px"><strong>सभासद क्र. : </strong>'.$memno.'</td>

	<td  style="text-align:right;padding-right: 1%;">
		<p><strong>दिनांक :</strong> '.date("d-m-Y", strtotime($recqrow['rec_date'])).'</p></td>
  </tr>
  <tr style="height: 35px;"> 
    <td colspan="3">
    	<p style="font-size:15px"><strong>श्री./सौ./कु. :</strong> <u>'.$name.'</u></p>
    	
    </td>
  </tr>
 
 <tr style="height: 35px;"> 
    <td colspan="3" style="font-size:15px">
    <p><strong>पत्ता : </strong>'.$myaddress.'</p></td>
   
</tr>

<tr style="height: 35px;"> 
    <td colspan="3" style="font-size:15px">
    <p><strong>फोन :</strong> '.$mobile.' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <strong>ईमेल : </strong>'.$email.'</p></td>
   
</tr>


<tr style="height: 35px;">
			<td colspan="3"><p><strong> यांचेकडून '.$recqrow['tapshil_amount'].' रुपये,';
if($recqrow['paymode']==1){$html.=' रोख';}
else if($recqrow['paymode']==2){$html.=' चेक/ डी. डी. नं.  : '.$recqrow['chqno'].', date : '.date('d-M-Y',strtotime($recqrow['chqdate'])).', Drawn : '.$recqrow['bankname'];}
else if($recqrow['paymode']==3){$html.=' NEFT : '.$recqrow['chqno'].', date : '.date('d-M-Y',strtotime($recqrow['chqdate'])).', Drawn : '.$recqrow['bankname'];} 
$html.='</strong> </p></td>
		</tr>


<tr style="height: 35px;">
	<td style="text-align: left; font-size:15px;"  ><strong>तपशील : </strong>'.$mytype.'</td>
	<td style="text-align: left; font-size:15px;"  ><strong>आधार क्रमांक : </strong>'.$adhar.'</td>
	<td style="text-align: left; font-size:15px;"  ><strong>पॅन नं : </strong>'.$pan.'</td>
</tr>

<tr>
	<td style="text-align: left;padding-right: 1%;"  colspan="3">
	 अक्षरी रुपये <strong>'.number_to_word($recqrow["tapshil_amount"]).'</strong> मात्र मिळाले. आभारी आहोत.
	 <br/><br/><br/><br/><br/>
	<span style="float:left;">रक्कम देणाऱ्याची सही </span> <span style="float:right;">रक्कम घेणाऱ्याची सही</span>
	<br/><br/>
	</td>
</tr>

</table>';
     
 $html.='</div></body>
</html>'; 
echo $html;exit;
$dompdf = new DOMPDF($options);
$dompdf->load_html($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$output = $dompdf->output();

	
	
$dompdf->stream("swami.pdf",array("Attachment"=>1));
