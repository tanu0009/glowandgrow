<?php // session_start();
//if(!isset($_SESSION['id']) || !isset($_SESSION['user'])){session_destroy();echo "login.php";exit;}
if($_SERVER['REQUEST_METHOD']!='POST' || empty($_POST)){echo "404.php";exit;}
require_once("db/conn.php");
//echo($_POST['consrno']);

//file used in trnschemeadd.php
//$scheme="";
//if(isset($_POST['schem_id']))$scheme=$_POST['schem_id'];
//$condn = ($_POST['schem_id'] == 0) ? '1' : 'schem_id='.$_POST['schem_id'].'' ;
$condn1 = ($_POST['mem_id'] == 0) ? '1' : 'mem_id='.$_POST['mem_id'].'' ;

//echo $condn;

$listq="SELECT a.*,b.sub_scheme_id,b.mem_id,b.mem_trn_id FROM lad_sub_scheme a,lad_trn_member b WHERE a.sub_scheme_id = b.sub_scheme_id AND  b.$condn1 ORDER BY mem_trn_id asc";


//echo $listq;
$listr=$connection->query($listq);
?>
<option value="">Select</option>
<?php
while($listrow=$listr->fetch_assoc()){
?>
<option value="<?php echo $listrow['mem_trn_id']?>"><?php echo $listrow['sub_scheme_name']?></option>
<?php
}$listr->free();
$connection->close();
?>