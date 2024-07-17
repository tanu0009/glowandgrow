<?php 
$dbnm='workshop';
$dbuser='root';
$dbpass='';
$dbhost='localhost';

/*$dbnm='ultratenders';
$dbuser='ultratenders';
$dbpass='ultratenders@ULT';
$dbhost='148.66.147.43';*/


define('DB_NAME',$dbnm);
define('DB_HOST',$dbhost);
define('DB_USER',$dbuser);
define('DB_PASS',$dbpass);
	

$connection=new mysqli($dbhost,$dbuser,$dbpass,$dbnm) or die("Connection Error: ".mysqli_connect_error());

$connection->set_charset('utf8');

date_default_timezone_set("Asia/Kolkata");

$db = new mysqli($dbhost, $dbuser, $dbpass, $dbnm);
$db->set_charset('utf8');

// Check connection_mh
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}


//include('db/db_functions.php');

?>