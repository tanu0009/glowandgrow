<?php // session_start();
//if(!isset($_SESSION['id']) || !isset($_SESSION['user'])){session_destroy();echo "login.php";exit;}
if($_SERVER['REQUEST_METHOD']!='POST' || empty($_POST)){echo "404.php";exit;}
require_once("db/conn.php");

//file used in trnschemeadd.php
$dist_id="";
if(isset($_POST['dist_id']))$dist_id=$_POST['dist_id'];
$condn = ($_POST['state_id'] == 0) ? '1' : 'state_id='.$_POST['state_id'].'' ;
echo $condn;

$listq="SELECT * FROM lad_mst_district WHERE $condn ORDER BY dist_name asc";

$listr=$connection->query($listq);
?>
<option value="">Select</option>
<?php
while($listrow=$listr->fetch_assoc()){
?>
<option value="<?php echo $listrow['dist_id']?>"<?php if($listrow['dist_id']==$dist_id)echo "selected"?>><?php echo $listrow['dist_name']?></option>
<?php
}$listr->free();
$connection->close();
?>