<?php // session_start();
//if(!isset($_SESSION['id']) || !isset($_SESSION['user'])){session_destroy();echo "login.php";exit;}
if($_SERVER['REQUEST_METHOD']!='POST' || empty($_POST)){echo "404.php";exit;}
require_once("db/conn.php");
//echo($_POST['consrno']);

//file used in trnschemeadd.php
$scheme="";
if(isset($_POST['scheme']))$scheme=$_POST['scheme'];
$condn = ($_POST['mem_id'] == 0) ? '1' : 'mem_id='.$_POST['mem_id'].'' ;

//echo $condn;

$listq="SELECT a.*,b.schem_id,b.mem_id FROM lad_scheme a,lad_trn_member b WHERE a.schem_id = b.schem_id AND $condn AND inout_flag='i' AND active='y' ORDER BY mem_trn_id asc";


//echo $listq;
$listr=$connection->query($listq);
?>
<option value="">Select</option>
<?php
while($listrow=$listr->fetch_assoc()){
?>
<option value="<?php echo $listrow['schem_id']?>"<?php if($listrow['schem_id']==$scheme)echo "selected"?>><?php echo $listrow['scheme_name']?></option>
<?php
}$listr->free();
$connection->close();
?>