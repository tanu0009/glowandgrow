<?php // session_start();
//if(!isset($_SESSION['id']) || !isset($_SESSION['user'])){session_destroy();echo "login.php";exit;}
if($_SERVER['REQUEST_METHOD']!='POST' || empty($_POST)){echo "404.php";exit;}
require_once("db/conn.php");

//file used in trnschemeadd.php
$tal_id="";
if(isset($_POST['tal_id']))$tal_id=$_POST['tal_id'];
$condn = ($_POST['dist_id'] == 0) ? '1' : 'dist_id='.$_POST['dist_id'].'' ;


$listq="SELECT * FROM lad_mst_taluka WHERE $condn ORDER BY taluka_name asc";

$listr=$connection->query($listq);
?>
<option value="">Select</option>
<?php
while($listrow=$listr->fetch_assoc()){
?>
<option value="<?php echo $listrow['tal_id']?>"<?php if($listrow['tal_id']==$tal_id)echo "selected"?>><?php echo $listrow['taluka_name']?></option>
<?php
}$listr->free();
$connection->close();
?>