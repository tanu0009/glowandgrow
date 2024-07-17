<?php session_start();
if(!isset($_SESSION['XUID']) || !isset($_SESSION['XUSRNM'])){session_destroy();header("location:login.php");}
require_once("db/conn.php");
include "dompdf/autoload.inc.php";

use Dompdf\Dompdf;
use Dompdf\Options;	

$options = new Options();
$options->set('defaultFont', 'Times New Roman','sans-serif','Arial','Calibri');

//$options->set('defaultFont', 'calibri');
$scq="SELECT * FROM lad_mst_scholar where sch_id=".base64_decode($_GET['id'])."";
$scr=$connection->query($scq);
$scrow=$scr->fetch_assoc();
$scr->free();

$memq="SELECT first_name,middle_name,last_name,address,state_id,dist_id,tal_id,mem_city,mobile_no,mem_no FROM lad_member WHERE mem_id=".$scrow['parid'];
$memr=$connection->query($memq);
$memrow=$memr->fetch_assoc();
$memr->free();

$jam1q="SELECT first_name,middle_name,last_name,mem_no FROM lad_member WHERE mem_id=".$scrow['resp_person_1'];
$jam1r=$connection->query($jam1q);
$jam1row=$jam1r->fetch_assoc();
$jam1r->free();

$res1=$jam1row['first_name']." ".$jam1row['middle_name']." ".$jam1row['last_name'];
$resmid1=$jam1row['mem_no'];
$jam2q="SELECT first_name,middle_name,last_name,mem_no FROM lad_member WHERE mem_id=".$scrow['resp_person_2'];
$jam2r=$connection->query($jam2q);
$jam2row=$jam2r->fetch_assoc();
$jam2r->free();

$res2=$jam2row['first_name']." ".$jam2row['middle_name']." ".$jam2row['last_name'];
$resmid2=$jam2row['mem_no'];

$stateq="SELECT state_name FROM lad_mst_state WHERE state_id=".$memrow['state_id']."";
$stater=$connection->query($stateq);
$staterow=$stater->fetch_assoc();
$stater->free();


$distq="SELECT dist_name FROM lad_mst_district WHERE dist_id=".$memrow['dist_id']."";
$distr=$connection->query($distq);
$distrow=$distr->fetch_assoc();
$distr->free();

$sanq="SELECT gal_caption FROM lad_mst_gallery WHERE gal_id=".$scrow['sanchalak_id']."";
$sanr=$connection->query($sanq);
$sanrow=$sanr->fetch_assoc();
$sanr->free();

/*$talq="SELECT taluka_name FROM lad_mst_taluka WHERE tal_id=".$memrow['tal_id']."";
$talr=$connection->query($talq);
$talrow=$talr->fetch_assoc();
$talr->free();
print_r($talrow); exit;*/
$address=$memrow['address'].", ".$staterow['state_name'].", ".$distrow['dist_name']." ".$talrow['tal_id']." ".$memrow['mem_city'];

if($scrow['doc_attac_flag']=='y'){
	$zfalg='होय';
}else
{
	$zfalg='नाही';
}

if($scrow['colla_year']=='fy'){
	$colla_year='प्रथम';
}else if($scrow['colla_year']=='sy')
{
	$colla_year='द्वितीय';
}else if($scrow['colla_year']=='ty')
{
	$colla_year='तृतीय';
}else if($scrow['colla_year']=='xy')
{
	$colla_year='चतुर्थ';
}

if($scrow['after_gr_choice']=='y'){
	$after_gr_choice='होय';
}else
{
	$after_gr_choice='नाही';
}


if($scrow['after_gr']=='fy'){
	$after_gr='प्रथम';
}else if($scrow['after_gr']=='sy')
{
	$after_gr='द्वितीय';
}else if($scrow['after_gr']=='ty')
{
	$after_gr='तृतीय';
}else if($scrow['after_gr']=='xy')
{
	$after_gr='चतुर्थ';
}else
{
	$after_gr='--';
}

if($scrow['laabh_year']=='fy'){
	$laabh_year='प्रथम';
}else if($scrow['laabh_year']=='sy')
{
	$laabh_year='द्वितीय';
}else if($scrow['laabh_year']=='ty')
{
	$laabh_year='तृतीय';
}else if($scrow['laabh_year']=='xy')
{
	$laabh_year='चतुर्थ';
}else
{
	$laabh_year='--';
}

if($scrow['scholarship_type']=='y'){
	$scholarship_type='वार्षिक';
}else if($scrow['scholarship_type']=='s')
{
	$scholarship_type='सहामाही';
}else if($scrow['scholarship_type']=='t')
{
	$scholarship_type='त्रैमासिक';
}else if($scrow['scholarship_type']=='m')
{
	$scholarship_type='मासिक';
}else
{
	$scholarship_type='--';
}



if($scrow['marksheet_zerox']=='y'){
	$marksheet_zerox='होय';
}else
{
	$marksheet_zerox='नाही';
}

if($scrow['laabharthi']=='y'){
	$laabharthi='होय';
}else
{
	$laabharthi='नाही';
}




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
	<tr><td colspan="4"><img src="../images/aabhar.jpg" width="100%" style="margin-left: -1%;"></td></tr>
	
  <tr style="height: 35px;">
		<td colspan="4" style="font-size:15px"><strong><center>शैक्षणिक मदत मिळणेसाठीचा अर्ज </center></strong></td>
	
  </tr>
  
 
 <tr style="height: 35px;"> 
    <td width="70%" colspan="3" style="font-size:15px">
   <strong> प्रति<br/>मा. अध्यक्ष<br/>लाडशाकीय वाणी समाज<br/>सन्मित्र मंडळ नाशिक<br/>विषय : शिक्षणासाठी आर्थिक मदत मिळणे बाबत</strong> </td>
	<td width="30%">दिनांक :- '.date('d/m/Y').'<br/><img src="../uploads/scholarship/studimg/'.$scrow['sch_id'].".".$scrow['stu_img'].'" width="130px"></td>
   
</tr>

<tr style="height: 35px;">
<td width="10%">१)</td>
<td width="30%">विद्यार्थ्यांचे पूर्ण नाव :-</td>
<td width="60%" colspan="2" style="font-size:15px">'.$scrow['stud_name'].'</td>
	
  </tr>
  
  <tr style="height: 35px;">
<td>२)</td>
<td>पालकाचे पूर्ण नाव :-</td>
<td colspan="2" style="font-size:15px">'.$memrow['first_name']." ".$memrow['middle_name']." ".$memrow['last_name'].'</td>
	
  </tr>
  
  <tr style="height: 35px;">
<td>३)</td>
<td>पालकांचा पूर्ण पत्ता :-</td>
<td colspan="2" style="font-size:15px">'.$address.'</td>
	
  </tr>
  
    <tr style="height: 35px;">
<td>४)</td>
<td>पालकांचा फोन नं. व सभासद क्र. :-</td>
<td colspan="2" style="font-size:15px">मो. नं. '.$memrow['mobile_no'].' सभासद क्र. '.$memrow['mem_no'].'</td>
	
  </tr>
  
  <tr style="height: 35px;">
<td>५)</td>
<td>विद्यार्थ्यांचा फोन नं. व सभासद क्र. :-</td>
<td colspan="2" style="font-size:15px">मो. नं. '.$scrow['stud_mob'].' सभासद क्र.  </td>
	
  </tr>
  
   <tr style="height: 35px;">
<td>६)</td>
<td colspan="3" style="font-size:15px">विद्यार्थ्यांची शैक्षणिक माहिती </td>
	
  </tr>
  
   <tr style="height: 35px;">
<td>अ)</td>
<td>१० वीत मिळालेले गुण :-</td>
<td colspan="2" style="font-size:15px">शेकडा गुण : '.$scrow['10th_mark'].'% झेरॉक्स जोडली : '.$zfalg.'  </td>
	
  </tr>
  
  <tr style="height: 35px;">
<td>ब)</td>
<td>१२ वीत मिळालेले गुण :-</td>
<td colspan="2" style="font-size:15px">शेकडा गुण : '.$scrow['12th_mark'].'% झेरॉक्स जोडली : '.$zfalg.'  </td>
	
  </tr>
  
  <tr style="height: 35px;">
<td>क)</td>
<td>१०/१२ नंतर विद्यार्थ्याने निवडलेला अभ्यासक्रम व कॉलेजचे नाव :-</td>
<td colspan="2" style="font-size:15px">'.$scrow['edu_field'].'<br/>'.$scrow['colla_name'].'  </td>
	
  </tr>
  
  <tr style="height: 35px;">
<td>ड)</td>
<td>पदवी/पदविका अभ्यासक्रम सद्यास्तिथीत कोणत्या वर्गात शिकत आहे :-</td>
<td colspan="2" style="font-size:15px">'.$colla_year.'  </td>
	
  </tr>
  
  <tr style="height: 35px;">
<td>इ)</td>
<td>शिकत असलेल्या वर्गाची वर्षाची ऐकून फी :-</td>
<td colspan="2" style="font-size:15px">'.$scrow['colla_year_fee'].'  </td>
	
  </tr>
  
  <tr style="height: 35px;">
<td>७)</td>
<td>विद्यार्थ्याने पदव्युत्तर अभ्यासक्रम निवडला आहे का? :-</td>
<td colspan="2" style="font-size:15px">'.$after_gr_choice.'<br/>'.$after_gr.'  </td>
	
  </tr>
  
  <tr style="height: 35px;">
<td>८)</td>
<td>प्रथम/ द्वितीय/ तृतीय वर्षात शिकत असल्यास मागील वर्षात मिळालेले गुण :-</td>
<td colspan="2" style="font-size:15px"> झेरॉक्स प्रत जोडली :-'.$marksheet_zerox.'  </td>
	
  </tr>
  
  <tr style="height: 35px;">
<td>९)</td>
<td>विद्यार्थ्याने त्याच्या पालकाने किती रुपयाची मदत मागितली आहे :-</td>
<td colspan="2" style="font-size:15px"> ₹ '.$scrow['sch_amt'].'  </td>
	
  </tr>
  
  <tr style="height: 35px;">
<td>१०)</td>
<td>पालकाचे वार्षिक उत्त्पन्न :-</td>
<td colspan="2" style="font-size:15px"> ₹ '.$scrow['parent_income'].'  </td>
	
  </tr>
  
  <tr style="height: 35px;">
<td>११)</td>
<td>जामीनदार नाव क्र १ :-</td>
<td colspan="2" style="font-size:15px"> '.$res1.', स. क्र. :-'.$resmid1.'  </td>
	
  </tr>
  
  <tr style="height: 35px;">
<td>१२)</td>
<td>जामीनदार नाव क्र २ :-</td>
<td colspan="2" style="font-size:15px"> '.$res2.', स. क्र. :-'.$resmid2.'  </td>
	
  </tr>
  
  <tr style="height: 35px;">
<td>१३)</td>
<td>आपल्याला यापूर्वी या योजनेचा लाभ झाला आहे का व रु :-</td>
<td colspan="2" style="font-size:15px"> '.$laabharthi.'<br/>₹ '.$scrow['laabh_amt'].'  </td>
	
  </tr>
  
  <tr style="height: 35px;">
<td>१४)</td>
<td>असल्यास कोणत्या वर्षी:-</td>
<td colspan="2" style="font-size:15px"> '.$laabh_year.'  </td>
	
  </tr>
  
  <tr style="height: 35px;">
<td>१५)</td>
<td>ओळख देणाऱ्या संचालकांचे नाव:-</td>
<td colspan="2" style="font-size:15px"> '.$sanrow['gal_caption'].'  </td>
	
  </tr>




</table>';
 $html.='मला आर्थिक मदत मिळणेस विनंती आह।  सोबतचे यादी प्रमाणे कागदपत्र जोडलेली आहेत<br/><br/><br/><br/><br/>कळावे:<br/><br/><br/><br/>आपला विश्वासू
 <br/><br/><br/><br/><br/><br/><strong>स्थळ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; विद्यार्थ्यांची सही &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; पालकाची सही<br/><br/>दिनांक :- <br/><hr/><br/><center>कार्यालयीन उपयोगाकरिता</center><br/>१) अर्ज दाखल दिनांक :- '.date("d/m/Y", strtotime($scrow['regdate'])).'<br/>२) शिष्यवृत्ती मंजूर नामंजूर दिनांक :- '.date("d/m/Y", strtotime($scrow['granted_date'])).'<br/>३) शिष्यवृत्ती मंजुरी / नामंजूर सभा दिनांक : -<br/>४) शिष्यवृत्ती स्वरूप :- '.$scholarship_type.'<br/><br/><br/><br/><br/><br/>सरचिटणीस &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; समिती प्रमुख &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;अध्यक्ष<br/><br/>टीप :- <strong>'.$scrow['remark'].'';


     
 $html.='</div></body>
</html>'; 
echo $html;exit;
$dompdf = new DOMPDF($options);
$dompdf->load_html($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$output = $dompdf->output();

	
	
$dompdf->stream("swami.pdf",array("Attachment"=>1));
